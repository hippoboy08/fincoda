<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use DB;
//Use Mail;
Use App\Http\Controllers\EmailTrait;

class EmailReminder extends Command
{
use EmailTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        
        //This returns all of the surveys that are due in 14 days from now
              $surveysAndParticipants = DB::select(DB::raw(
                                "select surveys.id, surveys.user_id, surveys.title, surveys.start_time, 
				surveys.end_time, participants.user_id, 
				users.email from participants 
				join surveys on participants.survey_id = surveys.id
				join users on users.id = participants.user_id
				where surveys.end_time = DATE_ADD(NOW(),INTERVAL 14 DAY)"));
	if(!empty($surveysAndParticipants)){						
	foreach($surveysAndParticipants as $participant){
              //send email to the participants
              $this->email('email.surveyreminder',['owner'=>DB::table('users')->where('id',$participant->user_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title],$participant->email);
    	     }
    	}
	
    }
}
