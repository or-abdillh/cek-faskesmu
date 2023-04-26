<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
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

        Drug::create($request->all());
        activity()->log('Menambahkan obatan baru');
    }

    public function update(Request $request, $id)
    {
        $drug = Drug::findOrFail($id);

        $request->validate([
            'facility_id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'unit_type' => 'required',
            'description' => 'required'
        ]);

        activity()->log('Melakukan perubahan data obatan ' . $drug->name);
        $drug->update($request->all());
    }
}
