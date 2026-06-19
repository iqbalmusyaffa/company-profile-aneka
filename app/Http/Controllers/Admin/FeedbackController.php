<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(15);
        
        // Mark all unread as read when admin visits the page
        Feedback::where('is_read', false)->update(['is_read' => true]);

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Kritik & Saran berhasil dihapus.');
    }
}
