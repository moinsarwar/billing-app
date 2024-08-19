<?php



use Illuminate\Support\Facades\Storage;

function getImageUrl($path)
{
    if (Storage::disk('s3')->exists($path)) {
        $url = Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(15));
    } else {
        $url = asset('storage/' . $path);
    }

    return $url;
}



