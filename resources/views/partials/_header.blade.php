<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ url('/') }}">Control Activos</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="w-100">
        @auth()
            <span class="mx-2 text-light">Usuario actual: {{ Auth::user()->name }}</span>
        @endauth
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            @auth()
                <a class="nav-link px-3" href="{{ route('logout') }} " onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @endauth
        </div>
    </div>
</header>

