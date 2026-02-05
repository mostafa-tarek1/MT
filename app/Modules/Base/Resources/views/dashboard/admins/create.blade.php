@extends('base::components.dashboard.layouts.master')
@section('styles')
    @stack('datatableStyles')
    <style>
        .gov-option {
            font-weight: bold;
        }

        .city-option {
            margin: 20px;
        }

        .select2-results__option.city-option {
            padding-left: 20px !important;
        }
    </style>




@endsection
@section('title')
    {{__('Add Admin')}}
@endsection

<!-- BEGIN: Content-->
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
            <x-dashboard.layouts.breadcrumb now="{{__('Add Admin')}}">
                <li class="breadcrumb-item"><a href="{{route('managers.index')}}">
                        {{__('Admins List')}}
                    </a></li>
            </x-dashboard.layouts.breadcrumb>

            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('Add Admin')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('managers.store')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="w-100" for="name_en">{{__('dashboard.name')}}
                                            <input type="text" class="form-control" name="name" placeholder="{{__('dashboard.name')}}"
                                                value="{{old('name')}}" />
                                            @error('name')
                                                <span style="font-size: 12px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="w-100" for="name_en">{{__('dashboard.email')}}
                                            <input type="text" class="form-control" name="email"
                                                placeholder="{{__('dashboard.email')}}" value="{{old('email')}}" />
                                            @error('email')
                                                <span style="font-size: 12px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="w-100" for="phone">{{__('dashboard.phone')}}
                                            <input type="number" class="form-control" name="phone"
                                                placeholder="{{__('dashboard.phone')}}" value="{{old('phone')}}" />
                                            @error('phone')
                                                <span style="font-size: 12px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="is_active">{{ __('dashboard.status') }}</label>
                                        <select class="form-control" name="is_active" id="is_active">
                                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                                {{ __('dashboard.inactive') }}
                                            </option>
                                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                                {{ __('dashboard.active') }}
                                            </option>
                                        </select>
                                        @error('is_active')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="w-100" for="role">{{__('dashboard.role')}}</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ app()->getLocale() == 'ar' ? $role->display_name_ar : $role->display_name_en }}" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="password">{{ __('dashboard.password') }}</label>
                                        <div class="input-group">
                                            <!-- Password input field -->
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="{{ __('dashboard.password') }}" />

                                            <!-- Eye icon for toggling visibility (Outside the input field) -->
                                            <span class="input-group-append">
                                                <span class="input-group-text" id="toggle-password"
                                                    style="cursor: pointer;">
                                                    <i class="feather icon-eye" id="eye-icon"></i>
                                                </span>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Password Confirmation Input -->
                                    <div class="form-group col-sm-6">
                                        <label
                                            for="password_confirmation">{{ __('dashboard.password_confirmation') }}</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation"
                                                placeholder="{{ __('dashboard.password_confirmation') }}" />

                                            <span class="input-group-append">
                                                <span class="input-group-text" id="toggle-password-confirmation"
                                                    style="cursor: pointer;">
                                                    <i class="feather icon-eye" id="eye-icon-confirmation"></i>
                                                </span>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-md">{{__('dashboard.create')}}</button>
                                    </div>
                                </div>
                            </form>
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
        document.getElementById('toggle-password').addEventListener('click', function () {
            var passwordField = document.getElementById('password');
            var eyeIcon = document.getElementById('eye-icon');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("icon-eye");
                eyeIcon.classList.add("icon-eye-off");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("icon-eye-off");
                eyeIcon.classList.add("icon-eye");
            }
        });

        document.getElementById('toggle-password-confirmation').addEventListener('click', function () {
            var passwordConfirmationField = document.getElementById('password_confirmation');
            var eyeIconConfirmation = document.getElementById('eye-icon-confirmation');

            if (passwordConfirmationField.type === "password") {
                passwordConfirmationField.type = "text";
                eyeIconConfirmation.classList.remove("icon-eye");
                eyeIconConfirmation.classList.add("icon-eye-off");
            } else {
                passwordConfirmationField.type = "password";
                eyeIconConfirmation.classList.remove("icon-eye-off");
                eyeIconConfirmation.classList.add("icon-eye");
            }
        });
    </script>
@endsection