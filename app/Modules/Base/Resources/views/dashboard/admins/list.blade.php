@extends('base::components.dashboard.layouts.master')
@section('styles')
    @stack('datatableStyles')
@endsection
@section('title')
    {{__('Admins List')}}
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
                    <x-dashboard.layouts.breadcrumb now="{{__('Admins List')}}">
                    </x-dashboard.layouts.breadcrumb>
                    <!-- Column selectors with Export Options and print table -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">{{__('Admins List')}}</h4>
                                        @if (auth('manager')->check() && auth('manager')->user()->hasPermission('admins-create'))
                                            <x-dashboard.button-link 
                                                :href="route('managers.create', ['role' => 1])"
                                                variant="primary"
                                                icon="feather icon-plus"
                                            >
                                                {{__('Add Admin')}}
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
                                                            <th>{{__('dashboard.Name')}}</th>
                                                            <th>{{__('dashboard.Email')}}</th>
                                                            <th>{{__('dashboard.Phone')}}</th>
                                                            <th>{{__('dashboard.Role')}}</th>
                                                            <th>{{__('dashboard.Status')}}</th>
                                                            <th>{{__('dashboard.Actions')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($admins ?? [] as $admin)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $admin->name }}</td>
                                                                <td>{{ $admin->email }}</td>
                                                                <td>{{ $admin->phone ?? '-' }}</td>
                                                                <td>
                                                                    @foreach ($admin->roles ?? [] as $role)
                                                                        <span class="badge badge-primary">{{ $role->display_name }}</span>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($admin->is_active ?? 1)
                                                                        <span class="badge badge-success">{{__('dashboard.active')}}</span>
                                                                    @else
                                                                        <span class="badge badge-danger">{{__('dashboard.inactive')}}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('admins-update'))
                                                                        <x-dashboard.icon-link 
                                                                            :href="route('managers.edit', ['manager' => $admin->id])"
                                                                            variant="info"
                                                                            icon="feather icon-edit"
                                                                            tooltip="{{__('dashboard.edit')}}"
                                                                        />
                                                                    @endif
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('admins-delete'))
                                                                        <x-dashboard.icon-button 
                                                                            type="button"
                                                                            variant="danger"
                                                                            icon="feather icon-trash"
                                                                            onclick="deleteAdmin({{ $admin->id }})"
                                                                            tooltip="{{__('dashboard.delete')}}"
                                                                        />
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">
                                                                    {{__('dashboard.No data available')}}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
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
        function deleteAdmin(id) {
            Swal.fire({
                title: '{{__('dashboard.Are you sure ?')}}',
                text: '{{__('dashboard.delete')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{__('dashboard.Yes, delete')}}',
                cancelButtonText: '{{__('dashboard.No, cancel')}}',
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
                                Swal.fire('{{__('dashboard.deleted done')}}', response.message || '', 'success');
                                location.reload();
                            } else {
                                Swal.fire('{{__('dashboard.Error')}}', response.message || '{{__('dashboard.Something went wrong')}}', 'error');
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = '{{__('dashboard.Something went wrong')}}';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('{{__('dashboard.Error')}}', errorMessage, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection
