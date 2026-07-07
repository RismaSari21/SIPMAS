<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $monthlyLabels = [];
        $monthlyData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyLabels[] = $date->translatedFormat('M Y');
            $monthlyData[] = Complaint::whereYear('complaint_date', $date->year)
                ->whereMonth('complaint_date', $date->month)
                ->count();
        }

        $categoryStats = Category::withCount('complaints')->orderBy('category_name')->get();
        $provinceStats = Complaint::query()
            ->selectRaw('province_name, COUNT(*) as total')
            ->groupBy('province_name')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalComplaints' => Complaint::count(),
            'todayComplaints' => Complaint::whereDate('created_at', today())->count(),
            'waiting' => Complaint::where('status', Complaint::STATUS_WAITING)->count(),
            'process' => Complaint::where('status', Complaint::STATUS_PROCESS)->count(),
            'done' => Complaint::where('status', Complaint::STATUS_DONE)->count(),
            'rejected' => Complaint::where('status', Complaint::STATUS_REJECTED)->count(),
            'latestComplaints' => Complaint::with(['user', 'category'])->latest()->limit(10)->get(),
            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,
            'categoryLabels' => $categoryStats->pluck('category_name'),
            'categoryData' => $categoryStats->pluck('complaints_count'),
            'provinceLabels' => $provinceStats->pluck('province_name'),
            'provinceData' => $provinceStats->pluck('total'),
        ]);
    }
}
