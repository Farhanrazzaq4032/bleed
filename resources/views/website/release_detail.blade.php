@extends('website.layouts.main')

@section('section')
    <nav class="artist-breadcrumb mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Realeses</a></li>
            <li class="breadcrumb-item active">{{ $release->name ?? '' }}</li>
        </ol>
    </nav>
    <section class="artist-details-wrapper">
        <div class="row gx-4 gx-lg-5 gy-4">
            <div class="col-md-6">
                <div class="artist-thumbnail-wrapper content-box-1">
                    <div class="artist-album-thumbnail">
                        <img src="{{ asset('uploads/releases/' . $release->image) }}" alt="{{ $release->name ?? '' }}"
                            class="w-100 radius-12px">
                    </div>
                    <div class="album-details-wrapper">
                        <div class="card-body p-0 pt-3 ">
                            <div class="artist-card-date-title-container d-flex mb-2 mt-lg-1">
                                <h4
                                    class="artist-album-title font-weight-700 card-text text-white text-decoration-none m-0 col-8">
                                    {{ $release->name ?? '' }}</h4>
                                <p class="artist-album-release-date card-text text-white text-right col-4">
                                    {{ \Carbon\Carbon::parse($release->release_date)->format('d-m-Y') }}</p>
                            </div>
                            <p class="artist-album-name mt-1 card-text text-white">{{ $release->artist->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="track-list-container content-box-2 radius-12px bg-darkgray">
                    <div class="section-title-bar">
                        <h3 class="section-title text-white font-weight-700">Track List</h3>
                    </div>
                    <div class="track-list-wrapper p-20px ">
                        <div class="tracks-list">
                            @forelse ($release->tracks as $track)
                                <div class="artist-track-item row align-items-center text-white mb-2 mb-lg-4 mb-md-3">
                                    <div class="track-title-thumbnail d-flex align-items-center col-10">
                                        <div class="track-thumbnail me-3 me-xl-4">
                                            @if($track->image)
                                                <img src="{{ asset('uploads/track_images/'. $track->image) }}" alt="">
                                            @else
                                            <img src="{{ asset('uploads/releases/' . $release->image) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="track-title">
                                            <h4 class="fw-normal">{{ $track->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="track-timeline text-right col-2">
                                        <span class="playback-time opacity-75">04:01</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-white">No Tracks Yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="detail-description content-box-container radius-12px bg-darkgray mt-60-r">
        <div class="section-title-bar">
            <h3 class="section-title text-white font-weight-700">Reviews</h3>
        </div>
        <div class="box-content p-20px text-white">
            <div class="album-reviews-container">
                @forelse ($release->reviews as $review)
                    <div class="album-review{{ !$loop->first ? ' mt-3' : '' }}">
                        <p class="font-18">{{ $review->description }}</p>
                        <div class="testimonial-details mt-3">
                            <div class="testimonial-name fw-bold ">
                                {{ $review->name }}
                            </div>
                            <div class="testimonial-star-rating">
                                <span class="star-rating-icons">
                                    <i class="bi-star-fill"></i>
                                    <i class="bi-star-fill"></i>
                                    <i class="bi-star-fill"></i>
                                    <i class="bi-star-half"></i>
                                    <i class="bi-star"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No Review Yet</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endpush()
