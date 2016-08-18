<?php

use Illuminate\Database\Seeder;
use App\Indicator;

class IndicatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Indicator::class, 30)->create();

        DB::table('indicators')->insert([
            'indicator' => 'Think differently and adopt different perspectives.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Be attentive when others are speaking, and respond effectively to others’ comments during the conversation.',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Use intuition and own knowledge to start actions.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Invite feedback and comments .',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('indicators')->insert([
            'indicator' => 'Foster improvements in work organization.',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('indicators')->insert([
            'indicator' => 'Obtain constructive comments from colleagues.',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);

        DB::table('indicators')->insert([
            'indicator' => 'Find new ways to implement ideas.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Identify sources of conflict between oneself and others, or among other people, and to take steps to overcome disharmony',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Take an acceptable level of risk to support new ideas .',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Go beyond expectations in the assignment, task, or job description without being asked  .',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Meet people with different kinds of ideas and perspectives to extend your own knowledge domains .',
            'group_id' => 5,
            'created_at' => \Carbon\Carbon::now()

        ]);

        //group twwo

        DB::table('indicators')->insert([
            'indicator' => 'Convince people to support an innovative idea .',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Systematically introduce new ideas into work practices.',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Act quickly and energetically.',
            'group_id' => 3,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Generate original solutions for problems or to opportunities.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Use trial and error for problem solving.',
            'group_id' => 2,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Develop and experiment with new ways of problem solving .',
            'group_id' => 2,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Acquire, assimilate, transform and exploit external knowledge to establish, manage and learn from informal organisational ties .',
            'group_id' => 5,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Challenge the status quo.',
            'group_id' => 2,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Face the task from different points of view.',
            'group_id' => 2,
            'created_at' => \Carbon\Carbon::now()


        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Make suggestions to improve current process products or services.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Present novel ideas.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Forecast impact on users.',
            'group_id' =>2,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Show inventiveness in using resources.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Search out new working methods, techniques or instruments.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);


        /**/
        DB::table('indicators')->insert([
            'indicator' => 'Provide constructive feedback, cooperation, coaching or help to team colleagues.',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Work well with others, understanding their needs and being sympathetic with them.',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Share timely information with the appropriate stakeholders.',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Consult about essential changes .',
            'group_id' => 4,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Build relationships outside the team/organization.',
            'group_id' => 5,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Refine ideas into a useful form.',
            'group_id' => 1,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Engage outsiders of the core work group from the beginning.',
            'group_id' => 5,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Ask “Why?” and “Why not?” and “What if?” with a purpose',
            'group_id' => 2,
            'created_at' => \Carbon\Carbon::now()

        ]);
        DB::table('indicators')->insert([
            'indicator' => 'Work in multidisciplinary environments ',
            'group_id' => 5,
            'created_at' => \Carbon\Carbon::now()

        ]);


    }
}
