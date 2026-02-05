@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.View Message'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.View Message') }}" :breadcrumbs="[
            ['name' => __('dashboard.Contact Messages'), 'url' => route('contact-messages.index')],
            ['name' => __('dashboard.View Message')]
        ]" />

                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Message Details') }}</h4>
                                        <div>
                                            @if($message->is_read)
                                                <span class="badge badge-success">{{ __('dashboard.read') }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ __('dashboard.unread') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <strong>{{ __('dashboard.name') }}:</strong>
                                                    <p class="mt-1">{{ $message->name }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <strong>{{ __('dashboard.email') }}:</strong>
                                                    <p class="mt-1">
                                                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <strong>{{ __('dashboard.phone') }}:</strong>
                                                    <p class="mt-1">
                                                        <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <strong>{{ __('dashboard.date') }}:</strong>
                                                    <p class="mt-1">{{ $message->created_at->format('Y-m-d H:i:s') }}</p>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <strong>{{ __('dashboard.message') }}:</strong>
                                                    <div class="mt-2 p-3 bg-light rounded">
                                                        <p style="white-space: pre-wrap;">{{ $message->message }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                @if(!$message->is_read)
                                                    <button type="button" class="btn btn-success"
                                                        onclick="markAsRead({{ $message->id }})">
                                                        <i class="feather icon-check"></i> {{ __('dashboard.mark_as_read') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="markAsUnread({{ $message->id }})">
                                                        <i class="feather icon-mail"></i> {{ __('dashboard.mark_as_unread') }}
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-danger"
                                                    onclick="deleteMessage({{ $message->id }})">
                                                    <i class="feather icon-trash"></i> {{ __('dashboard.delete') }}
                                                </button>
                                                <a href="{{ route('contact-messages.index') }}" class="btn btn-secondary">
                                                    <i class="feather icon-arrow-right"></i> {{ __('dashboard.back') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function markAsRead(id) {
            $.ajax({
                url: "{{ route('contact-messages.mark-as-read', ['id' => ':id']) }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('{{ __('dashboard.Success') }}', response.message || '', 'success');
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

        function markAsUnread(id) {
            $.ajax({
                url: "{{ route('contact-messages.mark-as-unread', ['id' => ':id']) }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('{{ __('dashboard.Success') }}', response.message || '', 'success');
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

        function deleteMessage(id) {
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
                        url: "{{ route('contact-messages.destroy', ['id' => ':id']) }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('{{ __('dashboard.deleted done') }}', response.message || '', 'success').then(() => {
                                    window.location.href = "{{ route('contact-messages.index') }}";
                                });
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