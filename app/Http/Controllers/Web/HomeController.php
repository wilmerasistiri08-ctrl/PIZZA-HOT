<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenant;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    public function partners()
    {
        $tenants = Tenant::all();
        return view('web.partners', compact('tenants'));
    }

    public function register()
    {
        return view('web.register');
    }
}