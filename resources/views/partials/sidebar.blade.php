<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="padding-top: 0px; top: 40px;">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (Auth::user()->user_role == 0)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard-admin') ? 'active' : '' }}" aria-current="page"
                        href="/dashboard-admin">
                        <img src="{{ asset('svg/home.svg') }}" style="width: 1em" class="mb-1"> Dashboard
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'user_menu' ? 'active' : '' }}" href="/dashboard/users">
                        <img src="{{ asset('svg/user.svg') }}" style="width: 1em" class="mb-1"> Users
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'contact_message_menu' ? 'active' : '' }}"
                        href="/dashboard/contactmessage">
                        <img src="{{ asset('svg/inbox.svg') }}" style="width: 1em" class="mb-1">
                        Pesan Kontak
                    </a>
                </li>
                <hr class="my-1">
                <li class="nav-item">
                    <a class="nav-link {{ $sidebar_title == 'visimisi_menu' ? 'active' : '' }}"
                        href="/dashboard/visimisi">
                        <img src="{{ asset('svg/target.svg') }}" style="width: 1em" class="mb-1">
                        Visi Misi
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'structure_organization_menu' ? 'active' : '' }}"
                        href="/dashboard/structureorganization">
                        <img src="{{ asset('svg/users.svg') }}" style="width: 1em" class="mb-1">
                        Struktur Organisasi
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'teachers_menu' ? 'active' : '' }}"
                        href="/dashboard/teachers">
                        <img src="{{ asset('svg/heart.svg') }}" style="width: 1em" class="mb-1">
                        Tenaga Pengajar
                    </a>
                    <hr class="my-1">
                    <a class="nav-link {{ $sidebar_title == 'news_menu' ? 'active' : '' }}" href="/dashboard/news">
                        <img src="{{ asset('svg/file.svg') }}" style="width: 1em" class="mb-1">
                        Berita
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'news_category_menu' ? 'active' : '' }}"
                        href="/dashboard/achievement">
                        <img src="{{ asset('svg/award.svg') }}" style="width: 1em" class="mb-1">
                        Prestasi
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'facility_menu' ? 'active' : '' }}"
                        href="/dashboard/facility">
                        <img src="{{ asset('svg/anchor.svg') }}" style="width: 1em" class="mb-1">
                        Fasilitas
                    </a>
                    <a class="nav-link {{ $sidebar_title == 'extracurricular_menu' ? 'active' : '' }}"
                        href="/dashboard/extracurricular">
                        <img src="{{ asset('svg/star.svg') }}" style="width: 1em" class="mb-1">
                        Ektrakulikuler
                    </a>
                </li>
            @endif
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
