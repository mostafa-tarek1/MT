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

                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ __('dashboard.Quote Request Details') }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <strong>{{ __('dashboard.name') }}:</strong> {{ $request->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>{{ __('dashboard.phone') }}:</strong> {{ $request->phone }}
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <strong>{{ __('dashboard.date') }}:</strong> {{ $request->created_at->format('Y-m-d H:i') }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>{{ __('dashboard.status') }}:</strong>
                                                    @if($request->is_read)
                                                        <span class="badge badge-success">{{ __('dashboard.read') }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ __('dashboard.unread') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <hr>
                                            <h5 class="mb-2">{{ __('dashboard.items') }}</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('dashboard.product') }}</th>
                                                            <th>{{ __('dashboard.quantity') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($request->items as $item)
                                                            <tr>
                                                                <td>{{ $item['product'] ?? '-' }}</td>
                                                                <td>{{ $item['quantity'] ?? '-' }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="2" class="text-center">
                                                                    {{ __('dashboard.No data available') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>

                                            <a href="{{ route('quote-requests.index') }}" class="btn btn-secondary mt-2">
                                                <i class="feather icon-arrow-right"></i> {{ __('dashboard.back') }}
                                            </a>
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
