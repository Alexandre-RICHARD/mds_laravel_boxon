<x-custom-layout title="Détail d'un box">
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-semibold">Box n°{{ $box->id }}</h3>
        <p><strong>Adresse :</strong> {{ $box->adress }}</p>
        <p><strong>Numéro :</strong> {{ $box->number }}</p>
        <p><strong>Taille :</strong> {{ $box->size }} m²</p>
    </div>
</x-custom-layout>
