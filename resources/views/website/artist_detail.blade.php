@extends('website.layouts.main')

@section('section')
    <nav class="artist-breadcrumb mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('artists') }}">Artists</a></li>
            <li class="breadcrumb-item active">{{ $artist->name }}</li>
        </ol>
    </nav>
    <section class="artist-details-wrapper">
        <div class="row gx-4 gx-lg-5 gy-4">
            <div class="col-md-6">
                <div class="artist-thumbnail-wrapper content-box-1">
                    <img src="{{ asset('uploads/artists/' . $artist->image) }}" alt="" class="w-100 radius-12px">
                </div>
            </div>

            <div
                class="booking-agent-wrapper col-md-6{{ !$artist->agents->isEmpty() || !empty($artist->description) || !$artist->downloads->isEmpty() ? '' : 'd-none' }}">
                <div class="booking-agent-details-wrapper content-box-2 radius-12px bg-darkgray text-white">
                    @if (!$artist->agents->isEmpty())
                        <div class="section-title-bar">
                            <h3 class="section-title text-white font-weight-700">Booking Agent</h3>
                        </div>
                        <div class="card-body mx-4 mt-3">
                            @forelse ($artist->agents as $agent)
                                <div class="d-flex align-items-center mb-3 artist-thumbnail">
                                    <img src="{{ asset('website/assets/imgs/man.png') }}" alt="{{ $agent->name }}">
                                    <div class="ms-3">
                                        <h5 class="mb-1 name-center">{{ $agent->name }}</h5>
                                        @if (!empty($agent->phone))
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-telephone me-2"></i>
                                                <span>{{ $agent->phone }}</span>
                                            </div>
                                        @endif
                                        @if (!empty($agent->email))
                                            <div class="d-flex align-items-center box-content">
                                                <i class="bi bi-envelope me-2"></i>
                                                <span>{{ $agent->email }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                No Agent Yet
                            @endforelse
                        </div>
                    @elseif (!empty($artist->description))
                        <div class="section-title-bar">
                            <h3 class="section-title text-white font-weight-700">Description</h3>
                        </div>
                        <div class="box-content p-20px text-white">
                            <p class="font-18">{{ $artist->description }}</p>
                        </div>
                    @elseif (!$artist->downloads->isEmpty())
                    <div class="section-title-bar">
                        <h3 class="section-title text-white font-weight-700">Downloads</h3>
                    </div>
                    <div class="card-body mx-4 mt-3 pb-2">
                        @forelse ($artist->downloads as $download)
                            <div class="mb-3">
                                <a class="link-primary text-decoration-none"
                                    href="{{ asset('uploads/artist_downloads/' . $download->file) }}"
                                    alt="{{ $download->name }}" target="_blank">{{ $download->name }}</a>
                            </div>
                        @empty
                            No Downloads Yet
                        @endforelse
                    </div>
                    @endif
                </div>
            </div>
    </section>
    <div class="row {{ !$artist->agents->isEmpty() || !empty($artist->description) || !$artist->downloads->isEmpty() ? '' : 'd-none' }}">
        @if(!$artist->agents->isEmpty() && !empty($artist->description))
        <div
            class="col-md-{{ $artist->downloads->isEmpty() ? '12' : '8' }} {{ empty($artist->description) ? ' d-none' : '' }}">
            <section class="detail-description content-box-container radius-12px bg-darkgray mt-60-r">
                <div class="section-title-bar">
                    <h3 class="section-title text-white font-weight-700">Description</h3>
                </div>
                <div class="box-content p-20px text-white">
                    <p class="font-18">{{ $artist->description }}</p>
                </div>
            </section>
        </div>
        @elseif(!$artist->agents->isEmpty() && !$artist->downloads->isEmpty())
        <div class="booking-agent-wrapper col-md-12 mt-60-r ">
            <div class="booking-agent-details-wrapper content-box-2 radius-12px bg-darkgray text-white">
                <div class="section-title-bar">
                    <h3 class="section-title text-white font-weight-700">Downloads</h3>
                </div>
                <div class="card-body mx-4 mt-3 pb-2">
                    @forelse ($artist->downloads as $download)
                        <div class="mb-3">
                            <a class="link-primary text-decoration-none"
                                href="{{ asset('uploads/artist_downloads/' . $download->file) }}"
                                alt="{{ $download->name }}" target="_blank">{{ $download->name }}</a>
                        </div>
                    @empty
                        No Downloads Yet
                    @endforelse
                </div>
            </div>
        </div>
        @elseif(!empty($artist->description) && !$artist->downloads->isEmpty())
        <div class="booking-agent-wrapper col-md-12 mt-60-r ">
            <div class="booking-agent-details-wrapper content-box-2 radius-12px bg-darkgray text-white">
                <div class="section-title-bar">
                    <h3 class="section-title text-white font-weight-700">Downloads</h3>
                </div>
                <div class="card-body mx-4 mt-3 pb-2">
                    @forelse ($artist->downloads as $download)
                        <div class="mb-3">
                            <a class="link-primary text-decoration-none"
                                href="{{ asset('uploads/artist_downloads/' . $download->file) }}"
                                alt="{{ $download->name }}" target="_blank">{{ $download->name }}</a>
                        </div>
                    @empty
                        No Downloads Yet
                    @endforelse
                </div>
            </div>
        </div>
        @endif
        <div class="booking-agent-wrapper col-md-4 mt-60-r {{ !$artist->agents->isEmpty() && !empty($artist->description) && !$artist->downloads->isEmpty() ? '' : 'd-none' }}">
            <div class="booking-agent-details-wrapper content-box-2 radius-12px bg-darkgray text-white">
                <div class="section-title-bar">
                    <h3 class="section-title text-white font-weight-700">Downloads</h3>
                </div>
                <div class="card-body mx-4 mt-3 pb-2">
                    @forelse ($artist->downloads as $download)
                        <div class="mb-3">
                            <a class="link-primary text-decoration-none"
                                href="{{ asset('uploads/artist_downloads/' . $download->file) }}"
                                alt="{{ $download->name }}" target="_blank">{{ $download->name }}</a>
                        </div>
                    @empty
                        No Downloads Yet
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <section class="releases-album-container-detail radius-12px bg-darkgray mt-60-r {{ $artist->releases->isEmpty() ? 'd-none' : ''}}">
        <div class="section-title-bar">
            <h3 class="section-title text-white font-weight-700">Release</h3>
        </div>

        <div class="artists-cards-container p-20px pb-0 row gy-4 gx-lg-5 gx-3">
            @forelse ($artist->releases as $release)
                <div class="artist-card card bg-transparent col-md-6 col-xl-4 border-0">
                    <div class="artist-album-img-wrapper">
                        <a href="{{ route('release.detail', [$release->slug]) }}"><img
                                src="{{ asset('uploads/releases/' . $release->image) }}"
                                class="card-img-top radius-12px w-100" alt="expressa"></a>
                    </div>
                    <div class="card-body p-0 py-3">
                        <div class="artist-card-date-title-container d-flex mb-3">
                            <h4
                                class="artist-album-title font-weight-700 card-text text-white text-decoration-none m-0 col-8">
                                <a href="{{ route('release.detail', [$release->slug]) }}"
                                    class="text-white text-decoration-none">{{ $release->name }}</a>
                            </h4>
                            <p class="artist-album-release-date card-text text-white text-right font-18 col-4">
                                {{ \Carbon\Carbon::parse($release->release_date)->format('d-m-Y') }}</p>
                        </div>
                        <p class="artist-album-description mt-1 card-text text-lightgray font-18 fw-light">Loreum
                            ijsyq jhyqd shhqshqq iosy
                            ipsum</p>
                    </div>
                </div>
            @empty
                <p class="text-white">No Releases Found</p>
            @endforelse
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        @media screen and (max-width: 416px) {
            .artist-thumbnail {
                display: flex !important;
                flex-direction: column;
                align-items: center !important;
            }

            .card-body .name-center {
                text-align: center;
            }
        }
    </style>
@endpush
