<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Artist, ArtistDownload};

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'artist_name' => 'required',
            'link' => 'required'
        ]);
        $data = $request->except('image', 'downloads');
        $data['name'] = $request->artist_name;
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image_name =  Str::random(8) . date('Ymdhis');
            $image_name = $image_name . '.' . $ext;
            $image->move(public_path('uploads/artists'), $image_name);
            $data['image'] = $image_name;
        }

        $artist = Artist::create($data);

        foreach ($request->name as $key => $n) {
            if ($n != null) {
                $artist->agents()->create(
                    [
                        'name' => $n,
                        'email' => $request->email[$key],
                        'phone' => $request->phone[$key],
                    ]
                );
            }
        }

        $downloads = $request->downloads;
        if ($downloads) {
            foreach ($downloads as $key => $download) {
                $ext = pathinfo($download->getClientOriginalName(), PATHINFO_EXTENSION);
                $name = pathinfo($download->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName =Str::random(8) . date('Ymdhis')  . '.' . $ext;
                $download->move(public_path('uploads/artist_downloads'), $imageName);
                $artist->downloads()->create([
                    'name' => $name,
                    'file' => $imageName
                ]);
            }
        }

        return redirect()->route('admin.artists.index')->with('success', 'Artist Added Successfullty');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artist = Artist::findOrFail($id);
        return view('releases.artist-release', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'artist_name' => 'required',
            'link' => 'required'
        ]);
        $data = $request->except('image', 'downloads');
        $data['name'] = $request->artist_name;
        $image = $request->image;
        if ($image) {
            $url = public_path('uploads/artists/' . $artist->image);
            unlink($url);
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image_name =  Str::random(8) . date('Ymdhis');
            $image_name = $image_name . '.' . $ext;
            $image->move(public_path('uploads/artists'), $image_name);
            $data['image'] = $image_name;
        }

         $artist->update($data);
         $artist->agents()->delete();
        foreach ($request->name as $key => $n) {
            if ($n != null) {
                $artist->agents()->create(
                    [
                        'name' => $n,
                        'email' => $request->email[$key],
                        'phone' => $request->phone[$key],
                    ]
                );
            }
        }

        $downloads = $request->downloads;
        $image_names = [];
        if ($downloads) {
            foreach ($downloads as $key => $download) {
                $ext = pathinfo($download->getClientOriginalName(), PATHINFO_EXTENSION);
                $name = pathinfo($download->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName =Str::random(8) . date('Ymdhis')  . '.' . $ext;
                $download->move(public_path('uploads/artist_downloads'), $imageName);
                $artist->downloads()->create([
                    'name' => $name,
                    'file' => $imageName
                ]);
            }
        }

        return redirect()->route('admin.artists.index')->with('success', 'Artist Updated Successfullty');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Artist::find($id);
        if ($data->image) {
            $url = public_path('uploads/artists/' . $data->image);
            unlink($url);
        }
        // dd($data->downloads);
        foreach ($data->downloads as $download) {
            $url = public_path('uploads/artist_downloads/' . $download->file);
            unlink($url);
        }
        $data->downloads()->delete();
        $data->agents()->delete();
        $data->delete();
        return redirect()->route('admin.artists.index')->with('success', 'Artist Deleted Successfully');
    }

    public function delete_download($id)
    {
       $download = ArtistDownload::find($id);
       if($download->file) {
           $url = public_path('uploads/artist_downloads/'. $download->file);
           unlink($url);
       }
       if($download->delete()){
        return response()->json(true);
       } else{
        return response()->json(false);
       }
    }
}
