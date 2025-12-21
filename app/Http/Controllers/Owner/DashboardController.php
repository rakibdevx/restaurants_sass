<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Admin\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('owner.dashboard.index');
    }

    public function purchase($id)
    {
        $plan = Plan::findOrFail($id);
        $user = auth()->guard('owner')->user();

        $baseDate = $user->expiry_time && Carbon::parse($user->expiry_time)->isFuture()
            ? Carbon::parse($user->expiry_time)
            : Carbon::now();
        $baseDate->addDays($plan->duration);
        $user->expiry_time = $baseDate;
        $user->save();

        return redirect(route('owner.dashboard'))->with('success', 'Plan purchased successfully');
    }
}
