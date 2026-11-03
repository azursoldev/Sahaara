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
            $cities[$c['name']] = City::create($c);
        }

        // 2. Categories
        $categories = [
            'transport' => ServiceCategory::create([
                'name' => 'Ambulance & Maiyat Bus (Transport)',
                'slug' => 'transport',
                'icon' => 'bi-truck-front',
                'description' => 'Hospital se ghar aur ghar se qabristan ya shehar se baahar maiyat le jaane ke liye emergency gaariyan.'
            ]),
            'ghusl' => ServiceCategory::create([
                'name' => 'Ghusl & Ghassal Khidmat',
                'slug' => 'ghusl',
                'icon' => 'bi-droplet-half',
                'description' => 'Tajurbakar ba-shara Mard aur Aurat Ghassal, Ghusl-khana aur mortuary facility.'
            ]),
            'kafan' => ServiceCategory::create([
                'name' => 'Kafan & Tajheez Saman Package',
                'slug' => 'kafan-package',
                'icon' => 'bi-box-seam',
                'description' => 'Mukammal kafan package (Kapra, Kafoor, Gulab Arq, Itar, Sabun, Looban, Bardana waghera).'
            ]),
            'qabar' => ServiceCategory::create([
                'name' => 'Qabar & Gor-kan Intezamat',
                'slug' => 'qabar-intezamat',
                'icon' => 'bi-layers-fill',
                'description' => 'Qabar ki khudaai, cement ke paat/takhtay, eentein, qabar ki takhti (nameplate).'
            ]),
            'announcement' => ServiceCategory::create([
                'name' => 'Namaz-e-Janazah Ailaan (Digital Card)',
                'slug' => 'janazah-announcement',
                'icon' => 'bi-megaphone',
                'description' => 'Janazah ke waqt aur maqam ka shareable digital card aur notice board.'
            ]),
            'welfare' => ServiceCategory::create([
                'name' => 'Mustahiq Imdaad (Free Welfare)',
                'slug' => 'mustahiq-support',
                'icon' => 'bi-hand-thumbs-up-fill',
                'description' => 'Jo khandan kharche bardasht nahi kar sakte, unke liye bilkul muft (free) kafan dafan intezam.'
            ]),
        ];

        // 3. Sample Services
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

        // 4. Sample Graveyards
        $sampleGraveyards = [
            ['city' => 'Karachi', 'name' => 'Mewa Shah Qabristan', 'address' => 'SITE Area / Lyari', 'phone' => '021-32560000', 'notes' => 'Oldest historic graveyard, multiple sectors.'],
            ['city' => 'Karachi', 'name' => 'Yasinabad Qabristan', 'address' => 'Gulberg Town / F.B Area', 'phone' => '021-36340000', 'notes' => 'Managed by local committee, gate 1 & 2.'],
            ['city' => 'Karachi', 'name' => 'Wadi-e-Hussain Qabristan', 'address' => 'Super Highway (M-9)', 'phone' => '0300-8220000', 'notes' => 'Organized computerized record system.'],
            ['city' => 'Lahore', 'name' => 'Miani Sahib Qabristan', 'address' => 'Chauburji / Mozang', 'phone' => '042-37120000', 'notes' => 'Largest graveyard in Lahore, committee office at main gate.'],
            ['city' => 'Lahore', 'name' => 'Model Town Graveyard', 'address' => 'Model Town Block P', 'phone' => '042-35850000', 'notes' => 'Paved pathways and well-maintained.'],
            ['city' => 'Rawalpindi', 'name' => 'Ratta Amral Graveyard', 'address' => 'Ratta Amral Road', 'phone' => '051-5550000', 'notes' => 'Municipal committee authorized.'],
            ['city' => 'Islamabad', 'name' => 'H-8 Graveyard Islamabad', 'address' => 'Sector H-8/1', 'phone' => '051-9250000', 'notes' => 'CDA Directorate of Municipal Administration, computerized records.'],
            ['city' => 'Faisalabad', 'name' => 'Ghulshan-e-Behisht Qabristan', 'address' => 'Sargodha Road', 'phone' => '041-8760000', 'notes' => 'Active welfare office on site.'],
        ];

        foreach ($sampleGraveyards as $g) {
            $city = $cities[$g['city']] ?? $cities['Karachi'];
            Graveyard::create([
                'city_id' => $city->id,
                'name' => $g['name'],
                'address' => $g['address'],
                'sector_or_area' => $g['address'],
                'phone' => $g['phone'],
                'notes' => $g['notes'],
                'has_space' => true,
            ]);
        }

        // 5. Sample Janazah Announcements
        JanazahAnnouncement::create([
            'unique_code' => 'JNZ-9182',
            'city_id' => $cities['Lahore']->id,
            'deceased_name' => 'Haji Muhammad Iqbal (Late)',
            'relation_title' => 'Walid-e-Mohtaram',
            'family_member_name' => 'Tariq Iqbal (Son)',
            'contact_phone' => '0300-4567890',
            'janazah_date' => now()->toDateString(),
            'janazah_prayer_time' => 'Baad Namaz-e-Asr (5:15 PM)',
            'mosque_or_place' => 'Jamia Masjid Bilal, Block E, Johar Town, Lahore',
            'graveyard_name' => 'Miani Sahib Qabristan',
            'additional_details' => 'Janazah ke baad tadfeen Miani Sahib qabristan mein hogi. Dosto ahbaab se maghfirat ki dua ki iltija hai.',
            'views' => 142,
        ]);

        JanazahAnnouncement::create([
            'unique_code' => 'JNZ-6341',
            'city_id' => $cities['Karachi']->id,
            'deceased_name' => 'Mohtarma Begum Rasheeda Akhtar (Late)',
            'relation_title' => 'Walida-e-Mohtarma',
            'family_member_name' => 'Salman Akhtar (Son)',
            'contact_phone' => '0321-8765432',
            'janazah_date' => now()->addDay()->toDateString(),
            'janazah_prayer_time' => 'Baad Namaz-e-Zohr (1:45 PM)',
            'mosque_or_place' => 'Masjid-e-Tooba (Gol Masjid), DHA Phase 2, Karachi',
            'graveyard_name' => 'Yasinabad Qabristan',
            'additional_details' => 'Soyem ka intezam parson ba-mukaam rehaish gah hoga.',
            'views' => 88,
        ]);

        // 6. Sample Volunteers / Contacts
        Volunteer::create([
            'city_id' => $cities['Karachi']->id,
            'name' => 'Qari Abdul Rehman',
            'phone' => '0301-2233445',
            'service_type' => 'ghassal_male',
            'area' => 'Gulshan-e-Iqbal & PECHS',
            'is_active' => true,
        ]);

        Volunteer::create([
            'city_id' => $cities['Lahore']->id,
            'name' => 'Bibi Fatima / Apa Shamim',
            'phone' => '0315-9988776',
            'service_type' => 'ghassal_female',
            'area' => 'Allama Iqbal Town & Faisal Town',
            'is_active' => true,
        ]);

        Volunteer::create([
            'city_id' => $cities['Islamabad']->id,
            'name' => 'Malik Aslam (Ambulance Driver)',
            'phone' => '0345-1122334',
            'service_type' => 'driver',
            'area' => 'Rawalpindi / Islamabad Twin Cities',
            'is_active' => true,
        ]);

        // 7. Sample Initial Service Request
        ServiceRequest::create([
            'tracking_code' => 'SHR-' . rand(10000, 99999),
            'city_id' => $cities['Karachi']->id,
            'deceased_name' => 'Abdul Ghafoor (Marhoom)',
            'deceased_gender' => 'male',
            'contact_name' => 'Muhammad Rashid',
            'contact_phone' => '0333-9876543',
            'contact_relation' => 'Son',
            'pickup_address' => 'House 45, Street 8, Bahadurabad, Karachi',
            'destination_address' => 'Yasinabad Qabristan',
            'services_needed' => ['ambulance', 'ghusl', 'kafan'],
            'is_mustahiq' => false,
            'status' => 'confirmed',
            'notes' => 'Kindly dispatch kafan package and male ghassal by 11:00 AM.',
            'admin_remarks' => 'Assigned driver Zahid (Ambulance # KHI-442) and Qari Abdul Rehman.',
        ]);
    }
}
