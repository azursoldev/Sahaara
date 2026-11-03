<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\JanazahAnnouncement;
use App\Models\Graveyard;
use App\Models\Volunteer;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\City;

class AdminController extends Controller
{
    /**
     * Dashboard Overview
     */
    public function dashboard(Request $request)
    {
        $stats = [
            'total_requests' => ServiceRequest::count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'assigned_requests' => ServiceRequest::where('status', 'assigned')->count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
            'mustahiq_requests' => ServiceRequest::where('is_mustahiq', true)->count(),
            'total_janazahs' => JanazahAnnouncement::count(),
            'total_graveyards' => Graveyard::count(),
            'total_services' => Service::count(),
            'total_volunteers' => Volunteer::count(),
        ];

        $recentRequests = ServiceRequest::with('city')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $recentJanazahs = JanazahAnnouncement::with('city')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $volunteers = Volunteer::with('city')->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'recentJanazahs', 'volunteers'));
    }

    /**
     * Manage Service Requests
     */
    public function requests(Request $request)
    {
        $statusFilter = $request->query('status');
        $search = $request->query('search');

        $query = ServiceRequest::with('city')->orderBy('created_at', 'desc');

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tracking_code', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('contact_phone', 'like', "%{$search}%")
                  ->orWhere('deceased_name', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        $pendingCount = ServiceRequest::where('status', 'pending')->count();

        return view('admin.requests', compact('requests', 'statusFilter', 'search', 'pendingCount'));
    }

    public function updateRequestStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,assigned,in_progress,completed,cancelled',
            'admin_remarks' => 'nullable|string|max:1000',
        ]);

        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->update([
            'status' => $validated['status'],
            'admin_remarks' => $validated['admin_remarks'],
        ]);

        return back()->with('success', 'Request #' . $serviceRequest->tracking_code . ' ka status update ho gaya: ' . strtoupper($validated['status']));
    }

    /**
     * Manage Services
     */
    public function services()
    {
        $services = Service::with(['category', 'city'])->orderBy('category_id')->paginate(15);
        $categories = ServiceCategory::all();
        $cities = City::where('is_active', true)->get();

        return view('admin.services', compact('services', 'categories', 'cities'));
    }

    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'city_id' => 'nullable|exists:cities,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_cost' => 'required|numeric|min:0',
            'provider_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'is_available' => 'nullable|boolean',
        ]);

        Service::create([
            'category_id' => $validated['category_id'],
            'city_id' => $validated['city_id'] ?? null,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'estimated_cost' => $validated['estimated_cost'],
            'provider_name' => $validated['provider_name'] ?? null,
            'contact_phone' => $validated['contact_phone'] ?? null,
            'is_available' => $request->has('is_available'),
        ]);

        return back()->with('success', 'Nayi Service shamil kar di gayi hai!');
    }

    public function deleteService($id)
    {
        Service::findOrFail($id)->delete();
        return back()->with('success', 'Service delete kar di gayi hai.');
    }

    /**
     * Manage Graveyards
     */
    public function graveyards()
    {
        $graveyards = Graveyard::with('city')->orderBy('name')->paginate(15);
        $cities = City::where('is_active', true)->get();

        return view('admin.graveyards', compact('graveyards', 'cities'));
    }

    public function storeGraveyard(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:50',
            'contact_person' => 'nullable|string|max:255',
            'has_space' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        Graveyard::create([
            'city_id' => $validated['city_id'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'] ?? null,
            'contact_person' => $validated['contact_person'] ?? null,
            'has_space' => $request->has('has_space'),
            'notes' => $validated['notes'] ?? null,
        ]);

        return back()->with('success', 'Naya Qabristan shamil kar diya gaya hai!');
    }

    public function deleteGraveyard($id)
    {
        Graveyard::findOrFail($id)->delete();
        return back()->with('success', 'Qabristan delete kar diya gaya hai.');
    }

    /**
     * Manage Janazah Announcements
     */
    public function janazahs()
    {
        $janazahs = JanazahAnnouncement::with('city')->orderBy('janazah_date', 'desc')->paginate(15);
        return view('admin.janazahs', compact('janazahs'));
    }

    public function deleteJanazah($id)
    {
        JanazahAnnouncement::findOrFail($id)->delete();
        return back()->with('success', 'Janazah ailaan delete kar diya gaya.');
    }

    /**
     * Manage Volunteers & Providers
     */
    public function volunteers()
    {
        $volunteers = Volunteer::with('city')->orderBy('name')->paginate(15);
        $cities = City::where('is_active', true)->get();

        return view('admin.volunteers', compact('volunteers', 'cities'));
    }

    public function storeVolunteer(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'service_type' => 'required|string|max:50',
            'area' => 'nullable|string|max:255',
        ]);

        Volunteer::create([
            'city_id' => $validated['city_id'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'service_type' => $validated['service_type'],
            'area' => $validated['area'] ?? null,
            'is_active' => true,
        ]);

        return back()->with('success', 'Field Provider / Volunteer shamil kar diya gaya!');
    }

    public function deleteVolunteer($id)
    {
        Volunteer::findOrFail($id)->delete();
        return back()->with('success', 'Volunteer delete kar diya gaya.');
    }

    /**
     * Manage Cities
     */
    public function cities()
    {
        $cities = City::withCount(['services', 'graveyards', 'serviceRequests'])->orderBy('name')->get();
        return view('admin.cities', compact('cities'));
    }

    public function storeCity(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:cities,name',
            'province' => 'required|string|max:100',
        ]);

        City::create([
            'name' => $validated['name'],
            'province' => $validated['province'],
            'is_active' => true,
        ]);

        return back()->with('success', 'Naya Shehar shamil ho gaya!');
    }

    public function deleteCity($id)
    {
        City::findOrFail($id)->delete();
        return back()->with('success', 'Shehar delete kar diya gaya.');
    }
}
