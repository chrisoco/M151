<style>
    .navbar-nav .nav-item .nav-link {
        color: white;
    }

</style>

<nav class="navbar navbar-expand-md navbar-light bg-primary mb-2 sticky-top">
    <a class="navbar-brand mx-1" href="{ { route('dashboard_active') }}">
        <img src="{{ asset('media/logo3.png') }}" class="img-fluid" width="100" alt="Wer wird Millionär Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->

            <ul class="navbar-nav">
                <li class="nav-item ml-lg-4">
                    <a class="nav-link @if(explode('.', Route::currentRouteName())[0] == '') active @endif" href="{{ route('index') }}">Startseite</a>
                </li>

                @auth
                    <li class="nav-item dropdown ml-lg-4">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Daten
                        </a>
                        <div class="dropdown-menu mt-2" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{ { route('school.index') }}">Schulen</a>
                            <a class="dropdown-item" href="{ { route('department.index') }}">Abteilungen</a>
                            <a class="dropdown-item" href="{ { route('template.index') }}">Template: Aufträge & Ziele</a>
                        </div>
                    </li>
                @endauth

            </ul>

            <!-- Right Side Of Navbar -->

            <ul class="navbar-nav mr-5 ml-auto">

                @auth
                <li class="nav-item large dropdown d-none d-md-block">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-users-cog"></i><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{ { route('profile') }}">Profil</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Admin hinzufügen</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" class="dropdown-item" value="{{ __('Logout') }}">
                            </form>

                    </div>
                </li>

                @else
                    <a class="btn btn-primary" href="{{ route('login') }}">LogIn</a>
                @endauth

            </ul>

    </div>
</nav>
