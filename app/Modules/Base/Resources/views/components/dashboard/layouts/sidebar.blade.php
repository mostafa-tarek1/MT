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
                class="nav-item has-sub {{ Route::is('hero.*') || Route::is('features.*') || Route::is('who_is_this_for.*') || Route::is('flexible_system.*') || Route::is('customer_reviews.*') || Route::is('cta.*') || Route::is('contact.*') || Route::is('contact-messages.*') ? 'open' : '' }}">
                <a href="#">
                    <i class="feather icon-layout"></i>
                    <span class="menu-title" data-i18n="Structures">{{ __('dashboard.Structures') }}</span>
                </a>
                <ul class="menu-content">

                    <li class="{{ Route::is('hero.*') ? 'active' : '' }}">
                        <a href="{{ route('hero.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Hero">{{ __('dashboard.Hero Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('features.*') ? 'active' : '' }}">
                        <a href="{{ route('features.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Features">{{ __('dashboard.Features Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('who_is_this_for.*') ? 'active' : '' }}">
                        <a href="{{ route('who_is_this_for.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Who Is This For">{{ __('dashboard.Who Is This For Section') }}</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('flexible_system.*') ? 'active' : '' }}">
                        <a href="{{ route('flexible_system.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Flexible System">{{ __('dashboard.Flexible System Section') }}</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('customer_reviews.*') ? 'active' : '' }}">
                        <a href="{{ route('customer_reviews.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Customer Reviews">{{ __('dashboard.Customer Reviews Section') }}</span>
                        </a>
                    </li>


                    <li class="{{ Route::is('cta.*') ? 'active' : '' }}">
                        <a href="{{ route('cta.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="CTA">{{ __('dashboard.CTA Section') }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('contact.*') ? 'active' : '' }}">
                        <a href="{{ route('contact.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item" data-i18n="Contact">{{ __('dashboard.Contact Section') }}</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('contact-messages.*') ? 'active' : '' }}">
                        <a href="{{ route('contact-messages.index') }}">
                            <i class="feather icon-zap"></i>
                            <span class="menu-item"
                                data-i18n="Contact Messages">{{ __('dashboard.Contact Messages') }}</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>