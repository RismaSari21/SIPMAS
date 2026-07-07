<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $query = Complaint::where('user_id', $request->user()->id);

        return view('masyarakat.dashboard', [
            'total' => (clone $query)->count(),
            'waiting' => (clone $query)->where('status', Complaint::STATUS_WAITING)->count(),
            'process' => (clone $query)->where('status', Complaint::STATUS_PROCESS)->count(),
            'done' => (clone $query)->where('status', Complaint::STATUS_DONE)->count(),
            'rejected' => (clone $query)->where('status', Complaint::STATUS_REJECTED)->count(),
            'latestComplaints' => (clone $query)->with('category')->latest()->limit(8)->get(),
        ]);
    }
}
