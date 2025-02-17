<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Boxes;
use Illuminate\Support\Facades\Log;

class BoxesController extends Controller
{
    /**
     * Display all the boxes the user's can see.
     */
    public function getAll(Request $request): View
    {
        $boxes = Boxes::where("user_id", Auth::id())->get();

        return view('boxes.get-all', [
            'boxes' => $boxes,
            'user' => $request->user(),
        ]);
    }

    /**
     * Display one box that user can see.
     */
    public function getOne(Request $request): View
    {
        $id = $request->route('id');
        $box = Boxes::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
        ])->firstOrFail();

        return view('boxes.get-one', [
            'box' => $box,
            'user' => $request->user(),
        ]);
    }

    /**
     * Create one box
    */    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'adress' => 'required|string|max:255',
            'number' => 'required|digits:3',
            'size' => 'required|numeric|between:0,99999.99',
        ]);

        $userId = Auth::id();

        $validatedData['user_id'] = $userId;

    
        Boxes::create($validatedData);
    
        return redirect()->back()->with('success', 'Box ajoutée avec succès !');
    }

    /**
     * Update one box
    */    
    public function update(Request $request)
    {
        $boxToUpdateId = $request->route('id');;
        $boxToUpdate = Boxes::findOrFail($boxToUpdateId);

        if ($boxToUpdate->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette box.');
        }
        
        $validatedData = $request->validate([
            'adress' => 'required|string|max:255',
            'number' => 'required|digits:3',
            'size' => 'required|numeric|between:0,99999.99',
        ]);
        
        $boxToUpdate->update($validatedData);

        return redirect()->back()->with('success', 'Box mise à jour avec succès !');
    }
}
