<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
                [
                    'name' => 'Doctor',
                ],
                [
                    'name' => 'Tutor',
                ],
                [
                    'name' => 'Photographer',
                ],
                [
                    'name' => 'Trainer',
                ],
                [
                    'name' => 'Lawyer',
                ],
                [
                    'name' => 'Physician',
                ]
            ];
            collect($professions)->each(function ($professions) {\App\Models\Profession::create($professions);});
            $title = [
                [
                    'profession_id' => 4,
                    'name' => 'Mr',
                ],
                [
                    'name' => 'Mrs',
                    'profession_id' => 2
                ],
                [
                    'name' => 'Dr',
                    'profession_id' => 1
                ],
                [
                    'name' => 'Engr',
                    'profession_id' => 4
                ],
                [
                    'name' => 'Chief',
                    'profession_id' => 3
                ],
                [
                    'name' => 'Barr',
                    'profession_id' => 5
                ]
            ];
            collect($title)->each(function ($title) {\App\Models\Title::create($title);});
            
    }
}