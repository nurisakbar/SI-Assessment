@extends('layouts.app')
@section('title','Manage Pertanyaan')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
         <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Report</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Report</a>
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
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Report</h4>
                              <div class="d-inline-block">
                                 <a href="{{ route('report.export') }}" class="btn btn-primary btn-sm">
                                     <i data-feather='file'></i> Export
                                 </a>
                                 <a href="{{ route('report.cetak-bulk') }}" class="btn btn-info btn-sm">
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
                                        @foreach($model as $row)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $row->name}}</td>
                                          <td>{{ $row->jawaban->created_at ?? '-' }}</td>
                                          <td>
                                            {!! !empty($row->jawaban) ? '<span class="badge bg-success">Sudah</span>' : '<span class="badge bg-warning">Belum</span>' !!}</td>
                                         <td class="text-center">
                                             <div class="form-button-action">
                                                <button type="button" class="btn btn-link btn-primary btn-sm detail" data-id="{{ $row->id }}">
                                                  <i data-feather='eye'></i>
                                               </button>
                                             </div>
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

        </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {

   $('.detail').click(function(e) {
      var id = $(this).data('id'); 
      $('#exampleModals').modal('show');
      $.ajax({
               url: '{{ route('report.detail') }}',
               method: 'post',
               cache: false,
               data: {
                  "_token": "{{ csrf_token() }}",
                  "id" :id
               },
               success: function(data){
                  $('.modal-content').html(data);
               }
            });
   });

});

</script>
@endpush