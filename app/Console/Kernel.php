<?php

namespace App\Console;

Use DB;
Use Illuminate\Support\Facades\Mail;
Use App\Http\Controllers\EmailTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\EmailReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	$schedule->command('email:reminder')->hourly();
                				// ->between('20:16', '20:20');
    }
}
