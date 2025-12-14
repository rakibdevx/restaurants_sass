<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Plan;
use App\Models\Admin\Theme;
use App\Models\Owner\Owner;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $tenant;
    protected $theme;
    protected $owner;
    protected $domainType;

    public function __construct()
    {
        $this->domainType = app('domain_type');

        if ($this->domainType !== 'main') {
            $this->tenant = app('tenant');
            $this->owner = Owner::find($this->tenant);
            $this->theme = Theme::find($this->owner->theme);
        }
    }

    public function index()
    {
        if ($this->domainType === 'main') {
            $plans = Plan::where('status','active')->get();
            return view('frontend.main.home.index',compact('plans'));
        }

        $viewPath = 'frontend.' . $this->theme->assets_path . '.home.index';

        return view($viewPath, [
            'owner' => $this->owner,
            'theme' => $this->theme,
        ]);
    }
}
