@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Create New Subscriber</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('subscriber.index') }}">Subscribers</a>
                        </li>

                        <li class="breadcrumb-item active">
                            New Subscriber
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto mr-3">
                    <a href="{{ route('subscriber.index') }}"
                        class="btn btn-outline-secondary">Back</a>
                    <button id="btn_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">

        <div class="container page__container">
            <div class="row">
                <form action="{{ route('subscriber.store') }}">
                    
                </form>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')

    <script>
        $(function () {

            //
        });

    </script>

@endpush

@endsection
