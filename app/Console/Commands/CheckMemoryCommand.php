<?php

namespace App\Console\Commands;

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
            if (!is_null($timeline)) {
                $from = $timeline->from;
                $now = Carbon::now();
                if ($now >= $from) {
                    $msgs = Message::where('memory_id', $memory_id)->get();

                    foreach ($msgs as $msg) {
                        if (((int)Carbon::parse($from)->diffInDays($now)) == $msg->before) {
                            $user = User::findOrFail($user_id);
                            $memory = Memory::findOrFail($memory_id);
                            $user->notify(new SequenceMsgNotification($user, $memory));

                            $capsule = $memory->capsule;

                            if (!is_null($capsule)) {
                                $user_ids = Contributor::where('capsule_id', $capsule->id)->select(['user_id'])->get()->pluck('user_id')->toArray();
                                $users = User::whereIn('id', $user_ids)->get();

                                foreach ($users as $user) {
                                    $user->notify(new SequenceMsgNotification($user, $memory));
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
