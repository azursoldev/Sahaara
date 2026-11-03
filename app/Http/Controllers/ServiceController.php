<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\City;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $categories = ServiceCategory::with(['services' => function ($q) {
            $q->where('is_available', true);
        }])->get();

        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('services.index', compact('categories', 'cities'));
    }

    public function showCategory($slug)
    {
        $category = ServiceCategory::where('slug', $slug)
            ->with(['services' => function ($q) {
                $q->where('is_available', true);
            }])
            ->firstOrFail();

        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('services.category', compact('category', 'cities'));
    }
}
