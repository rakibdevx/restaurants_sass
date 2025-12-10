<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Theme;
use App\Models\Owner\Owner;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $tenant;
    protected $theme;
    protected $owner;

    public function __construct()
    {
        $this->tenant = app('tenant');
        $this->owner = Owner::find($this->tenant);
        $this->theme = Theme::find($this->owner->theme);
    }

    public function index()
    {

        $viewPath = 'frontend.' .$this->theme->assets_path . '.home.index';

        return view($viewPath, ['owner' => $this->owner]);
    }
}
