<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ContractModels;

class ContractModelsController extends Controller
{
    /**
     * Display all the contract models the user's can see.
     */
    public function getAll(Request $request): View
    {
        $contractModels = ContractModels::where("user_id", Auth::id())->get();

        return view('contractModels.get-all', [
            'contractModels' => $contractModels,
            'user' => $request->user(),
        ]);
    }

    /**
     * Display one contract models that user can see.
     */
    public function getOne(Request $request): View
    {
        $id = $request->route('id');
        $contractModel = ContractModels::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
        ])->firstOrFail();

        return view('contractModels.get-one', [
            'contractModel' => $contractModel,
            'user' => $request->user(),
        ]);
    }

    /**
     * Create one contract models
    */    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);
        $userId = Auth::id();
        $validatedData['user_id'] = $userId;

        ContractModels::create($validatedData);
    
        return redirect()->back()->with('success', 'Modèle de contrat ajoutée avec succès !');
    }

    /**
     * Update one contract models
    */    
    public function update(Request $request)
    {
        $contractModelToUpdateId = $request->route('id');;
        $contractModelToUpdate = ContractModels::findOrFail($contractModelToUpdateId);

        if ($contractModelToUpdate->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce modèle de contrat.');
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);
        
        $contractModelToUpdate->update($validatedData);

        return redirect()->back()->with('success', 'Modèle de contrat mise à jour avec succès !');
    }

    /**
     * Delete one contract models
    */    
    public function delete(Request $request)
    {
        $contractModelToDeleteId = $request->route('id');;
        $contractModelToDelete = ContractModels::findOrFail($contractModelToDeleteId);

        if ($contractModelToDelete->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce modèle de contrat.');
        }
        
        $contractModelToDelete->delete();

        return redirect()->back()->with('success', 'modèle de contrat supprimé avec succès !');
    }
}
