<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use DB;

class SwitchOnEmailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailer:switchonemailer';

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
    public function handle(){   
	
	DB::table('scheduled_tasks')
						->where('id',1)
						->update([
						    'running'=>0,
						]);
	}
}
