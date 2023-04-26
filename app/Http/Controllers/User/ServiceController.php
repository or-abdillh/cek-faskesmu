<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'unit_type' => 'required',
            'description' => 'required'
        ]);

        Service::create($request->all());
        activity()->log('Membuat layanan baru');
    }
}
