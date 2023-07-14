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
        $profession = [
            [
                'name' => 'Physician',
            ]
        ];
        // Specialty seed
        $specialties = [
            [
                'title' => 'Gynaecologist',
            ],
            [
                'title' => 'Paediatrician',
            ]
        ];
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
        $user = new User();
        $user->create([
            'firstname' => 'George',
            'lastname' => 'Ibekie',
            'email' => 'ceo@whietcoatdomain.com',
            'password' => bcrypt('two%WhiteCoatDomain'),
            'role' => 'SuperAdmin',
        ]);
        collect($profession)->each(function ($profession) {\App\Models\Profession::create($profession);});
        collect($specialties)->each(function ($specialties) {\App\Models\Specialty::create($specialties);});
        collect($templates)->each(function ($templates) {\App\Models\Template::create($templates);});
        collect($title)->each(function ($title) {\App\Models\Title::create($title);});
        $this->call([
            InterestSeeder::class
        ]);
    }
}
