@extends('layouts.app') 
@section('content') 
<style>
    .swal-text{
        text-align: center;
    }
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Question</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Question</a>
                                </li>
                                <li class="breadcrumb-item active">index
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
              <div class="row">
                @if($cek_jawaban > 0)
                <div class="col-md-12">
                    <div class="alert alert-success p-2">
                        Terima kasih atas jawaban yang telah Anda kirimkan.
                    </div>
                </div>
                @elseif($hasFreeTrial ?? false)
                <div class="col-md-12">
                    <div class="alert alert-info p-2">
                        Anda menggunakan <strong>Free Trial</strong> — sisa {{ $freeTrialRemaining ?? 0 }} kali assesment gratis. Setelah habis, beli token untuk assesment berikutnya.
                    </div>
                </div>
                @elseif(!($canAccessAssessment ?? true))
                <div class="col-md-12">
                    <div class="alert alert-warning p-2">
                        Saldo token tidak cukup dan free trial sudah digunakan.
                        <a href="{{ route('token.index') }}" class="alert-link">Beli token</a> untuk melanjutkan assesment.
                    </div>
                </div>
                @endif
                {{ Form::open(['url'=>route('assessment.store'),'class'=>'form-horizontal','files'=>true, 'id'=>'assessmentForm'])}}
                 <div class="col-md-12">
                    @php
                        $lastBagian = null; // Variabel untuk melacak bagian sebelumnya
                    @endphp

                    @foreach($questions as $question)
                        @if ($lastBagian !== $question->bagian)
                            <!-- Tampilkan bagian hanya jika berbeda dengan sebelumnya -->
                            <div class="alert alert-primary p-2">
                                <h4 align="center" style="font-weight: bold">BAGIAN {{ $question->bagian }}</h4>
                                @if($question->bagian == 'I')
                                    <p class="text-black" style="text-align: justify">Bagian ini terdiri dari <b>19 pernyataan</b> tentang strategi yang Anda gunakan untuk mengatasi stressor baru-baru ini dalam kehidupan Anda.
                                    <br>Jika Anda tidak yakin untuk memberikan respon pada suatu pernyataan, harap pilih satu yang paling sesuai (biasanya respon pertama yang muncul dalam pikiran Anda).</p>
                                @elseif($question->bagian == 'II')
                                    <p class="text-black" style="text-align: justify">
                                        Bagian ini terdiri dari <b>4 pernyataan</b> tentang kehidupan emosional Anda, khususnya, bagaimana Anda mengendalikan (yaitu, mengatur dan mengelola) emosi Anda.<br>
                                        Pernyataan-pernyataan di bawah ini melibatkan dua aspek berbeda dari kehidupan emosional Anda. Salah satunya adalah pengalaman emosional Anda, atau apa yang Anda rasakan. Yang lain adalah ekspresi emosional Anda, atau bagaimana Anda menunjukkan emosi Anda dalam cara Anda berbicara, memberi isyarat, atau berperilaku. Beberapa pernyataan mungkin tampak mirip satu sama lain, namun berbeda dalam hal-hal penting.
                                    </p>
                                @elseif($question->bagian == 'III')
                                    <p class="text-black" style="text-align: justify">Bagian ini terdiri dari <b>8 pernyataan</b> tentang respon Anda terhadap perasaan depresi.</p>
                                @else
                                    <p class="text-black" style="text-align: justify">Bagian ini terdiri dari <b>9 pernyataan</b> tentang bagaimana Anda bisa merasakan atau memikirkan perasaan Anda.</p>
                                @endif
                            </div>
                            @php
                                $lastBagian = $question->bagian; // Perbarui bagian terakhir
                            @endphp
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">SOAL NO {{ $loop->iteration }}</h4>
                                        <span class="badge bg-primary" style="margin-top: -20px;">{{ $question->jenis }}</span>
                                    </div>
                                    <p>{{ $question->pertanyaan }}</p>

                                    <div class="">
                                        @php
                                            $jawaban = $question->jawaban; // Ambil relasi jawaban
                                            $isDisabled = $jawaban && $jawaban->jawaban ? 'disabled' : ''; // Periksa apakah jawaban ada
                                        @endphp
                                    
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="jawaban_id_{{ $question->id }}" id="inlineRadio{{ $question->id }}_1" value="1" {{ ($jawaban && $jawaban->jawaban == 1) ? 'checked' : '' }} {{ $isDisabled }}>
                                            <label class="form-check-label" for="inlineRadio{{ $question->id }}_1">Tidak Pernah</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="jawaban_id_{{ $question->id }}" id="inlineRadio{{ $question->id }}_2" value="2" {{ ($jawaban && $jawaban->jawaban == 2) ? 'checked' : '' }} {{ $isDisabled }}>
                                            <label class="form-check-label" for="inlineRadio{{ $question->id }}_2">Jarang</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="jawaban_id_{{ $question->id }}" id="inlineRadio{{ $question->id }}_3" value="3" {{ ($jawaban && $jawaban->jawaban == 3) ? 'checked' : '' }} {{ $isDisabled }}>
                                            <label class="form-check-label" for="inlineRadio{{ $question->id }}_3">Kadang-kadang</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="jawaban_id_{{ $question->id }}" id="inlineRadio{{ $question->id }}_4" value="4" {{ ($jawaban && $jawaban->jawaban == 4) ? 'checked' : '' }} {{ $isDisabled }}>
                                            <label class="form-check-label" for="inlineRadio{{ $question->id }}_4">Sering</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="radio" name="jawaban_id_{{ $question->id }}" id="inlineRadio{{ $question->id }}_5" value="5" {{ ($jawaban && $jawaban->jawaban == 5) ? 'checked' : '' }} {{ $isDisabled }}>
                                            <label class="form-check-label" for="inlineRadio{{ $question->id }}_5">Sangat Sering</label>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($cek_jawaban == 0 && ($canAccessAssessment ?? true))
                    <div class="form-group">
                        <button class="btn btn-primary">Kirim</button>
                    </div>
                    @endif
                 </div>
                 {{ Form::close() }}

              </div>

                <!--/ List DataTable -->
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div> 
@endsection

@push('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const questions = document.querySelectorAll('.card'); // Semua pertanyaan
        let allAnswered = true;

        questions.forEach(card => {
            const radios = card.querySelectorAll('input[type="radio"]');
            const isAnswered = Array.from(radios).some(radio => radio.checked);

            if (!isAnswered) {
                allAnswered = false;
                card.style.border = '2px solid red'; // Tandai pertanyaan yang belum diisi
            } else {
                card.style.border = 'none'; // Hilangkan tanda jika sudah diisi
            }
        });

        if (!allAnswered) {
            e.preventDefault(); // Hentikan submit
            alert('Harap isi semua pertanyaan sebelum melanjutkan.');
        }
    });

    document.getElementById('assessmentForm').addEventListener('submit', function(event) {
        const questions = document.querySelectorAll('.card'); // Ambil semua pertanyaan
        let allAnswered = true;

        questions.forEach(question => {
            const radios = question.querySelectorAll('input[type="radio"]');
            const isAnswered = Array.from(radios).some(radio => radio.checked);

            if (!isAnswered) {
                allAnswered = false;
                question.style.border = '2px solid #ff9797'; // Tambahkan border merah untuk menandai
            } else {
                question.style.border = ''; // Hapus border merah jika sudah terjawab
            }
        });

        if (!allAnswered) {
            event.preventDefault(); // Hentikan pengiriman formulir
            swal("Pertanyaan Belum Terjawab!", "Harap jawab semua pertanyaan sebelum mengirimkan.", {
                icon : "warning",
                buttons: {        			
                confirm: {
                    className : 'btn btn-success'
                }
                },
            });
        }else{
            swal("Berhasil mengirim jawaban", "Semua jawaban berhasil disimpan.", {
                icon : "success",
                buttons: {        			
                confirm: {
                    className : 'btn btn-success'
                }
                },
            });
        }
    });
</script>
@endpush