<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Graveyard;
use App\Models\JanazahAnnouncement;
use App\Models\Volunteer;
use App\Models\ServiceRequest;

class SahaaraSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cities
        $citiesData = [
            ['name' => 'Karachi', 'province' => 'Sindh'],
            ['name' => 'Lahore', 'province' => 'Punjab'],
            ['name' => 'Islamabad', 'province' => 'Federal'],
            ['name' => 'Rawalpindi', 'province' => 'Punjab'],
            ['name' => 'Faisalabad', 'province' => 'Punjab'],
            ['name' => 'Multan', 'province' => 'Punjab'],
            ['name' => 'Peshawar', 'province' => 'KPK'],
            ['name' => 'Quetta', 'province' => 'Balochistan'],
            ['name' => 'Hyderabad', 'province' => 'Sindh'],
            ['name' => 'Gujranwala', 'province' => 'Punjab'],
            ['name' => 'Sialkot', 'province' => 'Punjab'],
        ];

        $cities = [];
        foreach ($citiesData as $c) {
            $cities[$c['name']] = City::firstOrCreate(['name' => $c['name']], $c);
        }

        // 2. Categories
        $categories = [
            'transport' => ServiceCategory::firstOrCreate(['slug' => 'transport'], [
                'name' => 'Ambulance & Maiyat Bus (Transport)',
                'icon' => 'bi-truck-front',
                'description' => 'Hospital se ghar aur ghar se qabristan ya shehar se baahar maiyat le jaane ke liye emergency gaariyan.'
            ]),
            'ghusl' => ServiceCategory::firstOrCreate(['slug' => 'ghusl'], [
                'name' => 'Ghusl & Ghassal Khidmat',
                'icon' => 'bi-droplet-half',
                'description' => 'Tajurbakar ba-shara Mard aur Aurat Ghassal, Ghusl-khana aur mortuary facility.'
            ]),
            'kafan' => ServiceCategory::firstOrCreate(['slug' => 'kafan-package'], [
                'name' => 'Kafan & Tajheez Saman Package',
                'icon' => 'bi-box-seam',
                'description' => 'Mukammal kafan package (Kapra, Kafoor, Gulab Arq, Itar, Sabun, Looban, Bardana waghera).'
            ]),
            'qabar' => ServiceCategory::firstOrCreate(['slug' => 'qabar-intezamat'], [
                'name' => 'Qabar & Gor-kan Intezamat',
                'icon' => 'bi-layers-fill',
                'description' => 'Qabar ki khudaai, cement ke paat/takhtay, eentein, qabar ki takhti (nameplate).'
            ]),
            'announcement' => ServiceCategory::firstOrCreate(['slug' => 'janazah-announcement'], [
                'name' => 'Namaz-e-Janazah Ailaan (Digital Card)',
                'icon' => 'bi-megaphone',
                'description' => 'Janazah ke waqt aur maqam ka shareable digital card aur notice board.'
            ]),
            'welfare' => ServiceCategory::firstOrCreate(['slug' => 'mustahiq-support'], [
                'name' => 'Mustahiq Imdaad (Free Welfare)',
                'icon' => 'bi-hand-thumbs-up-fill',
                'description' => 'Jo khandan kharche bardasht nahi kar sakte, unke liye bilkul muft (free) kafan dafan intezam.'
            ]),
        ];

        // 3. Sample Services
        if (Service::count() === 0) {
            Service::create([
                'category_id' => $categories['transport']->id,
                'name' => 'Emergency Ambulance / Hearse Van (Local)',
                'description' => 'Within-city transfer from hospital to residence or residence to graveyard. Available 24/7.',
                'estimated_cost' => 1500.00,
                'provider_name' => 'Sahaara Fleet & Welfare Network',
                'contact_phone' => '0300-1234567',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['transport']->id,
                'name' => 'Maiyat Bus (Family & Janazah Transport)',
                'description' => 'AC / Non-AC bus with dedicated stretcher bay and seats for 25-30 family members.',
                'estimated_cost' => 3500.00,
                'provider_name' => 'Sahaara Community Transport',
                'contact_phone' => '0300-7654321',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['ghusl']->id,
                'name' => 'Male Ghassal (Ba-Shara Tajurbakar)',
                'description' => 'Experienced male ghassal arrives at your residence or designated community center with proper etiquettes.',
                'estimated_cost' => 1000.00,
                'provider_name' => 'Sahaara Certified Ghassal Panel',
                'contact_phone' => '0312-3456789',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['ghusl']->id,
                'name' => 'Female Ghassal (Khatoon Ghassala)',
                'description' => 'Respectful, religious, and trained female ghassala for women deceased.',
                'estimated_cost' => 1000.00,
                'provider_name' => 'Sahaara Certified Ghassal Panel',
                'contact_phone' => '0312-9876543',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['kafan']->id,
                'name' => 'Complete Mardana Kafan Box (Standard)',
                'description' => 'Lattha/cotton kafan cloth, 3 pieces, kafoor, gulab pani, itar-e-gulab, surma, sabun, cotton roll.',
                'estimated_cost' => 2200.00,
                'provider_name' => 'Sahaara Tajheez Supplies',
                'contact_phone' => '0321-5551234',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['kafan']->id,
                'name' => 'Complete Zananah Kafan Box (5 Pieces)',
                'description' => '5 pieces cloth according to Sunnah, kafoor, rose water, scent, organic soap, shuhda cloth & packaging.',
                'estimated_cost' => 2600.00,
                'provider_name' => 'Sahaara Tajheez Supplies',
                'contact_phone' => '0321-5551234',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['qabar']->id,
                'name' => 'Gor-kan Service & Qabar Khudaai',
                'description' => 'Official grave digger arrangement, pre-digging, cleaning and ground leveling.',
                'estimated_cost' => 2000.00,
                'provider_name' => 'Qabristan Committee Coordination',
                'contact_phone' => '0333-4445555',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['qabar']->id,
                'name' => 'Qabar Slabs (Cement Paat) & Eentein',
                'description' => 'Set of 12-14 reinforced concrete slabs (paat) and bricks delivered on site.',
                'estimated_cost' => 3000.00,
                'provider_name' => 'Qabristan Material Services',
                'contact_phone' => '0333-4445555',
                'is_available' => true,
            ]);

            Service::create([
                'category_id' => $categories['welfare']->id,
                'name' => 'Sadqah-e-Jariyah / Muft Kafan Dafan (Mustahiq)',
                'description' => 'Bilkul muft sahoolat un khandan ke liye jo kharch ada nahi kar sakte. Supported by public donations and trusts.',
                'estimated_cost' => 0.00,
                'provider_name' => 'Sahaara Welfare Fund',
                'contact_phone' => '0300-0000000',
                'is_available' => true,
            ]);
        }
    }
}
