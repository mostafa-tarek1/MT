@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('dashboard.Admins List') }}
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
                <!-- managers list start -->
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
                                                        {{ __('dashboard.Admins List') }}</li>
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
                                        <h4 class="card-title">{{ __('dashboard.Admins List') }}</h4>
                                        @if (auth('manager')->check() && auth('manager')->user()->hasPermission('managers-create'))
                                            <x-dashboard.button-link :href="route('managers.create', ['role' => 1])" variant="primary"
                                                icon="feather icon-plus">
                                                {{ __('dashboard.Add Admin') }}
                                            </x-dashboard.button-link>
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
                                                            <th>{{ __('dashboard.Email') }}</th>
                                                            <th>{{ __('dashboard.Phone') }}</th>
                                                            <th>{{ __('dashboard.Role') }}</th>
                                                            <th>{{ __('dashboard.Status') }}</th>
                                                            <th>{{ __('dashboard.Actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($managers as $manager)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $manager->name }}</td>
                                                                <td>{{ $manager->email }}</td>
                                                                <td>{{ $manager->phone ?? '-' }}</td>
                                                                <td>
                                                                    @foreach ($manager->roles as $role)
                                                                        <span
                                                                            class="badge badge-primary">{{ $role->display_name }}</span>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($manager->is_active ?? 1)
                                                                        <span
                                                                            class="badge badge-success">{{ __('dashboard.active') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-danger">{{ __('dashboard.inactive') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('managers-update'))
                                                                        <x-dashboard.icon-link :href="route('managers.edit', [
                                                                            'manager' => $manager->id,
                                                                        ])"
                                                                            variant="info" icon="feather icon-edit"
                                                                            tooltip="{{ __('dashboard.edit') }}" />
                                                                        <x-dashboard.icon-button type="button"
                                                                            :variant="$manager->is_active
                                                                                ? 'warning'
                                                                                : 'success'" :icon="$manager->is_active
                                                                                ? 'feather icon-eye-off'
                                                                                : 'feather icon-eye'"
                                                                            onclick="toggleManager({{ $manager->id }})"
                                                                            :tooltip="$manager->is_active
                                                                                ? __('dashboard.deactivate')
                                                                                : __('dashboard.activate')" />
                                                                    @endif
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('managers-delete'))
                                                                        <x-dashboard.icon-button type="button"
                                                                            variant="danger" icon="feather icon-trash"
                                                                            onclick="deleteManager({{ $manager->id }})"
                                                                            tooltip="{{ __('dashboard.delete') }}" />
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">
                                                                    {{ __('dashboard.No data available') }}</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $managers->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Column selectors with Export Options and print table -->
                </section>
                <!-- managers list ends -->

            </div>
        </div>
    </div>
@endsection
<!-- END: Content-->
@section('script')
    <script>
        function toggleManager(id) {
            $.ajax({
                url: "{{ route('managers.toggle', ['id' => ':id']) }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.data && response.data.success) {
                        Swal.fire('{{ __('dashboard.success') }}', response.message ||
                            '{{ __('messages.updated_successfully') }}', 'success');
                        location.reload();
                    } else {
                        Swal.fire('{{ __('dashboard.error') }}', response.message ||
                            '{{ __('messages.Something went wrong') }}', 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('{{ __('dashboard.error') }}', xhr.responseJSON?.message ||
                        '{{ __('messages.Something went wrong') }}', 'error');
                }
            });
        }

        function deleteManager(id) {
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
                        url: "{{ route('managers.destroy', ['manager' => ':id']) }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('{{ __('dashboard.deleted done') }}', response.message || '',
                                    'success');
                                location.reload();
                            } else {
                                Swal.fire('{{ __('dashboard.Error') }}', response.message ||
                                    '{{ __('dashboard.Something went wrong') }}', 'error');
                            }
                        },
                        error: function(xhr) {
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
