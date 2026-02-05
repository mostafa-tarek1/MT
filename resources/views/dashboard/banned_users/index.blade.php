@extends('base::components.dashboard.layouts.master')

@section('title')
    {{ __('dashboard.banned_users') }}
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                {{-- Breadcrumb --}}
                <section id="default-breadcrumb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb default-breadcrumb mb-0">
                                                <li class="breadcrumb-item">
                                                    <a
                                                        href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    {{ __('dashboard.banned_users') }}
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Search and Ban User --}}
                <section id="search-section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('dashboard.search_and_ban') }}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="GET" action="{{ route('dashboard.banned-users.index') }}">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="{{ __('dashboard.search_user') }}"
                                                        value="{{ request('search') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="feather icon-search"></i> {{ __('dashboard.search') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <hr>

                                        <h5>{{ __('dashboard.ban_new_user') }}</h5>
                                        <form method="POST" action="{{ route('dashboard.banned-users.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="{{ __('dashboard.user_phone') }}" required>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="reason" class="form-control"
                                                        placeholder="{{ __('dashboard.ban_reason') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-danger btn-block">
                                                        <i class="feather icon-user-x"></i> {{ __('dashboard.ban_user') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-2">
                                                @foreach ($errors->all() as $error)
                                                    <p class="mb-0">{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        @endif

                                        @if (session('success'))
                                            <div class="alert alert-success mt-2">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Banned Users List --}}
                <section id="banned-users-list">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('dashboard.banned_users_list') }}</h4>
                                    <div class="heading-elements">
                                        <span class="badge badge-pill badge-danger">{{ $banned->total() }}
                                            {{ __('dashboard.total_banned') }}</span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('dashboard.user_id') }}</th>
                                                        <th>{{ __('dashboard.user_name') }}</th>
                                                        <th>{{ __('dashboard.phone') }}</th>
                                                        <th>{{ __('dashboard.ban_reason') }}</th>
                                                        <th>{{ __('dashboard.banned_by') }}</th>
                                                        <th>{{ __('dashboard.banned_at') }}</th>
                                                        <th>{{ __('dashboard.status') }}</th>
                                                        <th>{{ __('dashboard.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($banned as $ban)
                                                        <tr>
                                                            <td>{{ $ban->user_id }}</td>
                                                            <td>
                                                                <strong>{{ $ban->user->name ?? 'N/A' }}</strong>
                                                            </td>
                                                            <td>{{ $ban->user->phone ?? 'N/A' }}</td>
                                                            <td>{{ $ban->reason ?? '-' }}</td>
                                                            <td>{{ $ban->banner->name ?? 'Admin' }}</td>
                                                            <td>{{ $ban->banned_at->format('Y-m-d H:i') }}</td>
                                                            <td>
                                                                @if ($ban->unbanned_at)
                                                                    <span
                                                                        class="badge badge-success">{{ __('dashboard.unbanned') }}</span>
                                                                    <br><small>{{ $ban->unbanned_at->format('Y-m-d H:i') }}</small>
                                                                @else
                                                                    <span
                                                                        class="badge badge-danger">{{ __('dashboard.banned') }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (!$ban->unbanned_at)
                                                                    <button type="button" class="btn btn-sm btn-success"
                                                                        onclick="confirmUnban({{ $ban->id }})">
                                                                        <i class="feather icon-check"></i>
                                                                        {{ __('dashboard.unban') }}
                                                                    </button>
                                                                @else
                                                                    <span class="text-muted">-</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8" class="text-center">
                                                                {{ __('dashboard.no_banned_users') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- Pagination --}}
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $banned->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    {{-- Unban Confirmation Modal --}}
    <div class="modal fade" id="unbanModal" tabindex="-1" role="dialog" aria-labelledby="unbanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="unbanModalLabel">
                        <i class="feather icon-check-circle"></i>
                        {{ __('dashboard.confirm_unban') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form id="unbanForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="feather icon-alert-circle font-large-2 text-warning"></i>
                        </div>
                        <p class="text-center">{{ __('dashboard.confirm_unban') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="feather icon-x"></i>
                            {{ __('dashboard.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="feather icon-check"></i>
                            {{ __('dashboard.unban') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmUnban(banId) {
            const form = document.getElementById('unbanForm');
            form.action = "{{ route('dashboard.banned-users.unban', ':id') }}".replace(':id', banId);
            $('#unbanModal').modal('show');
        }
    </script>
@endsection
