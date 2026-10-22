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
                              <h4 class="card-title mb-0">Kelompok</h4>
                           </div>
                           <div class="list-group list-group-flush">
                              @foreach($groups as $group)
                              <a href="{{ route('report.kelompok', $group['key']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                 <span class="fw-bolder">{{ $group['label'] }}</span>
                                 <span>
                                    <span class="badge bg-light-primary me-50">{{ $group['total'] }} peserta</span>
                                    <i data-feather="chevron-right"></i>
                                 </span>
                              </a>
                              @endforeach
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
@endsection