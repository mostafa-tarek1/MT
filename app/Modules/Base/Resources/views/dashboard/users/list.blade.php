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
                                                        {{ __('dashboard.Users List') }}
                                                    </li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Search and Filter Section -->
                    <section id="search-section">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('dashboard.search_and_filter') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form method="GET" action="{{ route('users.index') }}">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="{{ __('dashboard.search_users_placeholder') }}"
                                                            value="{{ request('search') }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            <i class="feather icon-search"></i> {{ __('dashboard.search') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('users.index') }}"
                                                            class="btn btn-secondary btn-block">
                                                            <i class="feather icon-x"></i> {{ __('dashboard.clear_filter') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
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
                                        <h4 class="card-title">{{ __('dashboard.Users List') }}</h4>
                                        <div class="d-flex gap-2">
                                            @if (auth('manager')->check() && auth('manager')->user()->hasPermission('users-create'))
                                                <x-dashboard.button-link :href="route('users.create')" variant="primary"
                                                    icon="feather icon-plus">
                                                    {{ __('dashboard.Add User') }}
                                                </x-dashboard.button-link>
                                            @endif
                                            <x-dashboard.button-link :href="route('dashboard.banned-users.index')" variant="danger"
                                                icon="feather icon-user-x">
                                                {{ __('dashboard.banned_users') }}
                                            </x-dashboard.button-link>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('dashboard.id') }}</th>
                                                            <th>{{ __('dashboard.name') }}</th>
                                                            <th>{{ __('dashboard.email') }}</th>
                                                            <th>{{ __('dashboard.phone') }}</th>
                                                            <th>{{ __('dashboard.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($users as $user)
                                                            <tr>
                                                                <td>{{ $user->id }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->phone ?? '-' }}</td>
                                                                <td>
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('users-read'))
                                                                        <x-dashboard.icon-link :href="route('users.show', [
                                                                            'id' => $user->id,
                                                                        ])"
                                                                            variant="success" icon="feather icon-eye"
                                                                            tooltip="{{ __('dashboard.view') }}" />
                                                                    @endif
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('users-update'))
                                                                        <x-dashboard.icon-link :href="route('users.edit', [
                                                                            'id' => $user->id,
                                                                        ])"
                                                                            variant="info" icon="feather icon-edit"
                                                                            tooltip="{{ __('dashboard.edit') }}" />
                                                                    @endif
                                                                    @if (auth('manager')->check() && auth('manager')->user()->hasPermission('users-delete'))
                                                                        <x-dashboard.icon-button type="button"
                                                                            variant="warning" icon="feather icon-slash"
                                                                            onclick="banUser('{{ $user->phone }}', '{{ $user->name }}')"
                                                                            tooltip="{{ __('dashboard.ban_user') }}" />
                                                                        <x-dashboard.icon-button type="button"
                                                                            variant="danger" icon="feather icon-trash"
                                                                            onclick="deleteUser({{ $user->id }})"
                                                                            tooltip="{{ __('dashboard.delete') }}" />
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
                                                {{ $users->links() }}
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
        function banUser(phone, userName) {
            Swal.fire({
                title: '{{ __('dashboard.ban_user_confirm') }}',
                html: `
                    <div class="text-left">
                        <p><strong>{{ __('dashboard.user_name') }}:</strong> ${userName}</p>
                        <p><strong>{{ __('dashboard.phone') }}:</strong> ${phone}</p>
                        <hr>
                        <label for="ban-reason">{{ __('dashboard.ban_reason') }}:</label>
                        <textarea id="ban-reason" class="swal2-input" placeholder="{{ __('dashboard.enter_ban_reason') }}" rows="3" style="width: 100%;"></textarea>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('dashboard.Yes_ban') }}',
                cancelButtonText: '{{ __('dashboard.No, cancel') }}',
                confirmButtonColor: '#d33',
                preConfirm: () => {
                    const reason = document.getElementById('ban-reason').value;
                    return {
                        reason: reason
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('dashboard.banned-users.store') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            phone: phone,
                            reason: result.value.reason
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('{{ __('dashboard.banned_successfully') }}', response
                                    .message || '',
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

        function deleteUser(id) {
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
                        url: "{{ route('users.destroy', ['id' => ':id']) }}".replace(':id', id),
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
