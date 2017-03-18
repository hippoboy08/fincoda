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
        //This returns all of the surveys that are due in 7 days from now
              $surveysAndParticipants = DB::select(DB::raw(
                                "select surveys.id, surveys.user_id, surveys.title, surveys.start_time, 
				surveys.end_time, participants.user_id, 
				users.email from participants 
				join surveys on participants.survey_id = surveys.id
				join users on users.id = participants.user_id
				where DATE(surveys.end_time) = DATE(DATE_ADD(NOW(),INTERVAL 7 DAY))
				and surveys.type_id = 1
				and participants.completed = 0"));
	if(!empty($surveysAndParticipants)){						
	foreach($surveysAndParticipants as $participant){
              //send email to the participants
              $this->email('email.surveyreminder',['owner'=>DB::table('users')->where('id',$participant->user_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title,'start_time'=>$participant->start_time,'end_time'=>$participant->end_time],$participant->email);
    	     }
    	}

	//This returns all of the surveys that are due in 3 days from now
              $surveysAndParticipants3Days = DB::select(DB::raw(
                                "select surveys.id, surveys.user_id, surveys.title, surveys.start_time, 
				surveys.end_time, participants.user_id, 
				users.email from participants 
				join surveys on participants.survey_id = surveys.id
				join users on users.id = participants.user_id
				where DATE(surveys.end_time) = DATE(DATE_ADD(NOW(),INTERVAL 3 DAY))
				and surveys.type_id = 1
				and participants.completed = 0"));
	if(!empty($surveysAndParticipants3Days)){						
	foreach($surveysAndParticipants3Days as $participant){
              //send email to the participants
              $this->email('email.surveyreminder3days',['owner'=>DB::table('users')->where('id',$participant->user_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title,'start_time'=>$participant->start_time,'end_time'=>$participant->end_time],$participant->email);
    	     }
    	}


	//This returns all of the surveys that are starting today:It runs every midnight before any new surveys are created
              $surveysAndParticipantsToday = DB::select(DB::raw(
                                "select surveys.id, surveys.user_id, surveys.title, surveys.start_time, 
				surveys.end_time, participants.user_id, 
				users.email from participants 
				join surveys on participants.survey_id = surveys.id
				join users on users.id = participants.user_id
				where DATE(surveys.start_time) = DATE(NOW())
                and DATE(surveys.created_at) != DATE(NOW())"));
	if(!empty($surveysAndParticipantsToday)){						
	foreach($surveysAndParticipantsToday as $participant){
              //send email to the participants
              $this->email('email.surveyremindertoday',['owner'=>DB::table('users')->where('id',$participant->user_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title, 'start_time'=>$participant->start_time,'end_time'=>$participant->end_time],$participant->email);
    	     }
    	}
    	
    	
    	//This returns all of the peers incomplete for surveys that are due in 7 days from now
              $surveysAndPeer7Days = DB::select(DB::raw(
                    "select peer_surveys.id, peer_surveys.user_id, surveys.title, surveys.start_time, 
			    surveys.end_time, peer_surveys.peer_id, 
			    users.email from peer_surveys 
			    join surveys on peer_surveys.survey_id = surveys.id
			    join users on users.id = peer_surveys.peer_id
			    where DATE(surveys.end_time) = DATE(DATE_ADD(NOW(),INTERVAL 7 DAY))
			    and surveys.type_id = 2
			    and peer_surveys.peer_completed = 1"));
	if(!empty($surveysAndPeer7Days)){						
	    foreach($surveysAndPeer7Days as $participant){
              //send email to the participants
              $this->email('email.surveyreminderpeer7days',['owner'=>DB::table('users')->where('id',$participant->peer_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title,'start_time'=>$participant->start_time,'end_time'=>$participant->end_time],$participant->email);
	     }
	}


	//This returns all of the peers incomplete for surveys that are due in 3 days from now
              $surveysAndPeer7Days = DB::select(DB::raw(
                    "select peer_surveys.id, peer_surveys.user_id, surveys.title, surveys.start_time, 
			    surveys.end_time, peer_surveys.peer_id, 
			    users.email from peer_surveys 
			    join surveys on peer_surveys.survey_id = surveys.id
			    join users on users.id = peer_surveys.peer_id
			    where DATE(surveys.end_time) = DATE(DATE_ADD(NOW(),INTERVAL 3 DAY))
			    and surveys.type_id = 2
			    and peer_surveys.peer_completed = 1"));
	if(!empty($surveysAndPeer7Days)){						
	    foreach($surveysAndPeer7Days as $participant){
              //send email to the participants
              $this->email('email.surveyreminderpeer3days',['owner'=>DB::table('users')->where('id',$participant->peer_id)->value('name'), 'link'=>url('/').'/login', 'title'=>$participant->title,'start_time'=>$participant->start_time,'end_time'=>$participant->end_time],$participant->email);
	     }
	}
    }
}
