@extends('layouts.app')

@section('title', 'Pembayaran Token')

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section id="pay-token">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pembayaran Token</h4>
                            </div>
                            <div class="card-body">
                                <p>Order ID: <strong>{{ $transaction->order_id }}</strong></p>
                                <p>Jumlah Token: <strong>{{ $transaction->tokens }}</strong></p>
                                <p>Total Bayar: <strong>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</strong></p>
                                <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                                <a href="{{ route('token.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay(@json($snapToken), {
                onSuccess: function () {
                    window.location.href = "{{ route('token.index') }}";
                },
                onPending: function () {
                    window.location.href = "{{ route('token.index') }}";
                },
                onError: function () {
                    window.location.href = "{{ route('token.index') }}";
                },
                onClose: function () {
                    // do nothing, user can reopen payment
                }
            });
        });
    </script>
@endpush

