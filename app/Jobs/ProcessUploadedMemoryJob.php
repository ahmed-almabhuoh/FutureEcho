<?php

namespace App\Jobs;

use App\Models\Memory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\ProtocolException;
use Illuminate\Support\Str;

class ProcessUploadedMemoryJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Memory $memory, public int $id)
    {
        //
        $this->onQueue('processing');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $files = json_decode($this->memory->medias);
        $encryptedFilePaths = [];

        foreach ($files as $file) {
            $internalFileName = Str::random(150);
            $fileName = 'public/storage/uploads/u' . $this->id . '/' . $internalFileName;
            $fileContent = file_get_contents(getFullFilePath(Storage::url($file)));
            $encryptedFile = Crypt::encrypt($fileContent);
            file_put_contents($fileName, $encryptedFile);

            File::delete($file);

            $encryptedFilePaths[] = 'http://127.0.0.1:8000/storage/uploads/u121/' . $internalFileName;
        }

        $this->memory->medias = json_encode($encryptedFilePaths);
        $this->memory->save();
    }
}
