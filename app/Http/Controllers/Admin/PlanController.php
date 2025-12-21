<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index(Request $request)
    {
        $query = Plan::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $plans = $query->orderBy('id', 'desc')->get();

        return view('admin.plan.index', compact('plans'));
    }

    public function create()
    {
        $features = ['Website', 'Online Ordering', 'Menu Management', 'Analytics', 'Support'];
        return view('admin.plan.create', compact('features'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:plans,slug',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:5',
            'duration' => 'required|numeric',
            'duration_type' => 'required|string|max:5',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $features = $request->input('features', []);
        $data['features'] = json_encode($features);

        Plan::create($data);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
    }

    // Show edit form
    public function edit(Plan $plan)
    {
        $features = ['Website', 'Online Ordering', 'Menu Management', 'Analytics', 'Support'];
        $plan->features = json_decode($plan->features, true) ?? [];
        return view('admin.plan.edit', compact('plan','features'));
    }

    // Update plan
    public function update(Request $request, Plan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:plans,slug,'.$plan->id,
            'price' => 'required|numeric',
            'currency' => 'required|string|max:5',
            'duration' => 'required|numeric',
            'duration_type' => 'required|string|max:5',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Features
        $features = $request->input('features', []);
        $data['features'] = json_encode($features);

        $plan->update($data);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully!');
    }
}
