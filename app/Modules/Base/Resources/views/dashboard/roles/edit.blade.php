@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('dashboard.Edit Role') }}
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
            <!-- Breadcrumb -->
            <section id="default-breadcrumb">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb default-breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="/{{ app()->getLocale() }}/dashboard">{{ __('dashboard.dashboard') }}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ route('roles.index') }}">{{ __('dashboard.Roles List') }}</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ __('dashboard.Edit Role') }}</li>
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
                        <h4 class="card-title">{{ __('dashboard.Edit Role') }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('roles.update', [ 'id' => $role->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="hidden" name="id" value="{{ $role->id }}">
                                        <label class="w-100" for="display_name_en">{{ __('Display Name (English)') }}
                                            <input type="text" class="form-control" name="display_name_en"
                                                placeholder="{{ __('Display Name (English)') }}"
                                                value="{{ $role->display_name_en ?? old('display_name_en') }}" />
                                            @error('display_name_en')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="form-group col-6">
                                        <label class="w-100" for="display_name_ar">{{ __('Display Name (Arabic)') }}
                                            <input type="text" class="form-control" name="display_name_ar"
                                                placeholder="{{ __('Display Name (Arabic)') }}"
                                                value="{{ $role->display_name_ar ?? old('display_name_ar') }}" />
                                            @error('display_name_ar')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="form-group col-12">
                                        <label class="w-100" for="name">{{ __('Name (System)') }}
                                            <input type="text" class="form-control" name="name"
                                                placeholder="{{ __('name') }}" readonly
                                                value="{{ $role->name ?? old('name') }}" />
                                            @error('name')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>

                                    <div class="form-group col-12">
                                        <label class="w-100" for="permissions">{{ __('Permissions') }}</label>

                                        @php
                                            $grouped = collect($permissions)->groupBy(function ($permission) {
                                                // Permission name format: "module-action" like "users-create"
                                                $parts = explode('-', $permission->name);
                                                return $parts[0] ?? 'other';
                                            });

                                            $actions = ['create', 'read', 'update', 'delete'];
                                        @endphp

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach ($actions as $action)
                                                        <th>{{ ucfirst(__('dashboard.' . ucfirst($action))) }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($grouped as $module => $modulePermissions)
                                                    <tr>
                                                        <td><strong>{{ ucfirst(__('dashboard.' . $module)) }}</strong></td>
                                                        @foreach ($actions as $action)
                                                            @php
                                                                $permissionName = "$module-$action";
                                                                $perm = $modulePermissions->firstWhere(
                                                                    'name',
                                                                    $permissionName,
                                                                );
                                                            @endphp
                                                            <td class="text-center">
                                                                @if ($perm)
                                                                    <input type="checkbox" name="permissions[]"
                                                                        id="permission-{{ $perm->id }}"
                                                                        value="{{ $perm->id }}"
                                                                        {{ in_array($perm->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                                @else
                                                                    <span class="text-muted">—</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
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
