<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JanazahAnnouncement;
use App\Models\City;
use App\Models\Graveyard;
use Illuminate\Support\Str;

class JanazahController extends Controller
{
    public function index(Request $request)
    {
        $cityId = $request->query('city_id');
        $search = $request->query('search');

        $cities = City::where('is_active', true)->orderBy('name')->get();

        $query = JanazahAnnouncement::with('city')->orderBy('janazah_date', 'desc');

        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('deceased_name', 'like', "%{$search}%")
                  ->orWhere('mosque_or_place', 'like', "%{$search}%")
                  ->orWhere('graveyard_name', 'like', "%{$search}%");
            });
        }

        $announcements = $query->paginate(12)->withQueryString();

        return view('janazah.index', compact('announcements', 'cities', 'cityId', 'search'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('janazah.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'deceased_name' => 'required|string|max:255',
            'relation_title' => 'nullable|string|max:100',
            'family_member_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:50',
            'janazah_date' => 'required|date',
            'janazah_prayer_time' => 'required|string|max:100',
            'mosque_or_place' => 'required|string|max:500',
            'graveyard_name' => 'nullable|string|max:255',
            'additional_details' => 'nullable|string|max:1000',
        ]);

        $uniqueCode = 'JNZ-' . strtoupper(Str::random(2)) . rand(100, 999);

        $announcement = JanazahAnnouncement::create([
            'unique_code' => $uniqueCode,
            'city_id' => $validated['city_id'],
            'deceased_name' => $validated['deceased_name'],
            'relation_title' => $validated['relation_title'] ?? null,
            'family_member_name' => $validated['family_member_name'],
            'contact_phone' => $validated['contact_phone'],
            'janazah_date' => $validated['janazah_date'],
            'janazah_prayer_time' => $validated['janazah_prayer_time'],
            'mosque_or_place' => $validated['mosque_or_place'],
            'graveyard_name' => $validated['graveyard_name'] ?? null,
            'additional_details' => $validated['additional_details'] ?? null,
        ]);

        return redirect()->route('janazah.show', $announcement->unique_code)
            ->with('success', 'Namaz-e-Janazah ka ailaan card tayyar ho gaya hai!');
    }

    public function show($unique_code)
    {
        $announcement = JanazahAnnouncement::with('city')
            ->where('unique_code', $unique_code)
            ->firstOrFail();

        $announcement->increment('views');

        return view('janazah.show', compact('announcement'));
    }
}
