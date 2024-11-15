<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;

class MemoryController extends Controller
{
    public function serveMedia($path)
    {
        $memory = Memory::whereJsonContains('medias', 'private/memories/' . $path)->firstOrFail();

        if ($memory->user_id !== auth()->id()) {
            abort(403);
        }

        $encryptedContent = Storage::get('private/memories/' . $path);

        $decryptedContent = Crypt::decrypt($encryptedContent);

        return Response::make($decryptedContent, 200, [
            'Content-Type' => Storage::mimeType('private/memories/' . $path),
            'Content-Disposition' => 'attachment; filename="' . basename($path) . '"',
        ]);
    }
}
