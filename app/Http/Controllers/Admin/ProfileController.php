<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'user_name' => 'nullable|string|max:255|unique:admins,username,' . $admin->id,
            'email'    => 'nullable|email|max:255|unique:admins,email,' . $admin->id,
            'name'     => 'nullable|string|max:255',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            if ($admin->avatar && file_exists(public_path($admin->avatar))) {
                unlink(public_path($admin->avatar));
            }

            $file = $request->photo;
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admins/profile/'), $filename);

            $admin->avatar = 'uploads/admins/profile/' . $filename;
            $admin->save();
            return response()->json(['status' => 'success']);
        }


        $admin->username = $request->user_name ?? $admin->username;
        $admin->email = $request->email ?? $admin->email;
        $admin->name = $request->name ?? $admin->name;

        $admin->save();

        return back()->with('success','Profile update Successfully');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->last_password_change = Carbon::now();
        $admin->save();

        return back()->with('success', 'Password updated successfully!');
    }



}
