<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\User;
use \App\Dislikes_schedule;
use \Carbon\Carbon;

class RemoveDislikes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:dislikes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove dislikes that have been up for 2hours.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $schedules=Dislikes_schedule::all();
        foreach($schedules as $schedule){
            if (now()->diffInMinutes($schedule->created_at) >= 120){
                User::find($schedule->user_id)
                ->disliked()
                ->detach($schedule->shop_id);

                $schedule->delete();
            }
        }
    }
}
