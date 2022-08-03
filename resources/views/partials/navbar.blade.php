<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="
height: 50px;">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">TK Istiqomah Agam</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="logout nav-item text-nowrap">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="nav-link px-3 bg-dark border-0">
                    <img src="{{ asset('svg/log-out.svg') }}" style="width: 1em"> Logout
                </button>
            </form>
        </div>
    </div>
</header>