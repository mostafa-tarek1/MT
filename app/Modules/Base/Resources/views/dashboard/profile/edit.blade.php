@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('auth.edit_profile') }}
@endsection
<!-- BEGIN: Content-->
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ __('auth.Edit Profile') }}</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('dashboard.home') }}">{{ __('dashboard.home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ __('auth.Edit Profile') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('auth.Edit Personal Data') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST"
                                    action="{{ route('settings.update', [ 'setting' => auth()->id()]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <label class="w-100" for="name">{{ __('auth.name') }}
                                                <input type="text" class="form-control" required name="name"
                                                    placeholder="{{ __('auth.name') }}"
                                                    value="{{ auth()->user()->name ?? old('name') }}" />
                                                @error('name')
                                                    <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="w-100" for="email">{{ __('auth.email') }}
                                                <input type="email" class="form-control" required name="email"
                                                    placeholder="{{ __('auth.email') }}"
                                                    value="{{ auth()->user()->email ?? old('email') }}" />
                                                @error('email')
                                                    <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md mr-1 mb-1">{{ __('auth.edit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('auth.Edit Password') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{ route('update-password') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <div class="form-group col-4">
                                            <label class="w-100" for="current_password">{{ __('auth.current password') }}
                                                <input type="password" required class="form-control show_pass_profile_page"
                                                    name="current_password" placeholder="{{ __('auth.current password') }}"
                                                    value="{{ old('current_password') }}" />
                                                @error('current_password')
                                                    <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="w-100" for="new_password">{{ __('auth.new password') }}
                                                <input type="password" required class="form-control show_pass_profile_page"
                                                    name="new_password" placeholder="{{ __('auth.new password') }}"
                                                    value="{{ old('new_password') }}" />
                                                @error('new_password')
                                                    <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="w-100"
                                                for="new_password_confirmation">{{ __('auth.password confirmation') }}
                                                <input type="password" required class="form-control show_pass_profile_page"
                                                    name="new_password_confirmation"
                                                    placeholder="{{ __('auth.password confirmation') }}"
                                                    value="{{ old('password_confirmation') }}" />
                                                @error('password_confirmation')
                                                    <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="mx-2 mb-2" style="margin-top:-10px">
                                            <label for="">
                                                {{ __('auth.show password') }}
                                                <input type="checkbox" name="test" value="show" id='show_pass_profile_page2'
                                                    onchange="show_pass_profile_page_Fn2()">
                                            </label>
                                        </div>
                                        {{-- <p class=" m-2 col-12  row"> يفضل في كلمة المرور أن : تكون باللغة الانجليزية -
                                            تتكون من 8 محارف على الأقل - تحتوي على الأقل على
                                            [حرف كبير --- حرف صغير --- رقم --- رمز مثل # أو $ ] </p> --}}
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md mr-1 mb-1">{{ __('auth.edit') }}</button>
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
        function show_pass_profile_page_Fn2(e) {
            // alert($('#show_pass_profile_page2:checked').val())
            for (val of [0, 1, 2]) {
                if ($('#show_pass_profile_page2:checked').val() === 'show') {
                    $('.show_pass_profile_page')[val].setAttribute('type', 'text')
                } else {
                    $('.show_pass_profile_page')[val].setAttribute('type', 'password')
                }
            }
        }
    </script>
@endsection