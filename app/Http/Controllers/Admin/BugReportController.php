<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BugReport;

class BugReportController extends Controller
{
    public function index()
    {
        $bugReports = BugReport::latest()->paginate(15);
        
        // Mark all unread as read when admin visits the page
        BugReport::where('is_read', false)->update(['is_read' => true]);

        return view('admin.bug-reports.index', compact('bugReports'));
    }

    public function resolve(BugReport $bugReport)
    {
        $bugReport->update(['is_resolved' => true]);
        return back()->with('success', 'Laporan Bug ditandai sebagai Selesai/Resolved.');
    }

    public function destroy(BugReport $bugReport)
    {
        $bugReport->delete();
        return back()->with('success', 'Laporan Bug berhasil dihapus.');
    }
}
