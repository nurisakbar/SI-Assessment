@extends('layouts.app')

@section('title', 'Beli Token')

@section('content')
<div class="app-content content">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section id="buy-token">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Beli Token</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('token.checkout') }}">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="tokens">Jumlah Token</label>
                                        <select name="tokens" id="tokens" class="form-control">
                                            <option value="1">1 Token (Rp 10.000)</option>
                                            <option value="3">3 Token (Rp 30.000)</option>
                                            <option value="5">5 Token (Rp 50.000)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
                                    <a href="{{ route('token.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

