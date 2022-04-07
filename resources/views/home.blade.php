@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>

                    <ol class="breadcrumb p-0 m-0">

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row mb-16pt">
                <div class="col-lg-4">
                    <div class="card border-1 border-left-3 border-left-accent text-center mb-lg-0">
                        <div class="card-body">
                            <h4 class="h2 mb-0">{{ $total_num }}</h4>
                            <div><label class="form-label">Total Subscribers</label></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                        <div class="card-body">
                            <h4 class="h2 mb-0">{{ $active_num }}</h4>
                            <div><label class="form-label">Active Subscribers</label></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-1 border-left-3 border-left-accent-yellow text-center mb-lg-0">
                        <div class="card-body">
                            <h4 class="h2 mb-0">{{ $deactive_num }}</h4>
                            <div><label class="form-label">Deactive Subscribers</label></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
