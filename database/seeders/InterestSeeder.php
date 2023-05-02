<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interests = [
            ['title' => 'Anesthesiology', 'description' => 'Focuses on providing pain relief and sedation during surgeries and other medical procedures.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Cardiology', 'description' => 'Deals with the diagnosis and treatment of heart and cardiovascular diseases.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Dermatology', 'description' => 'Specializes in the diagnosis and treatment of skin conditions, including skin cancer.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Emergency Medicine', 'description' => 'Focuses on the diagnosis and treatment of medical emergencies and trauma.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Endocrinology', 'description' => 'Deals with hormonal disorders and diseases, including diabetes and thyroid disorders.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Family Medicine', 'description' => 'Provides primary care for patients of all ages and focuses on disease prevention and health promotion.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Gastroenterology', 'description' => 'Deals with the diagnosis and treatment of digestive tract disorders, including liver and pancreas diseases.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Geriatrics', 'description' => 'Specializes in the care of elderly patients, including chronic disease management and end-of-life care.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Hematology/Oncology', 'description' => 'Deals with the diagnosis and treatment of blood disorders and cancers.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Hospital Medicine', 'description' => 'Focuses on the care of hospitalized patients, including coordinating care between multiple specialists.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Infectious Disease', 'description' => 'Deals with the diagnosis and treatment of infectious diseases, including viral and bacterial infections.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Internal Medicine', 'description' => 'Provides primary care for adults and focuses on disease prevention and management.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Neonatology', 'description' => 'Specializes in the care of newborns and premature infants, including critical care and management of birth defects.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Nephrology', 'description' => 'Deals with the diagnosis and treatment of kidney diseases, including dialysis and transplantation.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Neurology', 'description' => 'Deals with the diagnosis and treatment of nervous system disorders, including stroke and epilepsy.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Obstetrics/Gynecology', 'description' => 'Deals with women\'s health and reproduction, including prenatal care and childbirth.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Occupational Medicine', 'description' => 'Focuses on the prevention and treatment of work-related injuries and illnesses.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Ophthalmology', 'description' => 'Specializes in the diagnosis and treatment of eye disorders, including cataracts and glaucoma.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Orthopedics', 'description' => 'Deals with the diagnosis and treatment of musculoskeletal disorders, including bone fractures and joint replacements.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Otolaryngology (ENT)', 'description' => 'Specializes in the diagnosis and treatment of ear, nose, and throat disorders, including hearing loss and sinus problems.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Pain Medicine', 'description' => 'Focuses on the diagnosis and treatment of chronic pain conditions, including back pain and migraines.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Pathology', 'description' => 'Deals with the diagnosis and characterization of diseases through laboratory analysis of tissue and fluids.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Pediatrics', 'description' => 'Provides medical care for infants, children, and adolescents, focusing on disease prevention and early intervention.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Physical Medicine and Rehabilitation', 'description' => 'Specializes in the management of physical disabilities and the restoration of function after injury or illness.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Plastic Surgery', 'description' => 'Specializes in the reconstruction and enhancement of physical features and function, including cosmetic procedures.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Psychiatry', 'description' => 'Deals with the diagnosis and treatment of mental illnesses, including depression and anxiety.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Pulmonary/Critical Care', 'description' => 'Focuses on the diagnosis and treatment of lung diseases, including asthma and COPD, and provides care for critically ill patients.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Radiation Oncology', 'description' => 'Deals with the use of radiation to treat cancer and other diseases.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Radiology', 'description' => 'Specializes in the interpretation of medical imaging tests, including X-rays and MRIs.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Rheumatology', 'description' => 'Deals with the diagnosis and treatment of rheumatic diseases, including arthritis and lupus.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Sleep Medicine', 'description' => 'Focuses on the diagnosis and treatment of sleep disorders, including sleep apnea and insomnia.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Sports Medicine', 'description' => 'Deals with the prevention and treatment of sports-related injuries, including rehabilitation and performance enhancement.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Surgery', 'description' =>'Specializes in the diagnosis and treatment of diseases through surgical intervention.', 'icon' =>'/media/img/templates/1/otho.svg'],
            ['title' => 'Urology', 'description' => 'Deals with the diagnosis and treatment of urinary tract', 'icon' => '/media/img/templates/1/otho.svg']
        ];
        collect($interests)->each(function ($interest) {\App\Models\Interest::create($interest);});
    }
}
