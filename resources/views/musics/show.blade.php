<h1>{{ $musicFile->title }}</h1>
<audio controls autoplay controlsList="nodownload">
    <source src="{{ asset($musicFile->file_path) }}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
