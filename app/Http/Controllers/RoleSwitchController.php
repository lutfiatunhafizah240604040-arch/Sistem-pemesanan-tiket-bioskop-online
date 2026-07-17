<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleSwitchController extends Controller
{
    public function switch(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $targetRole = $user->role === 'admin' ? 'user' : 'admin';
        $user->forceFill(['role' => $targetRole])->save();

        return redirect()->back()->with('message', 'Role berhasil diubah menjadi '.$targetRole);
    }
}
