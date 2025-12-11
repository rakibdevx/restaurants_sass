<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('owner.profile.index');
    }

    public function update(Request $request)
    {
        $owner = Auth::guard('owner')->user();

        $request->validate([
            'user_name' => 'nullable|string|max:255|unique:owners,username,' . $owner->id,
            'email'    => 'nullable|email|max:255|unique:owners,email,' . $owner->id,
            'name'     => 'nullable|string|max:255',
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('photo')) {
            if ($owner->profile_image && file_exists(public_path($owner->profile_image))) {
                unlink(public_path($owner->profile_image));
            }

            $file = $request->photo;
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/owners/profile/'), $filename);

            $owner->profile_image = 'uploads/owners/profile/' . $filename;
            $owner->save();
            return response()->json(['status' => 'success']);
        }

        // Business logo
        if ($request->hasFile('logo')) {
            if ($owner->company_logo && file_exists(public_path('uploads/owners/logo/' . $owner->company_logo))) {
                unlink(public_path('uploads/owners/logo/' . $owner->company_logo));
            }

            $file = $request->logo;
            $filename = time() . '_logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/owners/logo/'), $filename);

            $owner->company_logo = 'uploads/owners/logo/' . $filename;
            $owner->save();
            return response()->json(['status' => 'success']);
        }



        $owner->username = $request->user_name ?? $owner->username;
        $owner->email = $request->email ?? $owner->email;
        $owner->name = $request->name ?? $owner->name;

        $owner->save();

        return back()->with('success','Profile update Successfully');
    }

    public function information()
    {
        return view('owner.profile.information');
    }

    public function information_update(Request $request)
    {
        $request->validate([
            'phone'       => 'required|numeric',
            'address'     => 'required|string|max:255',
            'city'        => 'required|string|max:100',
            'state'       => 'required|string|max:100',
            'country'     => 'required|string|max:100',
            'postal_code' => 'required|numeric',
        ]);

        $owner = Auth::guard('owner')->user();
        $owner->update([
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
        ]);

        return back()->with('success','Information update Successfully');

    }
        public function business()
    {
        return view('owner.profile.business');
    }

    public function business_update(Request $request)
    {
        $owner = Auth::guard('owner')->user();

        $request->validate([
            'company_name' => 'required|string|max:255',

            // REGEX + UNIQUE
            'domain' => [
                'nullable',
                // 'url',
                'max:255',
                'unique:owners,domain,' . $owner->id,
            ],
        ]);

        $owner->update([
            'company_name' => $request->company_name,
            'domain'       => $request->domain,
        ]);

        return back()->with('success', 'Business information updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $owner = Auth::guard('owner')->user();

        if (!Hash::check($request->old_password, $owner->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        $owner->password = Hash::make($request->new_password);
        $owner->last_password_change = Carbon::now();
        $owner->save();

        return back()->with('success', 'Password updated successfully!');
    }



}
