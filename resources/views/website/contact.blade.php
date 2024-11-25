@extends('website.layouts.main')

@section('section')
    <nav class="artist-breadcrumb mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Contact Us</li>
        </ol>
    </nav>
    <section class="contact-us">
        <div
            class="contact-details-wrapper d-flex flex-column justify-content-between m-auto bg-darkgray radius-12px mb-4 mb-lg-5">
            <div class="contact-information text-white">
                <h4 class="fw-normal mb-3">Contact Information</h4>
                <p class="contact-information-tagline">Say something to start a live chat!</p>
            </div>
            <div class="contact-icon-list">
                <div class="icon-list mb-4">
                    <span class="phone-number"><a class="text-white text-decoration-none" href="tel:4366044349191"><span
                                class="icon me-3"><i class="bi-telephone"></i></span>4366044349191</a></span>
                </div>
                <div class="icon-list ">
                    <span class="phone-number"><a class="text-white text-decoration-none"
                            href="mailto:contact@example.com"><span class="icon me-3"><i
                                    class="bi-envelope"></i></span>contact@example.com</a></span>
                </div>
            </div>
            <div class="social-contact d-flex">
                <a href="#" class="social-link text-white text-decoration-none"><span><i
                            class="bi-facebook"></i></span></a>
                <a href="#" class="social-link text-white text-decoration-none"><span><i
                            class="bi-twitter"></i></span></a>
                <a href="#" class="social-link text-white text-decoration-none"><span><i
                            class="bi-instagram"></i></span></a>
                <a href="#" class="social-link text-white text-decoration-none"><span><i
                            class="bi-youtube"></i></span></a>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endpush()
