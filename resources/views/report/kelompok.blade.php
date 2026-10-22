@extends('layouts.app')
@section('title','Report')
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
         <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ $label }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Report</a></li>
                                <li class="breadcrumb-item active">{{ $label }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="content-body">
                <section id="dashboard-analytics">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title mb-0">{{ $label }}</h4>
                              <div class="d-inline-block">
                                 <a href="{{ route('report.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                                 <a href="{{ route('report.export', ['kelompok' => $key]) }}" class="btn btn-primary btn-sm">
                                     <i data-feather='file'></i> Export
                                 </a>
                                 <a href="{{ route('report.cetak-bulk', ['kelompok' => $key]) }}" class="btn btn-info btn-sm">
                                     <i data-feather='file-text'></i> Download Bulk
                                 </a>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th style="width: 5%">No</th>
                                          <th>Nama</th>
                                          <th>Tanggal Test</th>
                                          <th>Status</th>
                                          <th style="width: 20%" class="text-center">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $row)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $row->name }}</td>
                                          <td>{{ $row->jawaban->created_at ?? '-' }}</td>
                                          <td>
                                            {!! !empty($row->jawaban) ? '<span class="badge bg-success">Sudah</span>' : '<span class="badge bg-warning">Belum</span>' !!}
                                          </td>
                                          <td class="text-center">
                                             <button type="button" class="btn btn-link btn-primary btn-sm detail" data-id="{{ $row->id }}">
                                                <i data-feather='eye'></i>
                                             </button>
                                          </td>
                                       </tr>
                                       @empty
                                       <tr>
                                          <td colspan="5" class="text-center text-muted">Belum ada peserta.</td>
                                       </tr>
                                       @endforelse
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
   $('.detail').click(function() {
      var id = $(this).data('id');
      $('#exampleModals').modal('show');
      $.ajax({
         url: '{{ route('report.detail') }}',
         method: 'post',
         cache: false,
         data: {
            "_token": "{{ csrf_token() }}",
            "id": id
         },
         success: function(data) {
            $('.modal-content').html(data);
         }
      });
   });
});
</script>
@endpush
