<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        return view('masyarakat.complaints.index', [
            'complaints' => Complaint::with('category')
                ->where('user_id', $request->user()->id)
                ->filter($request->only(['search', 'category_id', 'status']))
                ->latest()
                ->paginate(10)
                ->withQueryString(),
            'categories' => Category::orderBy('category_name')->get(),
            'statuses' => Complaint::STATUSES,
        ]);
    }

    public function create(): View
    {
        return view('masyarakat.complaints.create', [
            'complaint' => new Complaint(),
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function store(StoreComplaintRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['status'] = Complaint::STATUS_WAITING;
        $data['photo'] = $request->hasFile('photo') ? $request->file('photo')->store('complaints', 'public') : null;

        $complaint = Complaint::create($data);

        return redirect()->route('masyarakat.complaints.show', $complaint)->with('success', 'Pengaduan berhasil dikirim dan menunggu verifikasi.');
    }

    public function show(Request $request, Complaint $complaint): View
    {
        $this->authorizeOwner($request, $complaint);

        return view('masyarakat.complaints.show', [
            'complaint' => $complaint->load(['category', 'responses.admin']),
        ]);
    }

    public function edit(Request $request, Complaint $complaint): View
    {
        $this->authorizeOwner($request, $complaint);
        $this->ensureEditable($complaint);

        return view('masyarakat.complaints.edit', [
            'complaint' => $complaint,
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint): RedirectResponse
    {
        $this->authorizeOwner($request, $complaint);
        $this->ensureEditable($complaint);

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($complaint->photo) {
                Storage::disk('public')->delete($complaint->photo);
            }
            $data['photo'] = $request->file('photo')->store('complaints', 'public');
        }

        $complaint->update($data);

        return redirect()->route('masyarakat.complaints.show', $complaint)->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Request $request, Complaint $complaint): RedirectResponse
    {
        $this->authorizeOwner($request, $complaint);
        $this->ensureEditable($complaint);

        if ($complaint->photo) {
            Storage::disk('public')->delete($complaint->photo);
        }

        $complaint->delete();

        return redirect()->route('masyarakat.complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    private function authorizeOwner(Request $request, Complaint $complaint): void
    {
        abort_unless($complaint->user_id === $request->user()->id, 403);
    }

    private function ensureEditable(Complaint $complaint): void
    {
        abort_unless($complaint->status === Complaint::STATUS_WAITING, 403, 'Pengaduan hanya dapat diubah saat menunggu verifikasi.');
    }
}
