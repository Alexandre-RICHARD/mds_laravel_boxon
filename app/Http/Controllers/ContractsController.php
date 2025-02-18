<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Contracts;
use App\Models\Boxes;
use App\Models\Tenants;

class ContractsController extends Controller
{
    /**
     * Display all the contracts the user's can see.
     */
    public function getAll(Request $request): View
    {
        $contracts = Contracts::where("user_id", Auth::id())->get();

        return view('contracts.get-all', [
            'contracts' => $contracts,
            'user' => $request->user(),
            'boxes' => Boxes::all(),
            'tenants' => Tenants::all(),
        ]);
    }

    /**
     * Display one contracts that user can see.
     */
    public function getOne(Request $request): View
    {
        $id = $request->route('id');
        $contract = Contracts::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
        ])->firstOrFail();

        return view('contracts.get-one', [
            'contract' => $contract,
            'user' => $request->user(),
        ]);
    }

    /**
     * Create one contracts
    */    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'monthly_price' => 'required|numeric',
            'box_id' => 'required|integer',
            'tenant_id' => 'required|integer',
        ]);
        $userId = Auth::id();
        $validatedData['user_id'] = $userId;

    
        Contracts::create($validatedData);
    
        return redirect()->back()->with('success', 'Contrat ajoutée avec succès !');
    }

    /**
     * Update one contracts
    */    
    public function update(Request $request)
    {
        $contractToUpdateId = $request->route('id');;
        $contractToUpdate = Contracts::findOrFail($contractToUpdateId);

        if ($contractToUpdate->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce contrat.');
        }
        
        $validatedData = $request->validate([ 
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'monthly_price' => 'required|numeric',
            'box_id' => 'required|integer',
            'tenant_id' => 'required|integer',
        ]);
        
        $contractToUpdate->update($validatedData);

        return redirect()->back()->with('success', 'Contrat mise à jour avec succès !');
    }

    /**
     * Delete one contracts
    */    
    public function delete(Request $request)
    {
        $contractToDeleteId = $request->route('id');;
        $contractToDelete = Contracts::findOrFail($contractToDeleteId);

        if ($contractToDelete->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce contrat.');
        }
        
        $contractToDelete->delete();

        return redirect()->back()->with('success', 'Contrat supprimé avec succès !');
    }
}
