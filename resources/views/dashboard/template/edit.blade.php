@extends('layouts.backend.app')

@section('content')

@push('after-styles')

    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('assets/css/quill.css') }}" rel="stylesheet">

@endpush

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Edit Tempalte</h2>

                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('mailedits.index') }}">Email Templates</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Template
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" role="tablist">
                <div class="col-auto mr-3">
                    <a href="{{ route('mailedits.index') }}" class="btn btn-outline-secondary">Back</a>
                    <button id="btn_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">

        <div class="container page__container">
            <div class="row">
                <div class="col-md-6">
                    <div class="page-separator">
                        <div class="page-separator__text">Edit Form</div>
                    </div>

                    <div class="card m-0">
                        <div class="card-body">
                            {!! Form::open(['method' => 'PATCH', 'route' => ['mailedits.update', $template->id], 'files' => true, 'id'
                            => 'frm_template']) !!}

                            <div class="form-group">
                                <label class="form-label">Subject: </label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="{{ $template->subject }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Content</label>
                                <!-- quill editor -->
                                <div id="content_editor" class="mb-0" style="min-height: 30vh;">
                                    {!! $template->content !!}
                                </div>
                                <small class="form-text text-muted">Edit Content</small>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="page-separator">
                        <div class="page-separator__text">Preview</div>
                    </div>

                    <div class="prev_wrap" id="prev_wrap">
                        <div>
                            <!-- Main Section -->
                            <div class="shadow wrapper-container"
                                style="box-shadow: 0 20px 30px 0 rgba(0, 0, 0, 0.1); background: #ffffff; background-color: #ffffff; Margin: 0px auto; border-radius: 4px; max-width: 604px;"
                                bgcolor="#ffffff">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; background-color: #ffffff; width: 100%; border-radius: 4px;"
                                    bgcolor="#ffffff" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; direction: ltr; font-size: 0px; padding: 0 0 30px; text-align: center; vertical-align: top;"
                                                align="center">

                                                {!! $header->html_content !!}

                                                <!-- Separate Section -->
                                                <div style="Margin:0px auto;max-width:604px;">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; direction: ltr; font-size: 0px; padding: 0 50px 15px; text-align: left; vertical-align: top;" align="left">
                                                                    <div class="mj-column-px-25 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;" align="left" width="100%">
                                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top;" width="100%">
                                                                            <tbody><tr>
                                                                                <td class="left" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-size: 0px; padding: 10px 25px; padding-top: 0; padding-right: 0; padding-left: 0; word-break: break-word;">
                                                                                    <p style="display: block; border-top: solid 3px #505050; font-size: 1; margin: 0px auto; width: 25px; float: left;" width="25">
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div id="content_html">
                                                    {!! $template->html_content !!}
                                                </div>
                                                
                                                <!-- Separate Section -->
                                                <div style="Margin:0px auto;max-width:604px;">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; direction: ltr; font-size: 0px; padding: 0 50px 0; text-align: left; vertical-align: top;" align="left">
                                                                    <div class="mj-column-px-25 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;" align="left" width="100%">
                                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top;" width="100%">
                                                                            <tbody><tr>
                                                                                <td class="left" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-size: 0px; padding: 10px 25px; padding-top: 0; padding-right: 0; padding-left: 0; word-break: break-word;">
                                                                                    <p style="display: block; border-top: solid 3px #505050; font-size: 1; margin: 0px auto; width: 25px; float: left;" width="25">
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                {!! $footer->html_content !!}

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Footer Section -->
                            <div style="Margin:0px auto;max-width:604px;">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                    style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                                    width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; direction: ltr; font-size: 0px; padding: 20px 0; text-align: center; vertical-align: top;"
                                                align="center">
                                                <div class="mj-column-per-100 outlook-group-fix"
                                                    style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"
                                                    align="left" width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top;"
                                                        width="100%">
                                                        <tr>
                                                            <td align="center"
                                                                style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-size: 0px; padding: 10px 25px; word-break: break-word;">
                                                                <div style="font-family:Open sans, arial, sans-serif;font-size:14px;line-height:25px;text-align:center;color:#363A41;"
                                                                    align="center">
                                                                    <a id="preview_footer_link" href="{{ config('app.url') }}"
                                                                        style="text-decoration: underline; color: #656565; font-size: 16px; font-weight: 600;">{{ config('app.url') }}</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')

    <!-- Quill -->
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/quill.js') }}"></script>

    <script>
        $(function () {

            // Init Quill Editor
            var content_editor = new Quill('#content_editor', {
                theme: 'snow',
                placeholder: 'Email Content'
            });

            $('#content_editor').on('focusout', function(e) {
                var content_html = content_editor.root.innerHTML;
                $('#preview_content').html(content_html);
            });

            $('#btn_save').on('click', function(e) {
                $('#frm_template').submit();
            });

            $('#frm_template').on('submit', function(e) {
                e.preventDefault();

                $(this).ajaxSubmit({
                    beforeSubmit: function(formData, formObject, formOptions) {
                        var editor_content = content_editor.root.innerHTML;

                        formData.push({
                            name: 'template_type',
                            type: 'text',
                            value: 'body'
                        });

                        // Append
                        formData.push({
                            name: 'content',
                            type: 'text',
                            value: editor_content
                        });

                        formData.push({
                            name: 'html_content',
                            type: 'text',
                            value: $('#content_html').html()
                        });
                    },
                    success: function(res) {
                        if(res.success) {
                            swal('Success!', 'successfully Updataed', 'success');
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });

    </script>

@endpush

@endsection
