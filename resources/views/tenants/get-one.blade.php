<x-custom-layout title="Détail d'un locataire">
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-semibold">Locataire n°{{ $tenant->id }}</h3>
        <p><strong>Nom :</strong> {{ $tenant->name }}</p>
        <p><strong>Adresse mail :</strong> {{ $tenant->email }}</p>
        <p><strong>Numéro de téléphone :</strong> {{ $tenant->phone }}</p>
        <p><strong>Adresse postale :</strong> {{ $tenant->adress }}</p>
    </div>
</x-custom-layout>
