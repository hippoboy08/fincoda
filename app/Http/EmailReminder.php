<?php

namespace App\Console;

use DB;
use App\Http\Controllers\EmailTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class EmailReminder extends ConsoleKernel {
	use EmailTrait;
     //The Artisan commands provided by your application.@var array
	 //We are not providing any commands here
     
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            //This returns all of the surveys that are due in 14 days from now
              $surveysAndParticipants = DB::select(DB::raw(
                                "select surveys.id, surveys.title, surveys.start_time, 
								surveys.end_time, participants.user_id, 
								users.email from participants 
								join surveys on participants.survey_id = surveys.id
								join users on users.id = participants.user_id
								where surveys.end_time = DATE_ADD(NOW(),INTERVAL 14 DAY)"));
		//if(!empty($surveysAndParticipants)){						
		foreach($surveysAndParticipants as $participant){
                    $member_email[]=$participant->email;
                }

              //send email to the participants
              $this->email('email.surveyreminder',['owner'=>$owner->name, 'link'=>url('/').'/login', 'title'=>$survey->title],"davis.kawalya@edu.turkuamk.fi");
        	//}
})->everyMinute();
    }
}