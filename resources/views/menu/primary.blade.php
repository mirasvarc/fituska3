<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container" style="max-width:100% !important">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto ml-5">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">{{ __('Předměty') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user">{{ __('Uživatelé') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="">{{ __('Termíny') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/forum">{{ __('Diskuze') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontakty">{{ __('Kontakty') }}</a>
                </li>
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Přihlásit se') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrace') }}</a>
                        </li>
                    @endif
                @else


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Přihlášen jako <strong>{{ Auth::user()->username }}</strong> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">Profil</a>
                            @if(Auth::user()->isAdministrator() || Auth::user()->isSUManagement())

                                <a class="dropdown-item" href="{{ route('adminIndex') }}">{{ __('Administrace') }}</a>

                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Odhlásit') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
