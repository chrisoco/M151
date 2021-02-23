<style>
    .navbar-nav .nav-item .nav-link {
        color: white;
    }

</style>

<nav class="navbar navbar-expand-md navbar-light bg-primary mb-2 sticky-top">
    <a class="navbar-brand mx-5 mx-md-1" @active_enforcement href="{{ route('dashboard_active') }}" @else href="{{ route('dashboard_inactive') }}" @endactive_enforcement>
        <img src="{{ asset('media/Alludo_Logo.png') }}" class="img-fluid" width="120" alt="Alludo Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @auth
            <ul class="navbar-nav">
                <li class="nav-item ml-lg-4">

                <!--<a class="nav-link" href="{ route('student.home', auth()->user()->student) }">Home</a>-->

                <a class="nav-link @if(explode('.', Route::currentRouteName())[0] == 'dashboard_active') active @endif"
                        @active_enforcement href="{{ route('dashboard_active') }}"
                        @else               href="{{ route('dashboard_inactive') }}"
                        @endactive_enforcement>Dashboard
                </a>
                </li>
                <li class="nav-item ml-lg-4">
                    <a class="nav-link @if(explode('.', Route::currentRouteName())[0] == 'planning') active @endif" href="{{ route('planning.index') }}">Planer</a>
                </li>
                <li class="nav-item ml-lg-4">
                    <a class="nav-link @if(explode('.', Route::currentRouteName())[0] == 'postProcessing') active @endif" href="{{ route('postProcessing.index') }}">Nachbearbeitung</a>
                </li>
                <li class="nav-item ml-lg-4">
                    <a class="nav-link @if(explode('.', Route::currentRouteName())[0] == 'archive') active @endif" href="{{ route('archive.index') }}">Archiv</a>
                </li>
                <li class="nav-item dropdown ml-lg-4">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Stammdaten
                    </a>
                    <div class="dropdown-menu mt-2" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('school.index') }}">Schulen</a>
                        <a class="dropdown-item" href="{{ route('department.index') }}">Abteilungen</a>
                        <a class="dropdown-item" href="{{ route('template.index') }}">Template: Aufträge & Ziele</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->

            <ul class="navbar-nav mr-xl-5 ml-auto">
                @if($active_enforcements->count() > 1)
                    <li class="nav-item large dropdown d-none d-md-block mr-xl-4">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $active_enforcement->name }}</i><span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                            @foreach($active_enforcements as $ac)
                                <form action="{{ route('changeActiveEnforcement') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="newActiveEnforcementID" value="{{ $ac->id }}">
                                    <input type="submit" class="dropdown-item" value="{{ $ac->name }}">
                                </form>
                            @endforeach
                        </div>
                    </li>
                @endif
                <li class="nav-item large mr-2 mr-xl-4 d-none d-md-block">
                    <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item large mr-2 mr-xl-4 d-none d-md-block">
                    <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                </li>
                <li class="nav-item large dropdown d-none d-md-block">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-users-cog"></i><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profil</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Admin hinzufügen</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="dropdown-item" value="{{ __('Logout') }}">
                        </form>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</nav>
