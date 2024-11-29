<?php

namespace App\Console\Commands;

use App\Models\Memory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FireSequenceMsgsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'msgs:sequences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fire message sequences for memories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $memories = Memory::with('messages')->get();

        foreach ($memories as $memory) {
            $timeline = $memory->timeline;

            // if (!is_null($timeline)) {
            //     $now = Carbon::now()->format('m-d');
            //     $from = Carbon::parse($timeline->from)->format('m-d');
            //     $to = Carbon::parse($timeline->to)->format('m-d');

            //     if ($now >= $from && $now <= $to) {

            //     }
            // }
        }
    }
}
