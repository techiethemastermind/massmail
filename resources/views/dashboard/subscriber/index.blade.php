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
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newSubscriberModal">
                        Add new</button>
                    <button type="button" class="btn btn-outline-accent" data-toggle="modal" data-target="#csvUploadModal">
                        Import CSV</button>
                    
                    <button type="button" class="btn btn-outline-dark" id="btn_sendmail">Send Emails</button>

                    {{-- <button id="btn_runjob" class="btn btn-outline-primary">Run Job</button> --}}
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
                    <table class="table mb-0 thead-border-top-0 table-nowrap" data-page-length="50">
                        <thead>
                            <tr>
                                <th style="width: 18px;" class="pr-0"></th>
                                <th> No </th>
                                <th> Email Address </th>
                                <th> User Name </th>
                                <th> Status </th>
                                <th> Email Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                        @php
                            $pagenum = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                        @endphp

                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td></td>
                                    <td>{{ ($pagenum - 1) * 50 + $loop->iteration }}</td>
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
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if ($item->mail_sent == 1)
                                            <small class="js-lists-values-status text-50 mb-4pt">Sent</small>
                                            <span class="indicator-line rounded bg-primary"></span>
                                            @else
                                            <small class="js-lists-values-status text-50 mb-4pt">Not Sent</small>
                                            <span class="indicator-line rounded bg-warning"></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                        <button class="btn btn-sm btn-success" data-type="status" data-action="active" data-id="{{$item->id}}">
                                            <i class="material-icons">arrow_upward</i></button>
                                        @else
                                        <button class="btn btn-sm btn-info" data-type="status" data-action="deactive" data-id="{{$item->id}}">
                                            <i class="material-icons">arrow_downward</i></button>
                                        @endif
                                        @include('layouts.buttons.delete', ['delete_route' => route('subscriber.destroy', $item->id)])
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

<!-- Modal Form -->
<div class="modal fade" id="newSubscriberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">New Subscriber</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('subscriber.store') }}"
                    enctype="multipart/form-data">{{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="customer" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button type="button" id="btn_new_subscriber" class="btn btn-primary">Save</button>
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

        $('#btn_runjob').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                method: 'GET',
                url: "{{ route('job.run') }}",
                success: function(res) {
                    console.log(res);
                }
            });
        })

        $('#btn_new_subscriber').on('click', (e) => {
            e.preventDefault();

            if($('#email').val() == '') {
                $('#email').focus();
                return false;
            }

            $('#newSubscriberModal form').ajaxSubmit({
                success: (res) => {
                    if(res.success) {
                        $('#newSubscriberModal').modal('toggle');
                        swal("Success!", 'New subscriber successfully added', "success");
                    } else {
                        swal("Error!", res.message, "error");
                    }
                },
                error: (err) => {
                    swal("Error!", JSON.parse(err.responseText).message, "error");
                }
            });
        });

        $('button[data-type=status]').on('click', function(e) {
            let subscriber_id = $(this).attr('data-id');
            let action_type = $(this).attr('data-action');
            let status = (action_type == 'active') ? 1 : 0;

            $.ajax({
                method: 'POST',
                url: "{{ route('subscriber.status') }}",
                data: {
                    id: subscriber_id,
                    status: status
                },
                success: function(res) {
                    if (res.success) {
                        swal('Success', res.message, 'success');
                    }
                }
            })
        });

        $('#btn_csv_import').on('click', (e) => {
            
            e.preventDefault();

            $('#csvUploadModal form').ajaxSubmit({
                success: function(res) {
                    if(res.success) {
                        $('#csvUploadModal').modal('toggle');
                        swal("Success!", 'Email list successfully added', "success");
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
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $(document).on('submit', 'form[name="delete_item"]', function(e) {

            e.preventDefault();

            $(this).ajaxSubmit({
                success: function(res) {
                    if(res.success) {
                        location.reload();
                    } else {
                        swal("Warning!", res.message, "warning");
                    }
                }
            });
        });
    });
</script>
@endpush
