<!-- Add this form within the appropriate section of your view -->
<form action="{{ route('musics.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="music_file">Select Music File:</label>
        <input type="file" name="music_file" id="music_file" required>
    </div>

    <!-- Add any additional fields for title, artist, album, genre, etc. as needed -->
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>

    <button type="submit">Upload</button>
</form>
