<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\City;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class ServiceRequestController extends Controller
{
    public function create(Request $request)
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $categories = ServiceCategory::with('services')->get();
        $preselectedService = $request->query('service');

        return view('requests.create', compact('cities', 'categories', 'preselectedService'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'deceased_name' => 'nullable|string|max:255',
            'deceased_gender' => 'required|in:male,female,child,unspecified',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:50',
            'contact_relation' => 'nullable|string|max:100',
            'pickup_address' => 'required|string|max:1000',
            'destination_address' => 'nullable|string|max:1000',
            'services_needed' => 'required|array|min:1',
            'services_needed.*' => 'string',
            'is_mustahiq' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000',
        ]);

        $trackingCode = 'SHR-' . strtoupper(Str::random(3)) . rand(100, 999);

        $serviceRequest = ServiceRequest::create([
            'tracking_code' => $trackingCode,
            'city_id' => $validated['city_id'],
            'deceased_name' => $validated['deceased_name'],
            'deceased_gender' => $validated['deceased_gender'],
            'contact_name' => $validated['contact_name'],
            'contact_phone' => $validated['contact_phone'],
            'contact_relation' => $validated['contact_relation'] ?? null,
            'pickup_address' => $validated['pickup_address'],
            'destination_address' => $validated['destination_address'] ?? null,
            'services_needed' => $validated['services_needed'],
            'is_mustahiq' => $request->has('is_mustahiq'),
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('requests.show', $serviceRequest->tracking_code)
            ->with('success', 'Aapki emergency request darj ho chuki hai. Tracking Code: ' . $trackingCode);
    }

    public function show($tracking_code)
    {
        $serviceRequest = ServiceRequest::with('city')
            ->where('tracking_code', $tracking_code)
            ->firstOrFail();

        return view('requests.show', compact('serviceRequest'));
    }

    public function track(Request $request)
    {
        $code = trim($request->input('tracking_code', ''));
        if ($code) {
            $serviceRequest = ServiceRequest::where('tracking_code', $code)->first();
            if ($serviceRequest) {
                return redirect()->route('requests.show', $serviceRequest->tracking_code);
            }
            return back()->with('error', 'Diya gaya Tracking Code (' . e($code) . ') nahi mila. Barah-e-karam dobara check karein.');
        }

        return view('requests.track');
    }
}
