<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.complaints.index', [
            'complaints' => Complaint::with(['user', 'category'])->filter($request->only([
                'search', 'category_id', 'status', 'province_id', 'regency_id', 'date_from', 'date_to', 'month', 'year',
            ]))->latest()->paginate(10)->withQueryString(),
            'categories' => Category::orderBy('category_name')->get(),
            'statuses' => Complaint::STATUSES,
            'filters' => $request->all(),
        ]);
    }

    public function show(Complaint $complaint): View
    {
        return view('admin.complaints.show', [
            'complaint' => $complaint->load(['user', 'category', 'responses.admin']),
            'statuses' => Complaint::STATUSES,
        ]);
    }

    public function edit(Complaint $complaint): View
    {
        return view('admin.complaints.edit', [
            'complaint' => $complaint->load(['user', 'category']),
            'categories' => Category::orderBy('category_name')->get(),
            'statuses' => Complaint::STATUSES,
        ]);
    }

    public function update(UpdateComplaintStatusRequest $request, Complaint $complaint): RedirectResponse
    {
        $oldStatus = $complaint->status;
        $complaint->update(['status' => $request->validated('status')]);

        if ($request->filled('response')) {
            Response::create([
                'complaint_id' => $complaint->id,
                'admin_id' => $request->user()->id,
                'response' => "Status {$oldStatus} menjadi {$complaint->status}. ".$request->validated('response'),
                'response_date' => now()->toDateString(),
            ]);
        }

        return redirect()->route('admin.complaints.show', $complaint)->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        if ($complaint->photo) {
            Storage::disk('public')->delete($complaint->photo);
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
