@extends('layouts.app')

@section('title', 'Token')

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row mb-1">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bolder mb-25">Token Saya</h2>
                    <p class="text-muted mb-0">Kelola saldo token untuk mengakses assesment versi PRO.</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyTokenModal">
                    <i data-feather="plus-circle" class="me-50"></i>
                    <span>Beli Token</span>
                </button>
            </div>
        </div>

        <div class="content-body">
            <section id="token-balance">
                <div class="row match-height">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal mb-2">
                            <div class="card-body text-center">
                                <h3 class="mb-1">Saldo Token</h3>
                                <h1 class="fw-bolder display-4 text-primary mb-25">{{ $user->tokens }}</h1>
                                <p class="text-muted mb-1">1 token = Rp 10.000</p>
                                <p class="text-muted small mb-0">Token digunakan setiap kali Anda menyelesaikan 1 kali assesment.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-6 col-12">
                        <div class="card mb-0">
                            <div class="card-header border-bottom">
                                <h4 class="card-title mb-0">Paket Token</h4>
                            </div>
                            <div class="card-body mt-1">
                                <div class="row g-1 g-md-2">
                                    <div class="col-md-4 col-12">
                                        <div class="border rounded-2 p-1 p-md-2 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="mb-25">Starter</h5>
                                                <p class="text-muted mb-25">Cocok untuk coba sekali assesment.</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <h4 class="mb-0">1 Token</h4>
                                                    <small class="text-muted">Rp 10.000</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="border rounded-2 p-1 p-md-2 h-100 bg-light-primary d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="mb-25">Popular</h5>
                                                <p class="text-muted mb-25">Untuk beberapa kali assesment.</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <h4 class="mb-0">3 Token</h4>
                                                    <small class="text-muted">Rp 30.000</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="border rounded-2 p-1 p-md-2 h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="mb-25">Intensif</h5>
                                                <p class="text-muted mb-25">Untuk penggunaan rutin.</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <h4 class="mb-0">5 Token</h4>
                                                    <small class="text-muted">Rp 50.000</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted small mt-1 mb-0">Harga paket mengikuti konfigurasi backend bila diubah di kemudian hari.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="token-history" class="mt-2">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div>
                                <h4 class="card-title mb-25">Riwayat Pembelian Token</h4>
                                <p class="text-muted mb-0">Lihat semua transaksi pembelian token Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Order ID</th>
                                        <th>Token</th>
                                        <th>Jumlah (Rp)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $trx)
                                        <tr>
                                            <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                                            <td class="text-muted">{{ $trx->order_id }}</td>
                                            <td>{{ $trx->tokens }}</td>
                                            <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $status = strtolower($trx->status);
                                                    $badgeClass = match ($status) {
                                                        'capture', 'settlement', 'paid' => 'badge-light-success',
                                                        'pending' => 'badge-light-warning',
                                                        'expire', 'expired' => 'badge-light-secondary',
                                                        'cancel', 'failure', 'failed' => 'badge-light-danger',
                                                        default => 'badge-light-primary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ strtoupper($trx->status) }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">Belum ada transaksi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal Beli Token -->
<div class="modal fade" id="buyTokenModal" tabindex="-1" aria-labelledby="buyTokenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyTokenModalLabel">Beli Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('token.checkout') }}" id="buyTokenForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <label class="form-label" for="tokens">Pilih Paket Token</label>
                        <select name="tokens" id="tokens" class="form-control">
                            <option value="1">1 Token &mdash; Rp 10.000</option>
                            <option value="3">3 Token &mdash; Rp 30.000</option>
                            <option value="5">5 Token &mdash; Rp 50.000</option>
                        </select>
                    </div>
                    <p class="text-muted small mb-0">
                        Pembayaran akan diproses melalui Midtrans setelah Anda menekan tombol
                        <strong>Lanjut Pembayaran</strong>.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Lanjut Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script>
        (function () {
            const form = document.getElementById('buyTokenForm');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(async (response) => {
                    if (!response.ok) {
                        const data = await response.json().catch(() => ({}));
                        throw new Error(data.message || 'Terjadi kesalahan saat membuat transaksi.');
                    }
                    return response.json();
                })
                .then(function (data) {
                    const snapToken = data.snapToken;
                    const orderId = data.orderId;
                    const modalEl = document.getElementById('buyTokenModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }

                    if (window.snap && snapToken) {
                        window.snap.pay(snapToken, {
                            onSuccess: function (result) {
                                fetch("{{ route('token.confirm') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    body: JSON.stringify({
                                        order_id: orderId,
                                        transaction_status: result.transaction_status,
                                        transaction_id: result.transaction_id || null,
                                    }),
                                }).finally(function () {
                                    window.location.reload();
                                });
                            },
                            onPending: function () {
                                window.location.reload();
                            },
                            onError: function () {
                                window.location.reload();
                            },
                            onClose: function () {
                                // user closed popup, no reload
                            }
                        });
                    }
                })
                .catch(function (error) {
                    alert(error.message || 'Gagal membuat transaksi pembayaran.');
                });
            });
        })();
    </script>
@endpush

@endsection
