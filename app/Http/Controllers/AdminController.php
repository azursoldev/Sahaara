<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\JanazahAnnouncement;
use App\Models\Graveyard;
use App\Models\Volunteer;
use App\Models\City;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $statusFilter = $request->query('status');

        $requestsQuery = ServiceRequest::with('city')->orderBy('created_at', 'desc');
        if ($statusFilter) {
            $requestsQuery->where('status', $statusFilter);
        }
        $requests = $requestsQuery->paginate(15)->withQueryString();

        $stats = [
            'total_requests' => ServiceRequest::count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'assigned_requests' => ServiceRequest::where('status', 'assigned')->count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
            'mustahiq_requests' => ServiceRequest::where('is_mustahiq', true)->count(),
            'total_janazahs' => JanazahAnnouncement::count(),
            'total_graveyards' => Graveyard::count(),
            'total_volunteers' => Volunteer::count(),
        ];

        $volunteers = Volunteer::with('city')->take(10)->get();

        return view('admin.dashboard', compact('requests', 'stats', 'statusFilter', 'volunteers'));
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

        return back()->with('success', 'Request #' . $serviceRequest->tracking_code . ' status update ho gaya hai: ' . strtoupper($validated['status']));
    }
}
