<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportFilterRequest;
use App\Models\Category;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(ReportFilterRequest $request): View
    {
        return view('admin.reports.index', [
            'complaints' => $this->query($request->validated())->paginate(15)->withQueryString(),
            'categories' => Category::orderBy('category_name')->get(),
            'statuses' => Complaint::STATUSES,
            'filters' => $request->validated(),
        ]);
    }

    public function pdf(ReportFilterRequest $request): HttpResponse
    {
        $complaints = $this->query($request->validated())->get();
        $pdf = Pdf::loadView('admin.reports.pdf', compact('complaints'));

        return $pdf->stream('laporan-pengaduan.pdf');
    }

    private function query(array $filters): Builder
    {
        return Complaint::with(['user', 'category'])->filter($filters)->latest('complaint_date');
    }
}
