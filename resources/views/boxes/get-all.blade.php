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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boxes as $box)
                        <tr class="border border-gray-300">
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('boxes.getOne', ['id' => $box->id]) }}" class="text-blue-600 hover:underline">
                                    {{ $box->id }}
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $box->adress }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $box->number }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $box->size }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-custom-layout>
