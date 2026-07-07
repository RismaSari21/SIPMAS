<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResponseRequest;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;

class ResponseController extends Controller
{
    public function store(StoreResponseRequest $request): RedirectResponse
    {
        Response::create([
            ...$request->validated(),
            'admin_id' => $request->user()->id,
            'response_date' => now()->toDateString(),
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function destroy(Response $response): RedirectResponse
    {
        $response->delete();

        return back()->with('success', 'Tanggapan berhasil dihapus.');
    }
}
