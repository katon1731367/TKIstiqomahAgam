<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="padding-top: 0px; top: 40px;">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="/dashboard">
                        <img src="{{ asset('svg/home-icon.svg') }}" style="width: 1em" class="mb-1"> Dashboard
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'user_menu' ? 'active' : '' }}" href="/dashboard/users">
                        <img src="{{ asset('svg/user-icon.svg') }}" style="width: 1em" class="mb-1"> Users
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'contact_message_menu' ? 'active' : '' }}"
                        href="/dashboard/contactmessage">
                        <img src="{{ asset('svg/inbox-icon.svg') }}" style="width: 1em" class="mb-1">
                        Pesan Kontak
                    </a>
                </li>
                <hr class="my-1">
                <li class="nav-item">
                    <a class="nav-link {{ $sidebar_title == 'school_profile_menu' ? 'active' : '' }}"
                        href="/dashboard/schoolprofile">
                        <img src="{{ asset('svg/school-icon.svg') }}" style="width: 1em" class="mb-1">
                        Profil Sekolah
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'teachers_menu' ? 'active' : '' }}"
                        href="/dashboard/teachers">
                        <img src="{{ asset('svg/teacher-icon.svg') }}" style="width: 1em" class="mb-1">
                        Tenaga Pengajar
                    </a>
                    <hr class="my-1">
                    <a class="nav-link {{ $sidebar_title == 'news_menu' ? 'active' : '' }}" href="/dashboard/news">
                        <img src="{{ asset('svg/news-icon.svg') }}" style="width: 1em" class="mb-1">
                        Berita
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'achievement_menu' ? 'active' : '' }}"
                        href="/dashboard/achievement">
                        <img src="{{ asset('svg/award.svg') }}" style="width: 1em" class="mb-1">
                        Prestasi
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'facility_menu' ? 'active' : '' }}"
                        href="/dashboard/facility">
                        <img src="{{ asset('svg/facility-icon.svg') }}" style="width: 1em" class="mb-1">
                        Fasilitas
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'extracurricular_menu' ? 'active' : '' }}"
                        href="/dashboard/extracurricular">
                        <img src="{{ asset('svg/extracurricular-icon.svg') }}" style="width: 1em" class="mb-1">
                        Ektrakulikuler
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'featuredProgram_menu' ? 'active' : '' }}"
                        href="/dashboard/featuredprogram">
                        <img src="{{ asset('svg/star.svg') }}" style="width: 1em" class="mb-1">
                        Program Unggulan
                    </a>
                </li>
            <div class="logout-sidebar nav-link" style="display: none">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="nav-link px-3 bg-dark border-0">
                        <img src="{{ asset('svg/log-out.svg') }}" style="width: 1em"> <span
                            style="color: white">Logout</span>
                    </button>
                </form>
            </div>
            </li>
        </ul>
    </div>
</nav>
