@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('dashboard.Roles List') }}
@endsection
<!-- BEGIN: Content-->
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
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
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        {{ __('dashboard.Roles List') }}
                                                    </li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Column selectors with Export Options and print table -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">{{ __('dashboard.Roles List') }}</h4>
                                        @if (auth('manager')->check() && auth('manager')->user()->hasPermission('roles-create'))
                                            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-md">
                                                <i class="feather icon-plus mr-1"></i>{{ __('dashboard.Add Role') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('dashboard.Name') }}</th>
                                                            <th>{{ __('dashboard.Display Name') }}</th>
                                                            <th>{{ __('dashboard.Description') }}</th>
                                                            <th>{{ __('dashboard.Actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($roles as $role)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $role->name }}</td>
                                                                <td>{{ app()->getLocale() == 'ar' ? $role->display_name_ar : $role->display_name_en }}
                                                                </td>
                                                                <td>{{ $role->description }}</td>
                                                                <td>
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('roles-update'))
                                                                        <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                                            class="btn btn-sm btn-info">
                                                                            <i class="feather icon-edit"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('roles-delete'))
                                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                            onclick="deleteRole({{ $role->id }})">
                                                                            <i class="feather icon-trash"></i>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">
                                                                    {{ __('No data available') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $roles->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Column selectors with Export Options and print table -->
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
@endsection
<!-- END: Content-->
@section('script')
    <script>
        function deleteRole(id) {
            Swal.fire({
                title: '{{ __('dashboard.Are you sure ?') }}',
                text: '{{ __('dashboard.delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('dashboard.Yes, delete') }}',
                cancelButtonText: '{{ __('dashboard.No, cancel') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('roles.destroy', ['id' => ':id']) }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire('{{ __('dashboard.deleted done') }}', response.message || '', 'success');
                                location.reload();
                            } else {
                                Swal.fire('{{ __('dashboard.Error') }}', response.message || '{{ __('dashboard.Something went wrong') }}', 'error');
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = '{{ __('dashboard.Something went wrong') }}';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('{{ __('dashboard.Error') }}', errorMessage, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection