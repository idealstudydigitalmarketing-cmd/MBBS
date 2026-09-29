<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Mail\NewEnquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'full_name'     => 'required|string|max:100',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|max:100',
            'country'       => 'nullable|string|max:50',
            'qualification' => 'nullable|string|max:50',
            'message'       => 'nullable|string|max:1000',
        ]);

        // Save to database
        $enquiry = Enquiry::create($validated);

        // Send email notification to admin (optional, won't break if SMTP not configured)
        try {
            $adminEmail = config('app.admin_email', env('ADMIN_EMAIL', 'admin@euromedStudy.com'));
            Mail::to($adminEmail)->send(new NewEnquiryMail($enquiry));
        } catch (\Exception $e) {
            // Silent fail — email config not required for site to work
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Our counsellor will contact you within 24 hours.'
            ]);
        }

        return redirect()->route('home')->with('success', 'Thank you! Our counsellor will contact you within 24 hours.');
    }
}
