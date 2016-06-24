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
        Indicator::create([
            'indicator' => 'Presents ideas that are suitable for tasks.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Presents creative ideas.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Presents new ways to implement ideas.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Evaluate the advantage and disadvantage of actions.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Identifies relationships among different components of the task.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Faces the tasks from different points of view.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Uses available resources ingeniously.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Foresees how events will develop.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Shows enthusiasm',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Persistently pursues the goals.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Takes daring yet reasonable risks.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Orients the task towards the target.',
            'group_id' => 1,
        ]);
        Indicator::create([
            'indicator' => 'Transmits ideas effectively.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Listens to teammates.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Establishes constructive group relationships through dialogue.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Collaborates actively.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Contributes to group functioning.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Takes initiatives.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Drives others to act.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Faces conflicts with flexibility to reach agreements.',
            'group_id' => 2,
        ]);
        Indicator::create([
            'indicator' => 'Applies ethical values.',
            'group_id' => 3,
        ]);
        Indicator::create([
            'indicator' => 'Takes into account the implications of the task for society.',
            'group_id' => 3,
        ]);
        Indicator::create([
            'indicator' => 'Is able to work in multidisciplinary environments.',
            'group_id' =>3,
        ]);
        Indicator::create([
            'indicator' => 'Uses networking contacts to reach goals',
            'group_id' => 3,
        ]);
      }
}
