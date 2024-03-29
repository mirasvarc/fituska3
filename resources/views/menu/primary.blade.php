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
                    <a class="nav-link" href="/forum">{{ __('Diskuze') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontakty">{{ __('Kontakty') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ __('Studentská unie') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user() && Auth::user()->isSUManagement())
                            <a class="dropdown-item" href="/hromadne">{{ __('Hromadné zprávy') }}</a>
                            <a class="dropdown-item" href="/su-forms">{{ __('Formuláře') }}</a>
                        @endif
                        <a class="dropdown-item" href="/su/files">{{ __('Sklad souborů') }}</a>
                        <a class="dropdown-item" href="/su-members">{{ __('Členové') }}</a>
                        <a class="dropdown-item" href="/su-contact">{{ __('Kontakt') }}</a>
                    </div>
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

                    <li class="nav-item" style="margin-right:20px">
                        <a class="nav-link text-white search-btn" href="#">Hledat &nbsp;<i class="fas fa-search text-white"></i></a>
                    </li>
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
<div class="search-block hidden">
    <input type="text" class="form-controller" id="search" name="search" autocomplete="off" placeholder="Hledaný výraz"></input>
    <div class="search-results">

    </div>
</div>

<script>
    $('.search-btn').on('click', function(){
        $('.search-block').toggle();
        $('#search').focus();
    });

</script>


<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
            type : 'get',
            url : '{{ URL::to('search') }}',
            data: { 'search' : $value },
            success: function(data) {
                $('.search-results').html(data);
            }
        });
    })

</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
