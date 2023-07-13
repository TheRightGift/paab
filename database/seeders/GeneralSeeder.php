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
        // Specialty seed
        $specialties = [
            [
                'title' => 'Gynaecologist',
            ],
            [
                'title' => 'Paediatrician',
            ]
        ];
        collect($specialties)->each(function ($specialties) {\App\Models\Specialty::create($specialties);});
        $templates = [
            [
                'title' => 'Gynaecologist',
                'imageUrl' => 'media/img/Gynaecologist.png',
                'styleFile' => 'Gynaecologist.css',
                'approved' => 'T',
                'specialty_id' => 1,
            ],
            [
                'title' => 'Paediatrician',
                'imageUrl' => 'media/img/paediatrician.png',
                'styleFile' => 'paediatrician.css',
                'approved' => 'T',
                'specialty_id' => 2,
            ]
        ];
        collect($templates)->each(function ($templates) {\App\Models\Template::create($templates);});
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
        $this->call([
            InterestSeeder::class
        ]);
    }
}
