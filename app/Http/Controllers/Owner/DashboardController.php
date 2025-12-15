<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Admin\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('owner.dashboard.index');
    }

    public function purchase($id)
    {
        $plan = Plan::find($id);
        dd($plan);
    }
}
