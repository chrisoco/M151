@if(isset($menu) && $menu)
    <style>
        .active {
            text-decoration: underline;
        }
    </style>
    @if(isset($school_class))
        <div class="side-menu visible">
            <div class="activator-bg"></div>
            <div class="menu-content">
                <span style="padding-top: 3em; padding-bottom: 1em;">{{ $school_class->intern_name }}</span>
                <a href="{{ route('school_class.show', $school_class) }}" @if(explode('.', Route::currentRouteName())[0] == 'school_class') class="active" @endif>Klasse</a>
                <hr />
                <a href="{{ route('enforcement.show', $school_class->enf1()) }}">1. Einsatz</a>
                <a href="{{ route('studentList.show', $school_class->enf1()) }}">Schülerliste</a>
                <a href="{{ route('skillset.edit'   , $school_class->enf1()) }}">Aufträge & Ziele</a>
                <a href="{{ route('grades.show'     , $school_class->enf1()) }}">Noten</a>
                <a href="{{ route('absences.index') }}" class="disabled">Absenzen</a>
                <hr />
                <a href="{{ route('enforcement.show', $school_class->enf2()) }}">2. Einsatz</a>
                <a href="{{ route('studentList.show', $school_class->enf2()) }}">Schülerliste</a>
                <a href="{{ route('skillset.edit'   , $school_class->enf2()) }}">Aufträge & Ziele</a>
                <a href="{{ route('grades.show'     , $school_class->enf2()) }}">Noten</a>
                <a href="{{ route('absences.index') }}" class="disabled">Absenzen</a>
                <hr />
            </div>
            <div class="activator" onclick="toggleSideMenu(this)">
                <i class="fas fa-angle-left"></i>
            </div>
        </div>
    @else
        @if(isset($enf))
            <div class="side-menu visible">
                <div class="activator-bg"></div>
                <div class="menu-content">
                    <span style="padding-top: 3em; padding-bottom: 1em;">{{ $enf->name }}</span>
                    <a href="{{ route('enforcement.show' , $enf) }}" @if(explode('.', Route::currentRouteName())[0] == 'enforcement') class="active" @endif>Einsatz</a>
                    <a href="{{ route('school_class.show', $enf->school_class) }}">Klasse</a>
                    <a href="{{ route('studentList.show' , $enf) }}" @if(explode('.', Route::currentRouteName())[0] == 'studentList') class="active" @endif>Schülerliste</a>
                    <a href="{{ route('skillset.edit'    , $enf) }}" @if(explode('.', Route::currentRouteName())[0] == 'skillset')    class="active" @endif>Aufträge & Ziele</a>
                    <a href="{{ route('grades.show'      , $enf) }}" @if(explode('.', Route::currentRouteName())[0] == 'grades')      class="active" @endif>Noten</a>
                    <hr />
                    <a href="{{ route('absences.index') }}" class="disabled">Absenzen</a>

                </div>
                <div class="activator" onclick="toggleSideMenu(this)">
                    <i class="fas fa-angle-left"></i>
                </div>
            </div>
        @else
            <div class="side-menu visible">
                <div class="activator-bg"></div>
                <div class="menu-content">
                    <span style="padding-top: 3em; padding-bottom: 1em;">{{ $active_enforcement->name }}</span>
                    <a href="{{ route('enforcement.show' , $active_enforcement) }}">Einsatz</a>
                    <a href="{{ route('school_class.show', $active_enforcement->school_class) }}">Klasse</a>
                    <a href="{{ route('student.index' ) }}"                     @if(explode('.', Route::currentRouteName())[0] == 'student')  class="active" @endif>Schülerliste</a>
                    <a href="{{ route('skillset.edit', $active_enforcement) }}" @if(explode('.', Route::currentRouteName())[0] == 'skillset') class="active" @endif>Aufträge & Ziele</a>
                    <a href="{{ route('grades.show'  , $active_enforcement) }}" @if(explode('.', Route::currentRouteName())[0] == 'grades')   class="active" @endif>Noten</a>
                    <hr />
                    <a href="{{ route('absences.index') }}" class="disabled">Absenzen</a>
                </div>
                <div class="activator" onclick="toggleSideMenu(this)">
                    <i class="fas fa-angle-left"></i>
                </div>
            </div>
        @endif
    @endif

    <script>
        function toggleSideMenu(element) {
            var menu = element.closest('.side-menu');
            if (menu.classList.contains("visible")) {
                menu.classList.remove("visible");
                menu.classList.add("hidden");
                window.sessionStorage.setItem("sideMenuOpen", false);
            } else {
                menu.classList.remove("hidden");
                menu.classList.add("visible");
                window.sessionStorage.setItem("sideMenuOpen", true);
            }
        }
        var sideMenuOpen = window.sessionStorage.getItem("sideMenuOpen");
        var menu = document.getElementsByClassName("side-menu")[0];
        if (sideMenuOpen == "true" || sideMenuOpen == null) {
            menu.classList.add("visible");
        } else {
            menu.classList.remove("visible");
        }
    </script>
@endif
