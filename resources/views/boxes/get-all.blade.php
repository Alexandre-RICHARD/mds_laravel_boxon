<x-custom-layout title="Liste des Boxes">
  <div class="container">
    <h1>Liste des Boxes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Adresse</th>
                <th>Numéro</th>
                <th>Taille</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($boxes as $box)
                <tr>
                    <td class="px-3 py-1"><a class="text-cyan-600 underline-offset-1" href="{{ route('boxes.getOne', ['id' => $box->id]) }}">{{ $box->id }}</a></td>
                    <td class="px-3 py-1">{{ $box->adress }}</td>
                    <td class="px-3 py-1">{{ $box->number }}</td>
                    <td class="px-3 py-1">{{ $box->size }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</x-custom-layout>
