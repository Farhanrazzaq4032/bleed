<!DOCTYPE html>
<html lang="en">
@include('website.layouts.head')

<body>
    <section class="py-md-4 px-md-5 py-2 px-3">
        <div class="container-xxl m-auto">
            @include('website.layouts.header')
            <div class="row">
                <div class="sidebar col-xl-3 col-lg-4 d-none d-lg-block p-0">
                    <div class="sidebar-container radius-12px min-vh-100">
                        <h2 class="page-title text-white py-4 px-5">Artist</h2>
                        <nav class="sidebar-nav ">
                            <div class="sidebar-nav-menu ">
                                <a href="{{ route('home') }}"
                                    class="menu-item d-block text-decoration-none text-white px-5 @if (Request::segment(1) == '') active @endif">All
                                    Artist</a>
                                @foreach ($artistsData as $item)
                                    <a href="{{ route('artist.releases', [$item->slug]) }}"
                                        class="menu-item d-block text-decoration-none text-white px-5 @if (Request::segment(2) == $item->slug) active @endif">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="main-content-p  col-xl-9 col-lg-8">
                    <div class="main-content bg-gradient-artist first-main radius-12px">
                        <div id="sidebarOffcanvas" class="offcanvas offcanvas-start bg-transparent">
                            <div class="sidebar-container radius-12px min-vh-100">
                                <h2 class="page-title text-white py-4 px-5">Artists</h2>
                                <nav class="sidebar-nav ">
                                    <div class="sidebar-nav-menu ">
                                        <a href="{{ route('home') }}"
                                            class="menu-item d-block text-decoration-none text-white px-5 @if (Request::segment(1) == '') active @endif">All
                                            Artist</a>
                                        @foreach ($artistsData as $item)
                                            <a href="{{ route('artist.releases', [$item->slug]) }}"
                                                class="menu-item d-block text-decoration-none text-white px-5 @if (Request::segment(2) == $item->slug) active @endif">{{ $item->name }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="main-content-wrapper">
                            <h2 class="page-title text-white">{{ isset($artist) ? $artist->name : 'All Artists' }}</h2>
                            <div class="artists-cards-container row gy-4 mt-3">
                                @forelse ($releases as $release)
                                    <div class="artist-card card bg-transparent col-md-6 col-xl-4 border-0">
                                        <div class="artist-album-img-wrapper">
                                            <a href="{{ route('release.detail', [$release->slug]) }}"><img
                                                    src="{{ asset('uploads/releases/' . $release->image) }}"
                                                    class="card-img-top radius-12px w-100"
                                                    alt="{{ $release->name }}"></a>
                                        </div>
                                        <div class="card-body p-0 py-3">
                                            <div class="artist-card-date-title-container d-flex mb-3">
                                                <h4
                                                    class="artist-album-title font-weight-700 card-text text-white text-decoration-none m-0">
                                                    <a href="{{ route('release.detail', [$release->slug]) }}"
                                                        class="text-white text-decoration-none">{{ \Illuminate\Support\Str::limit($release->name, 20, $end='...') }}</a>
                                                </h4>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3 mx-2">
                                                <p class="artist-album-release-date card-text text-white font-18 mb-0">
                                                    {{ \Carbon\Carbon::parse($release->release_date)->format('d-m-Y') }}
                                                </p>
                                                <a class="btn btnbn-c" href="{{ $release->artist->link }}" target="_blank" role="button">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-white">No Releases Found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
