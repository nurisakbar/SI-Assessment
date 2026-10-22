@extends('layouts.app')
@section('title','Manage Pertanyaan')
@section('content')
<style>
    .report-group-card {
        border: 1px solid #ebe9f1;
        transition: transform .18s ease, box-shadow .18s ease;
    }
    .report-group-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(34, 41, 47, .08);
    }
    .report-group-card .report-count {
        font-size: 2.4rem;
        line-height: 1;
        font-weight: 700;
    }
</style>

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
                  <div class="row match-height">
                     @foreach($groups as $group)
                     <div class="col-lg-4 col-md-6 col-12">
                        <a href="{{ route('report.kelompok', $group['key']) }}" class="card report-group-card h-100">
                           <div class="card-body d-flex flex-column">
                              <span class="text-uppercase text-muted small mb-50">Kelompok</span>
                              <h4 class="card-title mb-1">{{ $group['label'] }}</h4>
                              <div class="mt-auto d-flex justify-content-between align-items-end">
                                 <div>
                                    <div class="report-count text-primary">{{ $group['total'] }}</div>
                                    <small class="text-muted">peserta</small>
                                 </div>
                                 <span class="text-primary">Lihat <i data-feather="arrow-right"></i></span>
                              </div>
                           </div>
                        </a>
                     </div>
                     @endforeach
                  </div>

                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection