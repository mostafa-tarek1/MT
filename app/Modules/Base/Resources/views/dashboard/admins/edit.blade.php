@extends('base::components.dashboard.layouts.master')
@section('styles')
    @stack('datatableStyles')
    <style>
        .gov-option {
            font-weight: bold;
        }

        .city-option {
            margin: 20px;
            /* Adjust this as needed */
        }

        /* This applies to the Select2 rendered results */
        .select2-results__option.city-option {
            padding-left: 20px !important;
            /* Ensure padding is applied */
        }
    </style>
@endsection
@section('title')
    {{ __('Edit Admin') }}
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
            <x-dashboard.layouts.breadcrumb now="{{ __('Edit Admin') }}">
                <li class="breadcrumb-item"><a href="{{ route('managers.index') }}">
                        {{ __('Admins List') }}
                    </a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Edit Admin') }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('managers.update', [ 'manager' => $manager->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $manager->id }}">
                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                    <div class="form-group col-12 col-md-6">
                                        <label class="w-100" for="name">{{ __('dashboard.name') }}
                                            <input type="text" class="form-control" name="name"
                                                placeholder="{{ __('dashboard.name') }}"
                                                value="{{ $manager->name ?? old('name') }}" />
                                            @error('name')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>


                                    <div class="form-group col-12 col-md-6">
                                        <label class="w-100" for="email">{{ __('dashboard.email') }}
                                            <input type="text" class="form-control" name="email"
                                                placeholder="{{ __('dashboard.email') }}"
                                                value="{{ $manager->email ?? old('email') }}" />
                                            @error('email')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label class="w-100" for="phone">{{ __('dashboard.phone') }}
                                            <input type="number" class="form-control" name="phone"
                                                placeholder="{{ __('dashboard.phone') }}"
                                                value="{{ $manager->phone ?? old('phone') }}" />
                                            @error('phone')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>


                                    <div class="form-group col-sm-6">
                                        <label for="is_active">{{ __('dashboard.status') }}</label>
                                        <select name="is_active" class="form-control">
                                            <option value="0" {{ old('is_active', $manager->is_active) == 0 ? 'selected' : '' }}>
                                                {{ __('dashboard.inactive') }}
                                            </option>
                                            <option value="1" {{ old('is_active', $manager->is_active) == 1 ? 'selected' : '' }}>
                                                {{ __('dashboard.active') }}
                                            </option>
                                        </select>

                                        @error('is_active')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="w-100" for="role">{{ __('Role') }}</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ app()->getLocale() == 'ar' ? $role->display_name_ar : $role->display_name_en }}" />
                                    </div>





                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md mr-1 mb-1">{{ __('dashboard.edit') }}</button>
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
@endsection