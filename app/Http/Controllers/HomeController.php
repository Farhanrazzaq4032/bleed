<?php

namespace App\Http\Controllers;

use App\Models\{Release, Artist, ArtistDownload, BookingAgent};

class HomeController extends Controller
{
    public function index()
    {
        $releases = Release::all();
        return view('website.index', compact('releases'));
    }

    public function artists()
    {
        return view('website.artists');
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function artist(Artist $artist)
    {
        $releases = Release::where('artist_id', $artist->id)->get();
        return view('website.index', compact('releases', 'artist'));
    }

    public function release(Release $release)
    {
        return view('website.release_detail', compact('release'));
    }

    public function artistDetail(Artist $artist)
    {
        return view('website.artist_detail', compact('artist'));
    }

    public function service() {
       return view('website.service');
    }
}
