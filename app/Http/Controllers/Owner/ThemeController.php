<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Theme;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::latest()->get();
        return view('owner.theme.index',compact('themes'));
    }
    public function active($id)
    {
        $theme = Theme::findOrFail($id);
        $owner = Auth::guard('owner')->user();
        $owner->update([
            'theme'       => $theme->id,
        ]);

        return back()->with('success','Theme Updated Successfully');
    }
}
