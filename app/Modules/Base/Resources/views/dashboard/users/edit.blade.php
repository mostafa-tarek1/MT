@extends('base::components.dashboard.layouts.master')

@section('title', __('dashboard.edit_user'))

@section('content')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}');
        </script>
    @endif

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Breadcrumb -->
                <section id="default-breadcrumb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb default-breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a
                                                        href="/{{ app()->getLocale() }}/dashboard">{{ __('dashboard.dashboard') }}</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a
                                                        href="{{ route('users.index') }}">{{ __('dashboard.Users List') }}</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    {{ __('dashboard.Edit User') }}
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('dashboard.edit_user') }}</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST"
                                    action="{{ route('users.update', ['id' => $user->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="form-group col-sm-6">
                                            <label for="name">{{ __('dashboard.name') }}</label>
                                            <input type="text" class="form-control" name="name" required
                                                placeholder="{{ __('dashboard.name') }}"
                                                value="{{ old('name', $user->name) }}" />
                                            @error('name')
                                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group col-sm-6">
                                            <label for="email">{{ __('dashboard.email') }}</label>
                                            <input type="email" class="form-control" name="email" required
                                                placeholder="{{ __('dashboard.email') }}"
                                                value="{{ old('email', $user->email) }}" />
                                            @error('email')
                                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="form-group col-sm-6">
                                            <label for="phone">{{ __('dashboard.phone') }}</label>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="{{ __('dashboard.phone') }}"
                                                value="{{ old('phone', $user->phone) }}" />
                                            @error('phone')
                                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Role Select -->
                                        <div class="form-group col-sm-6">
                                            <label for="role">{{ __('dashboard.Role') }}</label>
                                            <select class="form-control" name="role_id" required>
                                                <option value="">{{ __('Select Role') }}</option>
                                                @foreach ($Roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id', $user->roles->first()?->id) == $role->id ? 'selected' : '' }}>
                                                        {{ app()->getLocale() == 'ar' ? $role->display_name_ar : $role->display_name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Governorate Select - Hidden for now -->
                                        @if (false)
                                            <div class="form-group col-sm-6">
                                                <label for="governorate">{{ __('governorate') }}</label>
                                                <select class="form-control select2" id="governorate" name="governorate">
                                                    <option value="">{{ __('Select Governorate') }}</option>
                                                    @foreach ($Governorates as $Governorate)
                                                        <option value="{{ $Governorate->id }}"
                                                            {{ old('governorate', $user->governorate_id) == $Governorate->id ? 'selected' : '' }}>
                                                            {{ $Governorate->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('governorate')
                                                    <span class="text-danger"
                                                        style="font-size: 12px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif



                                        {{--                                    <!-- Password --> --}}
                                        {{--                                    <div class="form-group col-sm-6"> --}}
                                        {{--                                        <label for="password">{{ __('dashboard.password') }}</label> --}}
                                        {{--                                        <div class="input-group"> --}}
                                        {{--                                            <input type="password" class="form-control" name="password" id="password" --}}
                                        {{--                                                   placeholder="{{ __('dashboard.password') }}" /> --}}
                                        {{--                                            <span class="input-group-append"> --}}
                                        {{--                                                <span class="input-group-text" id="toggle-password" style="cursor: pointer;"> --}}
                                        {{--                                                    <i class="feather icon-eye" id="eye-icon"></i> --}}
                                        {{--                                                </span> --}}
                                        {{--                                            </span> --}}
                                        {{--                                        </div> --}}
                                        {{--                                        @error('password') --}}
                                        {{--                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span> --}}
                                        {{--                                        @enderror --}}
                                        {{--                                    </div> --}}

                                        {{--                                    <!-- Password Confirmation --> --}}
                                        {{--                                    <div class="form-group col-sm-6"> --}}
                                        {{--                                        <label for="password_confirmation">{{ __('dashboard.password_confirmation') }}</label> --}}
                                        {{--                                        <div class="input-group"> --}}
                                        {{--                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" --}}
                                        {{--                                                   placeholder="{{ __('dashboard.password_confirmation') }}" /> --}}
                                        {{--                                            <span class="input-group-append"> --}}
                                        {{--                                                <span class="input-group-text" id="toggle-password-confirmation" style="cursor: pointer;"> --}}
                                        {{--                                                    <i class="feather icon-eye" id="eye-icon-confirmation"></i> --}}
                                        {{--                                                </span> --}}
                                        {{--                                            </span> --}}
                                        {{--                                        </div> --}}
                                        {{--                                        @error('password_confirmation') --}}
                                        {{--                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span> --}}
                                        {{--                                        @enderror --}}
                                        {{--                                    </div> --}}

                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            {{ __('dashboard.save_changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Toggle visibility for the first password field
        // document.getElementById('toggle-password').addEventListener('click', function() {
        //     var passwordField = document.getElementById('password');
        //     var eyeIcon = document.getElementById('eye-icon');
        //
        //     if (passwordField.type === "password") {
        //         passwordField.type = "text";
        //         eyeIcon.classList.remove("icon-eye");
        //         eyeIcon.classList.add("icon-eye-off");
        //     } else {
        //         passwordField.type = "password";
        //         eyeIcon.classList.remove("icon-eye-off");
        //         eyeIcon.classList.add("icon-eye");
        //     }
        // });
        //
        // // Toggle visibility for the password confirmation field
        // document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
        //     var passwordConfirmationField = document.getElementById('password_confirmation');
        //     var eyeIconConfirmation = document.getElementById('eye-icon-confirmation');
        //
        //     if (passwordConfirmationField.type === "password") {
        //         passwordConfirmationField.type = "text";
        //         eyeIconConfirmation.classList.remove("icon-eye");
        //         eyeIconConfirmation.classList.add("icon-eye-off");
        //     } else {
        //         passwordConfirmationField.type = "password";
        //         eyeIconConfirmation.classList.remove("icon-eye-off");
        //         eyeIconConfirmation.classList.add("icon-eye");
        //     }
        // });
    </script>
@endsection
