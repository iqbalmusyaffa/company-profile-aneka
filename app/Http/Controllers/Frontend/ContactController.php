<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\BugReport;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function send(Request $request)
    {
        // Simple mock
        return back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }

    public function feedback()
    {
        return view('frontend.feedback');
    }

    public function storeFeedback(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create($validated);

        return back()->with('success', 'Kritik & Saran Anda berhasil dikirim. Terima kasih atas masukan Anda!');
    }

    public function bugReport()
    {
        return view('frontend.bug-report');
    }

    public function storeBugReport(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'page_url' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,txt,zip|max:5120', // Max 5MB
        ]);

        $bugReport = BugReport::create([
            'name' => $validated['name'],
            'contact' => $validated['contact'],
            'page_url' => $validated['page_url'],
            'message' => $validated['message'],
        ]);

        if ($request->hasFile('attachment')) {
            $bugReport->addMediaFromRequest('attachment')->toMediaCollection('attachments');
        }

        return back()->with('success', 'Laporan Bug berhasil dikirim. Tim teknis kami akan segera memeriksanya!');
    }
}
