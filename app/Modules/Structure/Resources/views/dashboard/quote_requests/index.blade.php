@extends('base::components.dashboard.layouts.master')
@section('title', __('dashboard.Quote Requests'))

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="users-list-wrapper">
                    <x-breadcrumb.breadcrumb title="{{ __('dashboard.Quote Requests') }}"
                        :breadcrumbs="[['name' => __('dashboard.Quote Requests')]]" />

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
                                            <form method="GET" action="{{ route('quote-requests.index') }}">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="{{ __('dashboard.search') }}"
                                                            value="{{ request('search') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select name="is_read" class="form-control">
                                                            <option value="">{{ __('dashboard.all_messages') }}</option>
                                                            <option value="0" {{ request('is_read') == '0' ? 'selected' : '' }}>{{ __('dashboard.unread') }}</option>
                                                            <option value="1" {{ request('is_read') == '1' ? 'selected' : '' }}>{{ __('dashboard.read') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            <i class="feather icon-search"></i> {{ __('dashboard.search') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('quote-requests.index') }}"
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

                    <!-- Requests Table -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">{{ __('dashboard.Quote Requests') }}</h4>
                                        <div>
                                            <span class="badge badge-primary">{{ $requests->total() }} {{ __('dashboard.total') }}</span>
                                            <span class="badge badge-warning">{{ \App\Modules\Structure\Models\QuoteRequest::where('is_read', false)->count() }} {{ __('dashboard.unread') }}</span>
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
                                                            <th>{{ __('dashboard.phone') }}</th>
                                                            <th>{{ __('dashboard.items') }}</th>
                                                            <th>{{ __('dashboard.status') }}</th>
                                                            <th>{{ __('dashboard.date') }}</th>
                                                            <th>{{ __('dashboard.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($requests as $request)
                                                            <tr class="{{ !$request->is_read ? 'table-warning' : '' }}">
                                                                <td>{{ $request->id }}</td>
                                                                <td>{{ $request->name }}</td>
                                                                <td>{{ $request->phone }}</td>
                                                                <td>
                                                                    <div style="max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                                        {{ collect($request->items)->pluck('product')->implode(', ') }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    @if($request->is_read)
                                                                        <span class="badge badge-success">{{ __('dashboard.read') }}</span>
                                                                    @else
                                                                        <span class="badge badge-warning">{{ __('dashboard.unread') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                                                <td>
                                                                    <x-dashboard.icon-link :href="route('quote-requests.show', ['id' => $request->id])"
                                                                        variant="info" icon="feather icon-eye"
                                                                        tooltip="{{ __('dashboard.view') }}" />
                                                                    @if($request->is_read)
                                                                        <x-dashboard.icon-button type="button"
                                                                            variant="warning" icon="feather icon-mail"
                                                                            onclick="markAsUnread({{ $request->id }})"
                                                                            tooltip="{{ __('dashboard.mark_as_unread') }}" />
                                                                    @else
                                                                        <x-dashboard.icon-button type="button"
                                                                            variant="success" icon="feather icon-check"
                                                                            onclick="markAsRead({{ $request->id }})"
                                                                            tooltip="{{ __('dashboard.mark_as_read') }}" />
                                                                    @endif
                                                                    <x-dashboard.icon-button type="button"
                                                                        variant="danger" icon="feather icon-trash"
                                                                        onclick="deleteRequest({{ $request->id }})"
                                                                        tooltip="{{ __('dashboard.delete') }}" />
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">
                                                                    {{ __('dashboard.No data available') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                {{ $requests->links() }}
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
                url: "{{ route('quote-requests.mark-as-read', ['id' => ':id']) }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('{{ __('dashboard.Success') }}', response.message || '', 'success');
                        location.reload();
                    } else {
                        Swal.fire('{{ __('dashboard.Error') }}', response.message || '{{ __('dashboard.Something went wrong') }}', 'error');
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

        function markAsUnread(id) {
            $.ajax({
                url: "{{ route('quote-requests.mark-as-unread', ['id' => ':id']) }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('{{ __('dashboard.Success') }}', response.message || '', 'success');
                        location.reload();
                    } else {
                        Swal.fire('{{ __('dashboard.Error') }}', response.message || '{{ __('dashboard.Something went wrong') }}', 'error');
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

        function deleteRequest(id) {
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
                        url: "{{ route('quote-requests.destroy', ['id' => ':id']) }}".replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('{{ __('dashboard.deleted done') }}', response.message || '', 'success');
                                location.reload();
                            } else {
                                Swal.fire('{{ __('dashboard.Error') }}', response.message || '{{ __('dashboard.Something went wrong') }}', 'error');
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
