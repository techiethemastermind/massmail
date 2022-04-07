@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Email Templates</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">
                            Email Templates
                        </li>

                    </ol>

                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto">
                    <a href="{{ route('mailedits.create') }}" class="btn btn-outline-secondary">New Template</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container page__container page-section">
        <div class="page-separator">
            <div class="page-separator__text">Templates</div>
        </div>
        <div class="card dashboard-area-tabs p-relative o-hidden mb-lg-32pt">
            <div class="table" data-toggle="lists">
                <table id="tbl_templates" class="table mb-0 thead-border-top-0 table-nowrap" data-page-length='50'>
                    <thead>
                        <tr>
                            <th style="width: 18px;" class="pr-0"></th>
                            <th>Template Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($templates as $template)
                        <tr>
                            <td></td>
                            <td>
                                @php $bg_color = ($template->type == 0) ? 'bg-accent' : 'bg-primary'; @endphp

                                <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                    <div class="avatar avatar-sm mr-8pt">
                                        <span class="avatar-title rounded '. $bg_color .' text-white">
                                            {{ substr($template->name, 0, 2) }}
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-column">
                                            <small class="js-lists-values-project">
                                                <strong> {{ $template->name }} </strong></small>
                                            <small class="text-muted"> {{ $template->slug }} </small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $template->subject }}</strong>
                            </td>
                            <td>
                                @if($template->published == 1)
                                <div class="d-flex flex-column">
                                    <small class="js-lists-values-status text-50 mb-4pt">Published</small>
                                    <span class="indicator-line rounded bg-primary"></span>
                                </div>
                                @else
                                <div class="d-flex flex-column">
                                    <small class="js-lists-values-status text-50 mb-4pt">Unpublished</small>
                                    <span class="indicator-line rounded bg-warning"></span>
                                </div>
                                @endif
                            </td>
                            <td>
                            @if($template->type == 1)
                                @if($template->published == 0)
                                <button class="btn btn-sm btn-success" data-type="publish" data-action="publish" data-id="{{$template->id}}">
                                    <i class="material-icons">arrow_upward</i></button>
                                @else
                                <button class="btn btn-sm btn-info" data-type="publish" data-action="unpublish" data-id="{{$template->id}}">
                                    <i class="material-icons">arrow_downward</i></button>
                                @endif
                                @include('layouts.buttons.edit', ['edit_route' => route('mailedits.edit', $template->id)])
                                @include('layouts.buttons.delete', ['delete_route' => route('mailedits.edit', $template->id)])
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- // END Header Layout Content -->

@push('after-scripts')

<script>
    $(function() {
        
        // JS code here

        $('button[data-type=publish]').on('click', function(e) {
            let template_id = $(this).attr('data-id');
            let action_type = $(this).attr('data-action');
            let published = (action_type == 'publish') ? 1 : 0;

            $.ajax({
                method: 'POST',
                url: "{{ route('template.publish') }}",
                data: {
                    id: template_id,
                    published: published
                },
                success: function(res) {
                    if (res.success) {
                        swal('Success', res.message, 'success');
                    }
                }
            })
        });
    });
</script>

@endpush

@endsection