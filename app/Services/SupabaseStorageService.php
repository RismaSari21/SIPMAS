<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseStorageService
{
    public function upload($file, $folder)
    {
        $filename = $folder.'/'.uniqid().'.'.$file->extension();

        Http::withHeaders([
            'Authorization' => 'Bearer '.env('SUPABASE_SERVICE_KEY'),
            'apikey' => env('SUPABASE_SERVICE_KEY'),
            'Content-Type' => $file->getMimeType(),
        ])->withBody(
            file_get_contents($file),
            $file->getMimeType()
        )->post(
            env('SUPABASE_URL').
            '/storage/v1/object/photos/'.$filename
        );

        return env('SUPABASE_URL').
        '/storage/v1/object/public/photos/'.$filename;
    }
}
