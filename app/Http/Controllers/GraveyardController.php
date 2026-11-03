<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Graveyard;
use App\Models\City;

class GraveyardController extends Controller
{
    public function index(Request $request)
    {
        $cityId = $request->query('city_id');
        $search = $request->query('search');

        $cities = City::where('is_active', true)->orderBy('name')->get();

        $query = Graveyard::with('city')->orderBy('name', 'asc');

        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('sector_or_area', 'like', "%{$search}%");
            });
        }

        $graveyards = $query->paginate(12)->withQueryString();

        return view('graveyards.index', compact('graveyards', 'cities', 'cityId', 'search'));
    }

    public function show($id)
    {
        $graveyard = Graveyard::with('city')->findOrFail($id);
        return view('graveyards.show', compact('graveyard'));
    }
}
