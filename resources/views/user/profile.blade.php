@extends('layouts.backend.app')

@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">
    <div class="pt-32pt">
        <div
            class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">User Profile</h2>

                    <ol class="breadcrumb p-0 m-0">

                        <li class="breadcrumb-item active">
                            User Profile
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="flex" style="max-width: 100%">
                <div class="card dashboard-area-tabs p-relative o-hidden mb-0">
    
                    <div class="card-header p-0 nav">
                        <div class="row no-gutters" role="tablist">
    
                            <div class="col-auto">
                                <a href="#account" data-toggle="tab" role="tab" aria-selected="true"
                                    class="dashboard-area-tabs__tab card-body d-flex flex-row align-items-center justify-content-start active">
                                    <span class="flex d-flex flex-column">
                                        <strong class="card-title">Personal Information</strong>
                                    </span>
                                </a>
                            </div>
    
                            <div class="col-auto border-left border-right">
                                <a href="#password" data-toggle="tab" role="tab" aria-selected="false"
                                    class="dashboard-area-tabs__tab card-body d-flex flex-row align-items-center justify-content-start">
                                    <span class="flex d-flex flex-column">
                                        <strong class="card-title">Change Password</strong>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
    
                    <div class="card-body tab-content">
    
                        <!-- Tab Content for Profile Setting -->
                        <div id="account" class="tab-pane p-4 fade text-70 active show">
    
                            {!! Form::model($user, ['method' => 'POST', 'files' => true, 'route' =>
                            ['profile.update', $user->id]]) !!}
    
                            <div class="form-group">
                                <div class="media">
                                    <div class="media-left mr-32pt">
                                        <label class="form-label">Your Photo</label>
                                        <div class="profile-avatar mb-16pt">
                                            @if($user->avatar)
                                                <img src="{{ asset('/storage/avatars/' . $user->avatar) }}"
                                                    id="user_avatar" alt="people" width="250" class="rounded-circle" />
                                            @else
                                                <img src="{{ asset('/images/no-avatar.jpg') }}"
                                                    id="user_avatar" alt="people" width="250" class="rounded-circle" />
                                            @endif
                                        </div>
                                        <div>
                                            <div class="custom-file">
                                                <input type="file" name="avatar" class="custom-file-input" id="avatar_file"
                                                    data-preview="#user_avatar">
                                                <label class="custom-file-label" for="avatar_file">Choose File</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">User Name</label>
                                                    {!! Form::text('user_name', null, array('placeholder' => "User Name",'class' =>
                                                        'form-control')) !!}
                                                </div>
                                            </div>
    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email Address</label>
                                                    {!! Form::text('email', null, array('placeholder' => "Email Address",'class' =>
                                                        'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">First Name</label>
                                                    {!! Form::text('first_name', null, array('placeholder' => "First Name",'class' =>
                                                    'form-control')) !!}
                                                </div>
                                            </div>
    
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Last Name</label>
                                                    {!! Form::text('last_name', null, array('placeholder' => "Last Name",'class' =>
                                                    'form-control')) !!}
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Timezone</label>
                                                    <select name="timezone" class="form-control"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
    
                            {!! Form::close() !!}
                        </div>
    
                        <!-- Tab Content for Profile Setting -->
                        <div id="password" class="tab-pane p-4 fade text-70">
                            {!! Form::model($user, ['method' => 'POST', 'files' => true, 'route' =>
                            ['profile.update', $user->id]]) !!}
    
                            <div class="form-group mb-48pt">
                                <label class="form-label" for="current_pwd">Current Password:</label>
                                <input id="current_pwd" name="current_password" type="password" class="form-control" 
                                    placeholder="Current Password" >
                            </div>
    
                            <div class="form-group">
                                <label class="form-label" for="new_pwd">New Password:</label>
                                <input id="new_pwd" name="new_password" type="password" class="form-control" 
                                    placeholder="New Password" >
                            </div>
    
                            <div class="form-group">
                                <label class="form-label" for="cfm_pwd">Confirm Password:</label>
                                <input id="cfm_pwd" name="confirm_password" type="password" class="form-control" 
                                    placeholder="Confirm your new password ..." >
                            </div>
    
                            <input type="hidden" name="update_type" value="password">
    
                            <button type="submit" class="btn btn-primary mt-48pt">Save Changes</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('after-scripts')

    <!-- Timezone Picker -->
    <script src="{{ asset('assets/js/timezones.full.js') }}"></script>

    <script>
        
        $(function() {
            // Timezone
            $('select[name="timezone"]').timezones();
            if('{{ $user->timezone }}' != '') {
                $('select[name="timezone"]').val('{{ $user->timezone }}').change();
            }

            // Submit Form
            $('form').submit(function (e) {
                e.preventDefault();

                $(this).ajaxSubmit({
                    success: function (res) {
                        if (res.success) {
                            swal("Success!", "Successfully updated", "success");
                        } else {
                            swal("Error!", res.message, "error");
                        }
                    }
                });
            });
        })
    </script>

@endpush
