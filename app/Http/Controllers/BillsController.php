<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Bills;

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
}
