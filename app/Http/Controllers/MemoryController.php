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
        $memory = Memory::withoutGlobalScopes()
            ->whereJsonContains('medias', 'private/memories/' . $path)
            ->first();

        if (!$memory) {
            return abort(404, "Memory not found or file path mismatch.");
        }

        $isAuthorized =
            $memory->user_id === auth()->id() ||
            $memory->capsule->contributors()->where('user_id', auth()->id())->exists() ||
            $memory->capsule->user_id === auth()->id();

        if (!$isAuthorized) {
            return abort(403, "Unauthorized access.");
        }

        $fullPath = 'private/memories/' . $path;
        if (!Storage::exists($fullPath)) {
            return abort(404, "File not found in storage.");
        }

        $encryptedContent = Storage::get($fullPath);
        $decryptedContent = Crypt::decrypt($encryptedContent);

        return Response::make($decryptedContent, 200, [
            'Content-Type' => Storage::mimeType($fullPath),
            'Content-Disposition' => 'attachment; filename="' . basename($path) . '"',
        ]);
    }
}
