@extends('website.layouts.main')

@section('section')
    <nav class="artist-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Artists</li>
        </ol>
    </nav>
    <div class="artists-cards-container row gy-4 mt-3">
        @forelse ($artistsData as $artist)
        <div class="artist-card card bg-transparent col-md-6 col-lg-4 col-xl-3 border-0">
            <div class="artist-album-img-wrapper">
                <a href="{{ route('artist.detail', [$artist->slug])}}"><img src="{{asset('uploads/artists/'. $artist->image)}}"
                        class="card-img-top radius-12px w-100" alt="JUNGER"></a>
            </div>
            <div class="card-body p-0 py-3">
                <div class="artist-card-date-title-container mb-3">
                    <h4 class="artist-album-title font-weight-700 card-text text-white text-decoration-none m-0"><a
                            href="{{ route('artist.detail', [$artist->slug])}}" class="text-white text-decoration-none">{{$artist->name}}</a></h4>
                </div>
            </div>
        </div>
        @empty
           No Artist Found
        @endforelse

    </div>
@endsection
