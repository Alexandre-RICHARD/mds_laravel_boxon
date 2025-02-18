<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Bills;
use App\Models\User;
use App\Models\Contracts;
use App\Models\Tenants;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BillsController extends Controller
{
    /**
     * Display all the boxes the user's can see.
     */
    public function getAll(Request $request): View
    {
        $currentMonth = $request->input('month', now()->format('Y-m'));
        $currentDate = Carbon::createFromFormat('Y-m', $currentMonth);
        $previousMonth = $currentDate->copy()->subMonth(1)->format('Y-m');
        $nextMonth = $currentDate->copy()->addMonth(1)->format('Y-m');

        $bills = Bills::whereYear('bills_period', $currentDate->year)
                      ->whereMonth('bills_period', $currentDate->month)
                      ->orderBy('paiement_date', 'asc')
                      ->get();

        return view('bills.get-all', [
            'bills' => $bills,
            'currentMonth' => $currentMonth,
            'previousMonth' => $previousMonth,
            'nextMonth' => $nextMonth,
        ]);
    }

    /**
     * Made bill payed
    */    
    public function payBill($id)
    {
        
        $billToPay = Bills::findOrFail($id);
        $contract = Contracts::findOrFail($billToPay->contract_id);
        $user = User::findOrFail($contract->user_id);
        
        if ($user->id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette facture.');
        }


        $billToPay->paiement_date = now();
        $billToPay->save();
    
        return redirect()->back()->with('success', 'Facture marquée comme payée.');
    }


    /**
     * Download one bill into pdf
    */  
    public function downloadBillInPdf($id)
    {
        $billToDownload = Bills::findOrFail($id);
        $contractRelated = Contracts::findOrFail($billToDownload->contract_id);
        $owner = User::findOrFail($contractRelated->user_id);
        $tenant = Tenants::findOrFail($contractRelated->tenant_id);

        $contractFilled = "Facture du contrat N°{$contractRelated->id} \n
        Bailleur : {$owner->name} \n
        Locataire : {$tenant->name} \n
        Période : {$billToDownload->bills_period} \n
        Montant : {$billToDownload->amount} € \n
        Payée le : " . ($billToDownload->paiement_date ? $billToDownload->paiement_date : "Non payé");
    
        $pdf = Pdf::loadHTML(nl2br(e($contractFilled)));
        return response($pdf->stream("facture_{$billToDownload->id}.pdf"), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="facture_'.$billToDownload->id.'.pdf"',
        ]);
    }
}
