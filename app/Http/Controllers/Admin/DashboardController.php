<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'    => Enquiry::count(),
            'new'      => Enquiry::where('status', 'new')->count(),
            'contacted'=> Enquiry::where('status', 'contacted')->count(),
            'enrolled' => Enquiry::where('status', 'enrolled')->count(),
            'today'    => Enquiry::whereDate('created_at', today())->count(),
        ];

        $recent = Enquiry::latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }

    public function enquiries(Request $request)
    {
        $query = Enquiry::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%");
            });
        }

        $enquiries = $query->paginate(20);
        return view('admin.enquiries', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        // Mark as read
        if ($enquiry->status === 'new') {
            $enquiry->update(['status' => 'read']);
        }
        return view('admin.enquiry-detail', compact('enquiry'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:new,read,contacted,enrolled,rejected']);
        Enquiry::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();
        return redirect()->route('admin.enquiries')->with('success', 'Enquiry deleted.');
    }
}
