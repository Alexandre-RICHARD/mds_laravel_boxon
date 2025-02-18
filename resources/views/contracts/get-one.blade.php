<x-custom-layout title="Détail d'un locataire">
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-semibold">Contrat n°{{ $contract->id }}</h3>
        <p><strong>Début :</strong> {{ $contract->date_start }}</p>
        <p><strong>Fin :</strong> {{ $contract->date_end }}</p>
        <p><strong>Loyer mensuel :</strong> {{ $contract->monthly_price }}</p>
        <p><strong>N° du box :</strong> {{ $contract->box_id }}</p>
        <p><strong>N° du locataire :</strong> {{ $contract->tenant_id }}</p>
    </div>
</x-custom-layout>
