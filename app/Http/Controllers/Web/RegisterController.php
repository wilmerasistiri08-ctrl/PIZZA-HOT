<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'slug' => 'required|unique:tenants',

            'whatsapp_number' => 'required',

            'address' => 'required',

            'google_maps' => 'required',

        ]);

        $logo = null;

        if ($request->hasFile('logo')) {

            $logo = $request->file('logo')
                ->store('tenants', 'public');
        }

        Tenant::create([

            'user_id' => 1,

            'name' => $request->name,

            'slug' => $request->slug,

            'logo' => $logo,

            'whatsapp_number' => $request->whatsapp_number,

            'schedule' => '10:00 - 22:00',

            'address' => $request->address,

            'google_maps' => $request->google_maps,

            'tiktok' => $request->tiktok,

            'is_open' => true

        ]);

        return redirect('/' . $request->slug);
    }
}