<?php

namespace App\Http\Controllers;

use App\Models\TokenTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->tokenTransactions()->latest()->get();

        return view('token.index', [
            'user' => $user,
            'transactions' => $transactions,
            'clientKey' => Config::get('services.midtrans.client_key'),
            'hasFreeTrial' => $user->hasFreeTrialAvailable(),
            'freeTrialRemaining' => $user->freeTrialRemaining(),
        ]);
    }

    public function create()
    {
        return view('token.create');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'tokens' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $tokenPrice = (int) Config::get('app.token_price', 10000);
        $quantity = (int) $request->input('tokens');
        $grossAmount = $tokenPrice * $quantity;

        $orderId = 'TOK-' . $user->id . '-' . now()->format('YmdHis');

        $transaction = TokenTransaction::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'tokens' => $quantity,
            'amount' => $grossAmount,
            'status' => 'pending',
        ]);

        $midtransConfig = Config::get('services.midtrans');
        $serverKey = $midtransConfig['server_key'] ?? null;
        $isProduction = filter_var($midtransConfig['is_production'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $baseUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'TOKEN',
                    'price' => $tokenPrice,
                    'quantity' => $quantity,
                    'name' => 'Assessment Token',
                ],
            ],
        ];

        $response = Http::withBasicAuth($serverKey, '')
            ->withHeaders(['Accept' => 'application/json'])
            ->post($baseUrl, $payload);

        if (! $response->successful()) {
            $transaction->update([
                'status' => 'failed',
                'payload' => ['error' => $response->json()],
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Gagal membuat transaksi pembayaran. Silakan coba lagi.',
                ], 422);
            }

            return redirect()->route('token.index')
                ->with('warning', 'Gagal membuat transaksi pembayaran. Silakan coba lagi.');
        }

        $body = $response->json();
        $transaction->update([
            'payload' => $body,
        ]);

        $snapToken = $body['token'] ?? null;

        if ($request->expectsJson()) {
            return response()->json([
                'snapToken' => $snapToken,
                'orderId' => $orderId,
            ]);
        }

        return redirect()->route('token.index');
    }

    public function notification(Request $request)
    {
        $midtransConfig = Config::get('services.midtrans');
        $serverKey = $midtransConfig['server_key'] ?? '';

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            abort(403, 'Invalid signature');
        }

        return $this->handleSuccessfulNotification($request);
    }

    public function confirmFromClient(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'transaction_status' => 'required|string',
            'transaction_id' => 'nullable|string',
        ]);

        $request->merge([
            'status_code' => $request->input('status_code', '200'),
            'gross_amount' => $request->input('gross_amount', 0),
            'signature_key' => $request->input('signature_key', ''), // not verified for client confirm
        ]);

        return $this->handleSuccessfulNotification($request, false);
    }

    protected function handleSuccessfulNotification(Request $request, bool $verifySignature = true)
    {
        $transaction = TokenTransaction::where('order_id', $request->order_id)->first();

        if (! $transaction) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transaction->update([
            'status' => $request->transaction_status,
            'midtrans_transaction_id' => $request->transaction_id,
            'payload' => $request->all(),
        ]);

        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            $user = $transaction->user;
            $user->tokens = $user->tokens + $transaction->tokens;
            $user->save();
        }

        return response()->json(['message' => 'OK']);
    }
}
