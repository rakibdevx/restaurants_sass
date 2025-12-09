<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if ($owner->profile_image && file_exists(public_path('uploads/owners/profile/' . $owner->profile_image))) {
                unlink(public_path('uploads/owners/profile/' . $owner->profile_image));
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

    public function information(Request $request)
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
}
