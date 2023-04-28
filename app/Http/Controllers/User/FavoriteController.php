<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $favorite = Favorite::where('user_id', auth()->user()->id)
            ->where('favoritable_type', $request->favoritable_type)
            ->where('favoritable_id', $request->favoritable_id)
            ->first();
        
        if ($favorite == null) {
            // Create new favorite record
            Favorite::create([
                'user_id' => auth()->user()->id,
                'favoritable_type' => $request->favoritable_type,
                'favoritable_id' => $request->favoritable_id
            ]);

            activity()->log('Menambahkan ' . $request->item . ' kedalam list item favorit');
        }
        else {
            // Remove from favorite
            $favorite->delete();
            activity()->log('Menghapus ' . $request->item . ' dari list item favorit');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
