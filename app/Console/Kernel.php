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
		Commands\SwitchOnEmailer::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	$schedule->command('email:reminder')->daily();
	$schedule->command('email:switchonemailer')->dailyAt('15:00');
    }
}
