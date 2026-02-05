@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('dashboard.Add Role') }}
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
                                                {{ __('dashboard.Add Role') }}</li>
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
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('roles.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="w-100" for="display_name_ar"> {{ __('dashboard.Arabic Name') }}
                                            <input type="text" class="form-control" name="display_name_ar" required
                                                value="{{ old('display_name_ar') }}" />
                                            @error('display_name_ar')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="w-100" for="display_name_en"> {{ __('dashboard.English Name') }}
                                            <input type="text" class="form-control" name="display_name_en" required
                                                value="{{ old('display_name_en') }}" />
                                            @error('display_name_en')
                                                <span style="font-size: 12px;" class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="w-100" for="permissions">{{ __('dashboard.permissions') }}</label>
                                        @php
                                            $grouped = collect($permissions)->groupBy(function ($permission) {
                                                return explode(' ', $permission->name)[1] ?? 'other';
                                            });

                                            $actions = ['view', 'show', 'create', 'edit', 'delete'];
                                        @endphp

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @foreach ($actions as $action)
                                                        <th>{{ __('dashboard.' . $action) }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($grouped as $module => $modulePermissions)
                                                    <tr>
                                                        <td><strong>{{ __('dashboard.' . $module) }}</strong></td>
                                                        @foreach ($actions as $action)
                                                            @php
                                                                $permissionName = "$action $module";
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
                                                                        {{ in_array($perm->id, old('permissions', [])) ? 'checked' : '' }}>
                                                                @else
                                                                    <span class="text-muted">—</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>





                                        @error('permissions')
                                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md mr-1 mb-1">{{ __('dashboard.create') }}</button>
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
    <script></script>
@endsection
