@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Email Subscribers</h2>

                    <ol class="breadcrumb p-0 m-0">

                        <li class="breadcrumb-item active">
                            Dashboard / Subscribers
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="button-list">
                    <button type="button" class="btn btn-outline-primary" id="btn_addnew">Add New Subscriber</button>
                    <button type="button" class="btn btn-outline-accent" data-toggle="modal" data-target="#csvUploadModal">Import CSV</button>
                    @if(auth()->user()->job_status == 0)
                    <button type="button" class="btn btn-outline-dark" id="btn_sendmail">Send Emails</button>
                    @else
                    <button type="button" class="btn btn-outline-dark" disabled>Email sending is processing</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Email List</div>
            </div>
            <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
                <div class="table" data-toggle="lists" data-lists-sort-by="js-lists-values-schedule" data-lists-sort-desc="true" data-lists-values="[&quot;js-lists-values-no&quot;]">
                    <table class="table mb-0 thead-border-top-0 table-nowrap" data-page-length="5">
                        <thead>
                            <tr>
                                <th style="width: 18px;" class="pr-0"></th>
                                <th> No </th>
                                <th> Email Address </th>
                                <th> User Name </th>
                                <th> Status </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if ($item->status == 1)
                                            <small class="js-lists-values-status text-50 mb-4pt">Active</small>
                                            <span class="indicator-line rounded bg-primary"></span>
                                            @else
                                            <small class="js-lists-values-status text-50 mb-4pt">Deactived</small>
                                            <span class="indicator-line rounded bg-warning"></span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer p-8pt">
                    @if($items->hasPages())
                    {{ $items->links('layouts.parts.page') }}
                    @else
                    <ul class="pagination justify-content-start pagination-xsm m-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Page 1">
                                <span>1</span>
                            </a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Next">
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="csvUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Import CSV file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('subscribers.import') }}"
                    enctype="multipart/form-data">{{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bootstrap-touchspin-down" id="importCsvFilelbl">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="csv_file" class="custom-file-input" id="importCsvFile"
                                aria-describedby="importCsvFilelbl" accept=".xlsx, .xls, .csv">
                            <label class="custom-file-label" for="importCsvFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button type="button" id="btn_csv_import" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')

<script>

    $(function() {

        $('#btn_csv_import').on('click', function(e) {
            
            e.preventDefault();

            $('#csvUploadModal form').ajaxSubmit({
                success: function(res) {
                    if(res.success) {
                        $('#csvUploadModal').modal('toggle');
                        swal("Success!", 'Students successfully added', "success");
                        table.ajax.reload();
                    } else {
                        swal("Error!", res.message, "error");
                    }
                }
            });
        });

        $('#btn_sendmail').on('click', (e) => {

            $.ajax({
                method: "POST",
                url: "{{ route('subscribers.email.send') }}",
                success: function(res) {
                    if(res.success) {
                        swal('Success!', 'Email sending started', 'success');
                    }

                    // $('#btn_sendmail').text('Email sending is processing');
                    // $('#btn_sendmail').attr('disabled', 'disabled');
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>
@endpush
