<x-custom-layout title="Modèle de contrat">
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-semibold">Modèle de contrat n°{{ $contractModel->id }}</h3>
        <p><strong>Nom :</strong> {{ $contractModel->name }}</p>
        <p><strong>Contenu :</strong> {{ $contractModel->content }}</p>
    </div>
</x-custom-layout>
