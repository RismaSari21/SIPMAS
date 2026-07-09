<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\SupabaseStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(
        ProfileUpdateRequest $request,
        SupabaseStorageService $storage
    ): RedirectResponse {

        $user = $request->user();
        $data = $request->validated();


        if ($request->hasFile('photo')) {

            // upload foto baru ke Supabase
            $data['photo'] = $storage->upload(
                $request->file('photo'),
                'profiles'
            );

        }


        $user->fill($data);


        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }


        $user->save();


        return Redirect::route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);


        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return Redirect::to('/');
    }
}
