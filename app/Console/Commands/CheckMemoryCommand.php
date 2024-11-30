<?php

namespace App\Console\Commands;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\Memory;
use App\Models\Message;
use App\Models\Receiver;
use App\Models\TimeLine;
use App\Models\User;
use App\Notifications\MemoryTimeNotification;
use App\Notifications\SequenceMsgNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckMemoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memory:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start checking memory timeline to send it for receivers.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $memory_ids = Memory::withoutGlobalScopes()->select(['id', 'user_id'])->get()->pluck('id', 'user_id')->toArray();

        foreach ($memory_ids as $user_id => $memory_id) {
            $timeline = TimeLine::where('memory_id', $memory_id)->first();

            if (! is_null($timeline)) {
                $from = Carbon::parse($timeline->from)->format('m-d');
                $to = Carbon::parse($timeline->to)->format('m-d');
                $now = Carbon::now()->format('m-d');

                if ($from <= $now && $to >= $now) {
                    $user = User::findOrFail($user_id);
                    $user->notify(new MemoryTimeNotification($user, $memory_id));

                    $capsule = Capsule::where('id', Memory::where('id', $memory_id)->select(['capsule_id'])->first()?->capsule_id)->first();
                    if (!is_null($capsule)) {
                        $users =  User::whereIn('id', Contributor::where('capsule_id', $capsule->id)->select(['user_id'])->get()->pluck('user_id')->toArray())->get();

                        foreach ($users as $user)
                            $user->notify(new MemoryTimeNotification($user, $memory_id));
                    }
                }
            }
        }
    }
}
