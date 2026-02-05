<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard.home') }}">
                    <div class="brand-logo">
                        <img style="width: 40px" src="{{ asset('dashboardAssets/app-assets/images/logo/logo.png') }}">
                    </div>
                    <h2 class="brand-text mb-0">ELRYAD</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Dashboard Home --}}
            <li class="nav-item {{ Route::is('dashboard.home') ? 'active' : '' }}">
                <a href="{{ route('dashboard.home') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">{{ __('dashboard.dashboard') }}</span>
                </a>
            </li>



            {{-- Website Content Management --}}
            <li
                class="nav-item has-sub {{ Route::is('header.*') || Route::is('hero.*') || Route::is('stats.*') || Route::is('services.*') || Route::is('why_choose_us.*') || Route::is('cta.*') || Route::is('footer.*') || Route::is('quote_modal.*') || Route::is('contact-messages.*') || Route::is('quote-requests.*') ? 'open' : '' }}">
                <a href="#">
                    <i class="feather icon-layout"></i>
                    <span class="menu-title" data-i18n="Structures">{{ __('dashboard.Structures') }}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('header.*') ? 'active' : '' }}">
                        <a href="{{ route('header.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Header">{{ __('dashboard.Header Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('hero.*') ? 'active' : '' }}">
                        <a href="{{ route('hero.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Hero">{{ __('dashboard.Hero Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('stats.*') ? 'active' : '' }}">
                        <a href="{{ route('stats.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Stats">{{ __('dashboard.Stats Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('services.*') ? 'active' : '' }}">
                        <a href="{{ route('services.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Services">{{ __('dashboard.Services Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('why_choose_us.*') ? 'active' : '' }}">
                        <a href="{{ route('why_choose_us.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Why Choose Us">{{ __('dashboard.Why Choose Us Section') }}</span>
                        </a>
                    </li>


                    <li class="{{ Route::is('cta.*') ? 'active' : '' }}">
                        <a href="{{ route('cta.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="CTA">{{ __('dashboard.CTA Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('footer.*') ? 'active' : '' }}">
                        <a href="{{ route('footer.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Footer">{{ __('dashboard.Footer Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('quote_modal.*') ? 'active' : '' }}">
                        <a href="{{ route('quote_modal.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Quote Modal">{{ __('dashboard.Quote Modal') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('contact-messages.*') ? 'active' : '' }}">
                        <a href="{{ route('contact-messages.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Contact Messages">{{ __('dashboard.Contact Messages') }}</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('quote-requests.*') ? 'active' : '' }}">
                        <a href="{{ route('quote-requests.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Quote Requests">{{ __('dashboard.Quote Requests') }}</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>