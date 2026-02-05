@extends('base::components.dashboard.layouts.master')
@section('title')
    {{ __('dashboard.User Details') }}
@endsection
<!-- BEGIN: Content-->
@section('content')
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
                                                    href="{{ route('users.index') }}">{{ __('dashboard.Users List') }}</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ __('dashboard.User Details') }}
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="content-body">
                <section class="users-view">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('dashboard.User Details') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>{{ __('dashboard.Name') }}:</th>
                                                        <td>{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('dashboard.Email') }}:</th>
                                                        <td>{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('dashboard.Phone') }}:</th>
                                                        <td>{{ $user->phone ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('dashboard.Created At') }}:</th>
                                                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ __('dashboard.Updated At') }}:</th>
                                                        <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <a href="{{ route('users.edit', [ 'id' => $user->id]) }}"
                                                class="btn btn-primary btn-md">
                                                <i class="feather icon-edit"></i> {{ __('dashboard.Edit') }}
                                            </a>
                                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-md">
                                                <i class="feather icon-arrow-left"></i> {{ __('dashboard.Back') }}
                                            </a>
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
@endsection