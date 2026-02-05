@props(['title' => null, 'breadcrumbs' => []])

<section id="default-breadcrumb">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb default-breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/{{ app()->getLocale() }}/dashboard">{{ __('dashboard.dashboard') }}</a>
                                </li>

                                @if (!empty($breadcrumbs))
                                    @foreach ($breadcrumbs as $breadcrumb)
                                        @if ($loop->last)
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ $breadcrumb['name'] ?? '' }}
                                            </li>
                                        @else
                                            <li class="breadcrumb-item">
                                                @if (isset($breadcrumb['route']))
                                                    <a href="{{ route($breadcrumb['route'], $breadcrumb['params'] ?? []) }}">
                                                        {{ $breadcrumb['name'] ?? '' }}
                                                    </a>
                                                @elseif (isset($breadcrumb['url']))
                                                    <a href="{{ $breadcrumb['url'] }}">
                                                        {{ $breadcrumb['name'] ?? '' }}
                                                    </a>
                                                @else
                                                    {{ $breadcrumb['name'] ?? '' }}
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                @elseif(!empty($title))
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $title }}
                                    </li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>