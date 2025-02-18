<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bills;
use App\Models\Contracts;

use Carbon\Carbon;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contracts = Contracts::all();
        
        foreach ($contracts as $contract) {
            $startDate = Carbon::parse($contract->date_start);
            $endDate = Carbon::now();
            $isLate = false;
            $periodNumber = 1;
            
            while ($startDate->lessThanOrEqualTo($endDate)) {
                $monthProximity = abs($endDate->diffInMonths($startDate));
                $amount = $contract->monthly_price;

                if ($startDate->day > 1) {
                    $daysInMonth = $startDate->daysInMonth;
                    $amount = round($amount * ($daysInMonth - $startDate->day + 1) / $daysInMonth, 2);
                }

                if ($monthProximity <= 4 && !$isLate) {
                    $probability = 10 + ($periodNumber - 1) * 5;
                    if (rand(0, 100) <= $probability) {
                        $isLate = true;
                    }
                }

                $paymentDate = $isLate ? null : $startDate->copy()->addDays(rand(0, $startDate->daysInMonth));
                if ($paymentDate && $paymentDate->greaterThanOrEqualTo(Carbon::now())) {
                    $paymentDate = Carbon::now();
                }

                $createData = [
                    'amount' => $amount,
                    'paiement_date' => $paymentDate,
                    'bills_period' => $startDate->format('Y-m-d'),
                    'period_number' => $periodNumber,
                    'contract_id' => $contract->id,
                ];

                Bills::create($createData);

                $startDate->addMonth(1);
                $startDate->setDay(1);
                $periodNumber++;
            }
        }

        Bills::factory(0)->create();
    }
}
