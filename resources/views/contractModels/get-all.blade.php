<x-custom-layout title="Liste des Modèles de contrats">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Ajouter un lodèle de contrat') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Remplissez le formulaire ci-dessous pour ajouter un nouveau modèle de contrat.") }}
            </p>
        </header>
    
        <form method="post" action="{{ route('contractModels.create') }}" class="mt-6 space-y-6">
            @csrf
    
            <div>
                <x-input-label for="name" :value="__('Nom du modèle')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div>
                <x-input-label for="content" :value="__('Contenu du modèle')" />
                <textarea  id="content" name="content" type="text" class="mt-1 block w-full" required></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('content')" />
            </div>
    
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Ajouter le modèle') }}</x-primary-button>
    
                @if (session('status') === 'box-added')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                        {{ __('Modèle ajoutée avec succès.') }}
                    </p>
                @endif
            </div>
        </form>
    </section>

    <section class="mt-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Liste des modèles de contrat') }}
            </h2>
        </header>

        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nom du modèle</th>
                        <th class="border border-gray-300 px-4 py-2">Contenu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contractModels as $contractModel)
                        <tr
                            x-data="{ 
                                editing: false, 
                                name: @js($contractModel->name), 
                                content: @js($contractModel->content), 
                            }"
                            class="border border-gray-300"
                        >
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('contractModels.getOne', ['id' => $contractModel->id]) }}" class="text-blue-600 hover:underline">
                                    {{ $contractModel->id }}
                                </a>
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $contractModel->name }}</span>
                                <input type="text" name="name" x-show="editing" x-model="name" class="w-full p-1 border border-gray-300 rounded">
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $contractModel->content }}</span>
                                <textarea type="text" name="content" x-show="editing" x-model="content" class="w-full p-1 border border-gray-300 rounded"></textarea>
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <button x-show="!editing" @click="editing = true" class="text-blue-600 hover:underline">Modifier</button>

                                <form x-show="editing" method="POST" action="{{ route('contractModels.update', ['id' => $contractModel->id]) }}" class="inline">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="name" x-model="name">
                                    <input type="hidden" name="content" x-model="content">

                                    <button type="submit" class="text-green-600 hover:underline">Enregistrer</button>
                                    <button type="button" @click="editing = false" class="text-red-600 hover:underline">Annuler</button>
                                </form>
                                <form method="POST" action="{{ route('contractModels.delete', ['id' => $contractModel->id]) }}" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-custom-layout>
