<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __invoke(): View
    {
        return view('landing', [
            'totalComplaints' => Complaint::count(),
            'completedComplaints' => Complaint::where('status', Complaint::STATUS_DONE)->count(),
            'totalUsers' => User::where('role', User::ROLE_MASYARAKAT)->count(),
            'categories' => Category::withCount('complaints')->latest()->limit(9)->get(),
        ]);
    }
}
