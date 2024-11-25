@extends('website.layouts.main')

@section('section')
    <nav class="artist-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Service</li>
            <li class="breadcrumb-item active">BleedingStar Music Services</li>
        </ol>
    </nav>
    <!-- Content -->
    <div class="container content text-center">
        <div class="section">
            <div class="section-title mt-5 mb-3">
                <h3 class="section-title text-white font-weight-700">Du Brucht Einen Tontechniker Oder Tourmanger?</h3>
            </div>
            <p class="text-lightgray2 font-18 font-weight-300">Sed convallis sit amet leo quis feugiat. Nunc interdum mollis
                facilisis. feugi Dthreec id the urna aliquet, suscipit leo quis feugiat. Nunc interdum mollis facilisis.
                feugi Dthreec id the urna aliquet, suscipit</p>
        </div>
        <div class="section">
            <div class="section-title mt-5 mb-3">
                <h3 class="section-title text-white font-weight-700">Tour, Konzert Oder Festival!</h3>
            </div>
            <p class="text-lightgray2 font-18 font-weight-300">Sed convallis sit amet leo quis feugiat. Nunc interdum mollis
                facilisis. feugi Dthreec id the urna aliquet, suscipit leo quis feugiat. Nunc interdum mollis facilisis.
                feugi Dthreec id the urna aliquet, suscipit</p>
        </div>
        <div class="section">
            <div class="section-title mt-5 mb-3">
                <h3 class="section-title text-white font-weight-700">Download Codes Fur Vinyl</h3>
            </div>
            <div
                class="logo-l align-content-center text-center mb-3">
                <a href="{{ route('home') }}"><img src="{{ asset('') }}assets/media/logos/logo-default-inverse.png" alt="logo"
                        width="50px"></a>
            </div>
            <p class="text-lightgray2 font-18 font-weight-300">Sed convallis sit amet leo quis feugiat. Nunc interdum mollis
                facilisis. feugi Dthreec id the urna aliquet, suscipit leo quis feugiat. Nunc interdum mollis facilisis.
                feugi Dthreec id the urna</p>
        </div>
        <div class="section">
            <div class="section-title mt-5 mb-3">
                <div class="logo-s align-content-center text-center m-auto  mb-3">
                    <a href="{{route('home')}}"><img src="{{ asset('') }}assets/media/logos/Logo.png" alt="logo" class="mw-100"></a>
                </div>
            </div>
            <p class="text-lightgray2 font-18 font-weight-300">Sed convallis sit amet leo quis feugiat. Nunc interdum mollis
                facilisis. feugi Dthreec id the urna aliquet, suscipit leo quis feugiat. Nunc interdum mollis facilisis.
                feugi Dthreec id the urna aliquet, suscipit</p>
        </div>
        <div class="section-title mt-5 mb-3">
            <div class="align-content-center text-center m-auto  mb-3">
                <a href="{{route('home')}}"><img src="{{ asset('') }}assets/media/logos/Logo.png" alt="logo" class="mw-100"></a>
            </div>
        </div>
    </div>
@endsection
