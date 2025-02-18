<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Contracts;
use App\Models\Boxes;
use App\Models\Tenants;
use App\Models\ContractModels;
use App\Models\User;

class ContractsController extends Controller
{
    /**
     * Display all the contracts the user's can see.
     */
    public function getAll(Request $request): View
    {
        $contracts = Contracts::where("user_id", Auth::id())->get();

        $allBoxes = Boxes::where("user_id", Auth::id())->get();
        $allTenants = Tenants::where("user_id", Auth::id())->get();
        $allContractModels = ContractModels::where("user_id", Auth::id())->get();

        return view('contracts.get-all', [
            'contracts' => $contracts,
            'user' => $request->user(),
            'boxes' => $allBoxes,
            'tenants' => $allTenants,
            'contractModels' => $allContractModels,
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
            'contract_model_id' => 'required|integer',
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
            'contract_model_id' => 'required|integer',
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

    /**
     * Download one contracts
    */  
    public function downloadContract($id)
    {
        $contract = Contracts::findOrFail($id);
        $contractModel = ContractModels::findOrFail($contract->contract_model_id);
        $tenant = Tenants::findOrFail($contract->tenant_id);
        $box = Boxes::findOrFail($contract->box_id);
        $owner = User::findOrFail($contract->user_id);

        $data = [
            'contract_creation_date' => $contract->created_at,
            'tenant_name' => $tenant->name,
            'started_date' => $contract->date_start,
            'end_date' => $contract->date_end,
            'box_adress' => $box->adress,
            'owner_name' => $owner->name,
            'monthly_price' => $contract->monthly_price,
        ];

        $contractFilled = preg_replace_callback('/{{ (.*?) }}/', function ($matches) use ($data) {
            return $data[$matches[1]] ?? 'N/A';
        }, $contractModel->content);

        $pdf = Pdf::loadHTML(nl2br(e($contractFilled)));
        return response($pdf->stream("contrat.pdf"), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="facture.pdf"',
        ]);
    }
}
