<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                    class="ficon feather icon-maximize"></i></a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}"
                            href="{{ url()->current() == url('/') ? route('dashboard.home', ['locale' => 'ar']) : str_replace('/' . app()->getLocale() . '/', '/ar/', url()->current()) }}">
                            العربية
                        </a>
                        <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                            href="{{ url()->current() == url('/') ? route('dashboard.home', ['locale' => 'en']) : str_replace('/' . app()->getLocale() . '/', '/en/', url()->current()) }}">
                            English
                        </a>
                    </div>
                </div>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name text-bold-600">{{ auth('manager')->user()->name ?? 'Admin' }}</span><span
                                    class="user-status">{{ auth('manager')->user()->email ?? '' }}</span></div>
                            <span><img class="round"
                                    src="{{ asset('dashboardAssets/app-assets/images/logo/logo.png') }}" alt="avatar"
                                    height="40" width="40"></span>
                        </a>
                        <div style="width: 200px;" class="dropdown-menu dropdown-menu-right">
                            @if (auth('manager')->check())
                                <a class="dropdown-item" href="{{ route('settings.edit', ['setting' => 1]) }}"><i
                                        class="feather icon-user"></i> {{ __('dashboard.Edit Profile') }}</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('auth.logout') }}"><i
                                    class="feather icon-power"></i> {{ __('dashboard.Logout') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>