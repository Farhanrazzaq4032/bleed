<div class="mb-3 row">
    <nav class="header navbar navbar-expand-lg navbar-main align-items-stretch">
        <div
            class="logo-container logo-desktop radius-12px px-xxl-5 py-xxl-4 px-4 py-3 d-none d-lg-block align-content-center text-center col-xl-3 col-lg-4">
            <a href="{{route('home')}}"><img src="{{ asset('website') }}/assets/imgs/Logo.png" alt="logo" width="50px"></a>
        </div>
        <div class="logo-mobile d-lg-none">
            <a href="{{route('home')}}"><img src="{{ asset('website') }}/assets/imgs/Logo.png" alt="logo" class="mw-100"></a>
        </div>
        <button class="navbar-toggler custom-toggler shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navMenuToggler" aria-controls="navMenuToggler" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse artist-navbar-v2" id="navMenuToggler">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('home') }}"
                        class="nav-link text-white @if (Request::segment(1) == '' || Request::segment(1) == 'release') active @endif">Releases</a></li>
                <li class="nav-item">
                    <a href="{{ route('artists') }}"
                        class="nav-link text-white d-inline-block @if (Request::segment(1) == 'artists') active @endif">Artists</a>
                    <button class="border-0 p-0 d-lg-none text-white ms-2 bg-transparent" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarOffcanvas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16" stroke="currentColor" stroke-width="3">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>
                </li>
                <li class="nav-item"><a href="{{ route('service')}}" class="nav-link text-white @if (Request::segment(1) == 'service') active @endif" >Services</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}"
                        class="nav-link text-white @if (Request::segment(1) == 'contact') active @endif">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div id="sidebarOffcanvas" class="offcanvas offcanvas-start bg-transparent">
        <div class="sidebar-container radius-12px min-vh-100">
            <h2 class="page-title text-white py-4 px-5">Artists</h2>
            <nav class="sidebar-nav ">
                <div class="sidebar-nav-menu ">
                    <a href="{{route('home')}}"
                        class="menu-item d-block text-decoration-none text-white px-5 @if(Request::segment(1) == '') active @endif">All Artist</a>
                    @foreach ($artistsData as $item)
                        <a href="{{route('artist.releases', [$item->slug])}}"
                            class="menu-item d-block text-decoration-none text-white px-5 @if(Request::segment(2) == $item->slug) active @endif">{{$item->name}}</a>
                    @endforeach
                </div>
            </nav>
        </div>
    </div>
</div>
