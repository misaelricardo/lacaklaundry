<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\AkunAdmin;
use App\Models\AkunStaff;
use Illuminate\Http\Request;

class SettingsAdminController extends Controller
{
    public function SettingsAdmin()
    {
        $user = Auth::user();
        $isAdmin = AkunAdmin::where('username', $user->username)->exists();
        $isStaff = AkunStaff::where('username', $user->username)->exists();

        if ($isAdmin) {
            $role = 'Admin';
        } elseif ($isStaff) {
            $role = 'Staff';
        } else {
            $role = null;
        }

        return view('SettingsAdmin', compact('role'));
    }
}
