<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MusicFileController extends Controller
{
    // public function index()
    // {
    //     $musicFiles = auth()->user()->musicFiles()->latest()->get();

    //     return view('music-files.index', compact('musicFiles'));
    // }

    public function upload()
    {
        return view('musics.upload');
    }

// ...

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

        auth()->user()->musicFiles()->save($musicFile);

        // Perform any additional operations or redirects as needed
        // For example, you might want to redirect back to the index page

        return redirect()->route('musics.index');
    }

    public function play($id)
    {
        $musicFile = Music::findOrFail($id);

        return view('musics.play', compact('musicFile'));
    }

}
