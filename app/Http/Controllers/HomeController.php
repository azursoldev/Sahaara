<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\JanazahAnnouncement;
use App\Models\Graveyard;
use App\Models\Service;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $selectedCityId = $request->query('city_id');

        $cities = City::where('is_active', true)->orderBy('name')->get();
        $categories = ServiceCategory::with(['services' => function ($query) {
            $query->where('is_available', true);
        }])->get();

        $janazahsQuery = JanazahAnnouncement::with('city')
            ->whereDate('janazah_date', '>=', now()->toDateString())
            ->orderBy('janazah_date', 'asc');

        if ($selectedCityId) {
            $janazahsQuery->where('city_id', $selectedCityId);
        }

        $upcomingJanazahs = $janazahsQuery->take(6)->get();

        $graveyardsQuery = Graveyard::with('city');
        if ($selectedCityId) {
            $graveyardsQuery->where('city_id', $selectedCityId);
        }
        $graveyards = $graveyardsQuery->take(6)->get();

        return view('home', compact('cities', 'categories', 'upcomingJanazahs', 'graveyards', 'selectedCityId'));
    }

    public function emergencyGuide()
    {
        return view('guide');
    }
}
