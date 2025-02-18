<x-custom-layout title="Liste des contrats">
  <section>
      <header>
          <h2 class="text-lg font-medium text-gray-900">
              {{ __('Ajouter un contrat') }}
          </h2>

          <p class="mt-1 text-sm text-gray-600">
              {{ __("Remplissez le formulaire ci-dessous pour ajouter un nouveau contrat.") }}
          </p>
      </header>

        <form method="post" action="{{ route('contracts.create') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="date_start" :value="__('Date de début')" />
                <x-text-input id="date_start" name="date_start" type="date" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('date_start')" />
            </div>
            <div>
                <x-input-label for="date_end" :value="__('Date de fin')" />
                <x-text-input id="date_end" name="date_end" type="date" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
            </div>
            <div>
                <x-input-label for="monthly_price" :value="__('Prix mensuel (€)')" />
                <x-text-input id="monthly_price" name="monthly_price" type="number" step="0.01" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('monthly_price')" />
            </div>
            <div>
                <x-input-label for="box_id" :value="__('Box')" />
                <select id="box_id" name="box_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                    <option value="" disabled selected hidden>Choisissez un box</option>
                    @foreach ($boxes as $box)
                        <option value="{{ $box->id }}">{{ $box->adress }} - {{ $box->size }}m²</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('box_id')" />
            </div>
            <div>
                <x-input-label for="tenant_id" :value="__('Locataire')" />
                <select id="tenant_id" name="tenant_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                    <option value="" disabled selected hidden>Choisissez un locataire</option>
                    @foreach ($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->name }} - {{ $tenant->email }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('tenant_id')" />
            </div>
            <div>
                <x-input-label for="contract_model_id" :value="__('Modèle de contrat')" />
                <select id="contract_model_id" name="contract_model_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                    <option value="" disabled selected hidden>Choisissez un modèle de contrat</option>
                    @foreach ($contractModels as $contractModel)
                        <option value="{{ $contractModel->id }}">{{ $contractModel->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('contract_model_id')" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Créer le contrat') }}</x-primary-button>

                @if (session('status') === 'contract-added')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                        {{ __('Contrat ajouté avec succès.') }}
                    </p>
                @endif
            </div>
        </form>
  </section>

    <section class="mt-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Liste des contrats') }}
            </h2>
        </header>

        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Date de début</th>
                        <th class="border border-gray-300 px-4 py-2">Date de fin</th>
                        <th class="border border-gray-300 px-4 py-2">Prix mensuel (€)</th>
                        <th class="border border-gray-300 px-4 py-2">Box</th>
                        <th class="border border-gray-300 px-4 py-2">Locataire</th>
                        <th class="border border-gray-300 px-4 py-2">Modèle de contrat</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                        <tr
                            x-data="{ 
                                editing: false, 
                                date_start: @js($contract->date_start),
                                date_end: @js($contract->date_end),
                                monthly_price: @js($contract->monthly_price),
                                box_id: @js($contract->box_id),
                                tenant_id: @js($contract->tenant_id),
                                contract_model_id: @js($contract->contract_model_id),

                            }"
                            class="border border-gray-300"
                        >
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('contracts.getOne', ['id' => $contract->id]) }}" class="text-blue-600 hover:underline">
                                    {{ $contract->id }}
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $contract->date_start }}</span>
                                <input type="date" name="date_start" x-show="editing" x-model="date_start" class="w-full p-1 border border-gray-300 rounded">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $contract->date_end }}</span>
                                <input type="date" name="date_end" x-show="editing" x-model="date_end" class="w-full p-1 border border-gray-300 rounded">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span x-show="!editing">{{ $contract->monthly_price }} €</span>
                                <input type="number" step="0.01" name="monthly_price" x-show="editing" x-model="monthly_price" class="w-full p-1 border border-gray-300 rounded">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a x-show="!editing" href="{{ route('boxes.getOne', ['id' => $contract->box_id]) }}" class="text-blue-600 hover:underline">
                                    Box {{ $contract->box_id }}
                                </a>
                                <select x-show="editing" x-model="box_id" id="box_id" name="box_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                                    @foreach ($boxes as $box)
                                        <option value="{{ $box->id }}">{{ $box->adress }} - {{ $box->size }}m²</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a x-show="!editing" href="{{ route('tenants.getOne', ['id' => $contract->tenant_id]) }}" class="text-blue-600 hover:underline">
                                    {{ $tenants->firstWhere('id', $contract->tenant_id)?->name ?? 'Non attribué' }}
                                </a>
                                <select x-show="editing" x-model="tenant_id" id="tenant_id" name="tenant_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                                    @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }} - {{ $tenant->email }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a x-show="!editing" href="{{ route('contractModels.getOne', ['id' => $contract->contract_model_id]) }}" class="text-blue-600 hover:underline">
                                    {{ $contractModels->firstWhere('id', $contract->contract_model_id)->name }}
                                </a>
                                <select x-show="editing" x-model="contract_model_id" id="contract_model_id" name="contract_model_id" class="mt-1 block w-full border-gray-300 rounded-lg" required>
                                    @foreach ($contractModels as $contractModel)
                                        <option value="{{ $contractModel->id }}">{{ $contractModel->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <button x-show="!editing" @click="editing = true" class="text-blue-600 hover:underline">Modifier</button>
                                <form x-show="editing" method="POST" action="{{ route('contracts.update', ['id' => $contract->id]) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="date_start" x-model="date_start">
                                    <input type="hidden" name="date_end" x-model="date_end">
                                    <input type="hidden" name="monthly_price" x-model="monthly_price">
                                    <input type="hidden" name="box_id" x-model="box_id">
                                    <input type="hidden" name="tenant_id" x-model="tenant_id">
                                    <input type="hidden" name="contract_model_id" x-model="contract_model_id">
                                    <button type="submit" class="text-green-600 hover:underline">Enregistrer</button>
                                    <button type="button" @click="editing = false" class="text-red-600 hover:underline">Annuler</button>
                                </form>
                                <form x-show="!editing" method="POST" action="{{ route('contracts.delete', ['id' => $contract->id]) }}" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                                <a x-show="!editing" href="{{ route('contracts.download', $contract->id) }}" target="_blank" class="btn btn-primary text-gray-700">
                                    Télécharger
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-custom-layout>
