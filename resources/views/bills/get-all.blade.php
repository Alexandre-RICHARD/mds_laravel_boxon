<x-custom-layout title="Mes factures">
    <div class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Factures du mois</h2>
        <form method="GET" action="{{ route('bills.getAll') }}" class="mb-4 flex items-center gap-4">
            <a href="{{ route('bills.getAll', ['month' => $previousMonth]) }}" class="text-gray-700 text-xl px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300">
                &larr;
            </a>
            <label for="month" class="font-semibold">Choisir un mois :</label>
            <input type="month" id="month" name="month" value="{{ $currentMonth }}" class="border border-gray-300 rounded p-2">
            <a href="{{ route('bills.getAll', ['month' => $nextMonth]) }}" class="text-gray-700 text-xl px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300">
                &rarr;
            </a>
            <x-primary-button>{{ __('Filtrer') }}</x-primary-button>
        </form>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Montant</th>
                    <th class="border px-4 py-2">Date de paiement</th>
                    <th class="border px-4 py-2">Période</th>
                    <th class="border px-4 py-2">Numéro de période</th>
                    <th class="border px-4 py-2">Contrat ID</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bills as $bill)
                    <tr class="border">
                        <td class="border px-4 py-2">{{ $bill->id }}</td>
                        <td class="border px-4 py-2">{{ number_format($bill->amount, 2, ',', ' ') }} €</td>
                        <td class="border px-4 py-2">
                            @if ($bill->paiement_date)
                                {{ \Carbon\Carbon::parse($bill->paiement_date)->format('d F Y') }}
                            @else
                                <span class="text-red-600 font-bold">Impayé</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($bill->bills_period)->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">{{ $bill->period_number }}</td>
                        <td class="border px-4 py-2">{{ $bill->contract_id }}</td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            @if (!$bill->paiement_date)
                                <form method="POST" action="{{ route('bills.pay', $bill->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-600 hover:underline">Marquer comme payé</button>
                                </form>
                            @endif
                            <a href="{{ route('bills.download', $bill->id) }}" target="_blank" class="text-gray-600 hover:underline">Télécharger</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center">Aucune facture pour ce mois.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-custom-layout>
