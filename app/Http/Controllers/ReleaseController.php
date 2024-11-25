<?php

namespace App\Http\Controllers;

use App\Models\{Artist, Release};
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $releases = Release::with('artist')->get();
        return view('releases.index', compact('releases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        return view('releases.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'release_name' => 'required',
            'artist_id' => 'required',
            'release_date' => 'required'
        ]);

        $data = $request->except('image', 'name');
        $data['name'] = $request->release_name;

        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image_name = Str::random(8) . date('Ymdhis');
            $image_name = $image_name . '.' . $ext;
            $image->move(public_path('uploads/releases'), $image_name);
            $data['image'] = $image_name;
        }

        $release = Release::create($data);

        if (is_array($request->review_name) || is_object($request->review_name)) {
            foreach ($request->review_name as $key => $n) {
                if ($n != null || $request->description[$key]) {
                    $release->reviews()->create(
                        [
                            'name' => $n,
                            'description' => $request->description[$key],
                        ]
                    );
                }
            }
        }

        foreach ($request->tracks ??  [] as $trackData) {
            if ($trackData['name'] != null && $trackData['name'] != '') {
                if (isset($trackData['track_image'])) {
                    $track_image = $trackData['track_image'];
                    if ($track_image) {
                        $ext = pathinfo($track_image->getClientOriginalName(), PATHINFO_EXTENSION);
                        $imageName = Str::random(8) . date('Ymdhis') . '.' . $ext;
                        $track_image->move(public_path('uploads/track_images'), $imageName);
                        $img_name = $imageName;
                    } else {
                        $img_name = null;
                    }
                } else {
                    $img_name = null;
                }
                $release->tracks()->create(
                    [
                        'name' => $trackData['name'],
                        'image' => $img_name
                    ]
                );

            }
        }

        return redirect()->route('admin.releases.index')->with('success', 'Release created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Release $release)
    {
        $artists = Artist::all();
        return view('releases.edit', compact('artists', 'release'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Release $release)
    {
        $request->validate([
            'release_name' => 'required',
            'artist_id' => 'required',
            'release_date' => 'required'
        ]);

        $data = $request->except('image', 'name');
        $data['name'] = $request->release_name;

        $image = $request->image;
        if ($image) {
            $url = public_path('uploads/releases/' . $release->image);
            unlink($url);
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image_name = Str::random(8) . date('Ymdhis');
            $image_name = $image_name . '.' . $ext;
            $image->move(public_path('uploads/releases'), $image_name);
            $data['image'] = $image_name;
        }

        $release->update($data);

        $release->reviews()->delete();
        if (is_array($request->review_name) || is_object($request->review_name)) {
            foreach ($request->review_name as $key => $n) {
                if ($n != null || $request->description[$key]) {
                    $release->reviews()->create(
                        [
                            'name' => $n,
                            'description' => $request->description[$key],
                        ]
                    );
                }
            }
        }

        // Get all request data including files
        $requestData = $request->all();
        // Collect track IDs from the request
        $trackIds = collect($requestData['tracks'] ?? [])->pluck('id')->filter();

        Track::where('release_id', $release->id)->whereNotIn('id', $trackIds)->each(function ($track) {
            if ($track->image) {
                $url = public_path('uploads/track_images/' . $track->image);
                unlink($url);
            }
            $track->delete();
        });

        foreach ($requestData['tracks'] ?? [] as $trackData) {
            if (isset($trackData['id'])) {
                $track = Track::findOrFail($trackData['id']);
                $track->name = $trackData['name'];
                if (isset($trackData['track_image'])) {
                    // Delete the previous image if exists
                    if ($track->image) {
                        $url = public_path('uploads/track_images/' . $track->image);
                        unlink($url);
                    }
                    // Store the new image
                    $track_image = $trackData['track_image'];
                    if ($track_image) {
                        $ext = pathinfo($track_image->getClientOriginalName(), PATHINFO_EXTENSION);
                        $imageName = Str::random(8) . date('Ymdhis') . '.' . $ext;
                        $track_image->move(public_path('uploads/track_images'), $imageName);
                        $track->image = $imageName;
                    }
                }
                $track->save();
            } else {
                $track = new Track();
                $track->release_id = $release->id;
                $track->name = $trackData['name'];
                if (isset($trackData['track_image'])) {
                    $track_image = $trackData['track_image'];
                    $ext = pathinfo($track_image->getClientOriginalName(), PATHINFO_EXTENSION);
                    $imageName = Str::random(8) . date('Ymdhis') . '.' . $ext;
                    $track_image->move(public_path('uploads/track_images'), $imageName);
                    $track->image = $imageName;
                }
                $track->save();
            }
        }
        return redirect()->route('admin.releases.index')->with('success', 'Release Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Release $release)
    {
        if ($release->image != null) {
            $url = public_path('uploads/releases/' . $release->image);
            unlink($url);
        }

        $release->reviews()->delete();

        foreach ($release->tracks as $track) {
            if ($track->image != null) {
                $url = public_path('uploads/track_images/' . $track->image);
                unlink($url);
            }
        }

        $release->tracks()->delete();
        $release->delete();

        return redirect()->route('admin.releases.index')->with('success', 'Release Deleted successfully');
    }
}
