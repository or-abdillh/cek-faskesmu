<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'facility_id' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'unit_type' => 'required',
            'description' => 'required'
        ]);

        activity()->log('Melakukan perubahan data layanan ' . $service->name);
        $service->update($request->all());
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        activity()->log('Mengahapus data layanan ' . $service->name);
        $service->delete();
    }

    public function reset()
    {
        $user = User::find(auth()->user()->id);

        $user->facility->services->when(
            function($collection) { return $collection->isNotEmpty(); },
            function($collection) {
                $collection->map(function($col) {
                    $col->delete();
                });
            }
        );

        activity()->log('Melakukan reset seluruh data layanan');
    }
}
