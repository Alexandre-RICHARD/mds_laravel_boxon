<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Tenants;

class TenantsController extends Controller
{
    /**
     * Display all the tenant the user's can see.
     */
    public function getAll(Request $request): View
    {
        $tenants = Tenants::where("user_id", Auth::id())->get();

        return view('tenants.get-all', [
            'tenants' => $tenants,
            'user' => $request->user(),
        ]);
    }

    /**
     * Display one user tenant data that user can see.
     */
    public function getOne(Request $request): View
    {
        $id = $request->route('id');
        $tenant = Tenants::where([
            ['id', '=', $id],
            ['user_id', '=', Auth::id()],
        ])->firstOrFail();

        return view('tenants.get-one', [
            'tenant' => $tenant,
            'user' => $request->user(),
        ]);
    }

    /**
     * Create one tenant dataset related to one new tenant
    */    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|min:3|max:20',
            'adress' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        $validatedData['user_id'] = $userId;

    
        Tenants::create($validatedData);
    
        return redirect()->back()->with('success', 'Info de locataire ajoutée avec succès !');
    }

    /**
     * Update one tenant dataset
    */    
    public function update(Request $request)
    {
        $tenantToUpdateId = $request->route('id');;
        $tenantToUpdate = Tenants::findOrFail($tenantToUpdateId);

        if ($tenantToUpdate->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ces informations.');
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|min:3|max:20',
            'adress' => 'required|string|max:255',
        ]);
        
        $tenantToUpdate->update($validatedData);

        return redirect()->back()->with('success', 'Info de locataire mise à jour avec succès !');
    }

    /**
     * Delete one tenant dataset
    */    
    public function delete(Request $request)
    {
        $tenantToDeleteId = $request->route('id');;
        $tenantToDelete = Tenants::findOrFail($tenantToDeleteId);

        if ($tenantToDelete->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ces informations.');
        }
        
        $tenantToDelete->delete();

        return redirect()->back()->with('success', 'Informations supprimé avec succès !');
    }
}
