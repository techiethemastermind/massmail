@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Base Prices</h2>

                    <ol class="breadcrumb p-0 m-0">

                        <li class="breadcrumb-item active">
                            Prices
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="javascript:void(0)" id="btn_update" class="btn btn-outline-secondary">Manual Update Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Base Prices</div>
            </div>
            <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                <div class="table" data-toggle="lists" data-lists-sort-by="js-lists-values-schedule" data-lists-sort-desc="true" data-lists-values="[&quot;js-lists-values-no&quot;]">
                    <table class="table mb-0 thead-border-top-0 table-nowrap" data-page-length="5">
                        <thead>
                            <tr>
                                <th style="width: 18px;" class="pr-0"></th>
                                <th> No </th>
                                <th> From Unit </th>
                                <th> To Unit </th>
                                <th> Value (USD) </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($prices as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->from }}</td>
                                    <td>{{ $item->to }}</td>
                                    <td>{{ $item->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')

<script>

    $(function() {

        $('#btn_update').on('click', (e) => {

            console.log('Price Update Manually Now');

            // $.ajax({
            //     method: "POST",
            //     url: "",
            //     success: function(res) {
            //         console.log(res)
            //     },
            //     error: function(err) {
            //         console.log(err);
            //     }
            // });
        });
    });
</script>
@endpush
