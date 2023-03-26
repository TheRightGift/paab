<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class GeneralSeeder extends Seeder
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
                'name' => 'Physician',
            ]
        ];
        collect($professions)->each(function ($professions) {\App\Models\Profession::create($professions);});
        $title = [
            [
                'profession_id' => 1,
                'name' => 'DO',
            ],
            [
                'name' => 'MD',
                'profession_id' => 1
            ],
            [
                'name' => 'DD',
                'profession_id' => 1
            ],
            [
                'name' => 'DDS',
                'profession_id' => 1
            ],
            [
                'name' => 'OD',
                'profession_id' => 1
            ],
            [
                'name' => 'DPM',
                'profession_id' => 1
            ],
        ];
        collect($title)->each(function ($title) {\App\Models\Title::create($title);});
        $user = new User();
        $user->create([
            'firstname' => 'George',
            'lastname' => 'Ibekie',
            'email' => 'ceo@whietcoatdomain.com',
            'password' => bcrypt('two%WhiteCoatDomain'),
            'role' => 'SuperAdmin',
        ]);
    }
}
