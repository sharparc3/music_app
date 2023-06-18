<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('musics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'music_file' => 'required|mimes:audio/mpeg,mp3|max:50000',
        ]);

        $file = $request->file('music_file');
        $path = $file->store('public/musics');

        $musicFile = new Music();
        $musicFile->title = $request->input('title');   
        $musicFile->file_path = Storage::url($path);
        // $musicFile->file_path = str_replace('/', '\\', Storage::url($path));
        $musicFile->release_date = Carbon::now();
        // Set other fields as necessary
        // For example: $musicFile->artist_id = $request->input('artist_id');

        auth()->user()->musics()->save($musicFile);

        // Perform any additional operations or redirects as needed
        // For example, you might want to redirect back to the index page

        return redirect()->route('musics.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $musicFile = Music::findOrFail($id);

        return view('musics.show', compact('musicFile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
