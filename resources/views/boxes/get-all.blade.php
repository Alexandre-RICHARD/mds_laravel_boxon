<x-custom-layout title="Liste des Boxes">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Ajouter une Box') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Remplissez le formulaire ci-dessous pour ajouter une nouvelle box.") }}
            </p>
        </header>
    
        <form method="post" action="{{ route('boxes.create') }}" class="mt-6 space-y-6">
            @csrf
    
            <div>
                <x-input-label for="adress" :value="__('Adresse')" />
                <x-text-input id="adress" name="adress" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('adress')" />
            </div>
    
            <div>
                <x-input-label for="number" :value="__('Numéro')" />
                <x-text-input id="number" name="number" type="text" pattern="\d{3}" maxlength="3" class="mt-1 block w-full" required placeholder="Ex: 123" />
                <x-input-error class="mt-2" :messages="$errors->get('number')" />
            </div>
    
            <div>
                <x-input-label for="size" :value="__('Taille')" />
                <x-text-input id="size" name="size" type="number" min="0" max="99999" step="0.01" class="mt-1 block w-full" required placeholder="Ex: 12.34" />
                <x-input-error class="mt-2" :messages="$errors->get('size')" />
            </div>
    
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Ajouter la Box') }}</x-primary-button>
    
                @if (session('status') === 'box-added')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                        {{ __('Box ajoutée avec succès.') }}
                    </p>
                @endif
            </div>
        </form>
    </section>

    <section class="mt-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Liste des Boxes') }}
            </h2>
        </header>

        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Adresse</th>
                        <th class="border border-gray-300 px-4 py-2">Numéro</th>
                        <th class="border border-gray-300 px-4 py-2">Taille</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boxes as $box)
                        <tr
                            x-data="{ 
                                editing: false, 
                                adress: @js($box->adress), 
                                number: @js($box->number), 
                                size: @js($box->size) 
                            }"
                            class="border border-gray-300"
                        >
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('boxes.getOne', ['id' => $box->id]) }}" class="text-blue-600 hover:underline">
                                    {{ $box->id }}
                                </a>
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $box->adress }}</span>
                                <input type="text" name="adress" x-show="editing" x-model="adress" class="w-full p-1 border border-gray-300 rounded">
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $box->number }}</span>
                                <input type="text" name="number" x-show="editing" x-model="number" class="w-full p-1 border border-gray-300 rounded">
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $box->size }}</span>
                                <input type="number" name="size" x-show="editing" x-model="size" class="w-full p-1 border border-gray-300 rounded">
                            </td>

                            <td class="border border-gray-300 px-4 py-2">
                                <button x-show="!editing" @click="editing = true" class="text-blue-600 hover:underline">Modifier</button>

                                <form x-show="editing" method="POST" action="{{ route('boxes.update', ['id' => $box->id]) }}" class="inline">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="adress" x-model="adress">
                                    <input type="hidden" name="number" x-model="number">
                                    <input type="hidden" name="size" x-model="size">

                                    <button type="submit" class="text-green-600 hover:underline">Enregistrer</button>
                                    <button type="button" @click="editing = false" class="text-red-600 hover:underline">Annuler</button>
                                </form>
                                <form method="POST" action="{{ route('boxes.delete', ['id' => $box->id]) }}" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
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
