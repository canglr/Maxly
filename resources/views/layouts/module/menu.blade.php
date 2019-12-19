<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="fas fa-link"></i> {{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if (Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="/go/mylinks">My links {{ Session::get('admin') }}</a>
                </li>
                @endif
                @if (isRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-crown"></i> Management panel
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/admin/dashboard"><i class="fas fa-chart-pie"></i> Dashboard</a>
                        <a class="dropdown-item" href="/admin/users"><i class="fas fa-users"></i> Users</a>
                        <a class="dropdown-item" href="/admin/links"><i class="fas fa-link"></i> Links</a>
                        <a class="dropdown-item" href="/admin/pages"><i class="fas fa-book"></i> Pages</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin/roles"><i class="fas fa-user-shield"></i> Roles</a>
                        <a class="dropdown-item" href="/admin/logs"><i class="fas fa-archive"></i> Logs</a>
                    </div>
                </li>
                @endif
            </ul>

            <div class="navbar-nav my-2 my-lg-0">
                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=24" class="rounded-circle" alt="..."> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/go/myaccount">My account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </div>
</nav>
