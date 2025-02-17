<x-custom-layout title="Liste des Locataires">
  <section>
      <header>
          <h2 class="text-lg font-medium text-gray-900">
              {{ __('Ajouter un locataire') }}
          </h2>

          <p class="mt-1 text-sm text-gray-600">
              {{ __("Remplissez le formulaire ci-dessous pour ajouter un nouveau locataire.") }}
          </p>
      </header>

      <form method="post" action="{{ route('tenants.create') }}" class="mt-6 space-y-6">
          @csrf

          <div>
              <x-input-label for="name" :value="__('Nom')" />
              <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>

          <div>
              <x-input-label for="email" :value="__('Adresse mail')" />
              <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" required />
              <x-input-error class="mt-2" :messages="$errors->get('email')" />
          </div>

          <div>
              <x-input-label for="phone" :value="__('Numéro de téléphone')" />
              <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" required placeholder="Ex: +01 234 567 89" />
              <x-input-error class="mt-2" :messages="$errors->get('phone')" />
          </div>

          <div>
              <x-input-label for="adress" :value="__('Adresse postale')" />
              <x-text-input id="adress" name="adress" type="text" class="mt-1 block w-full" required placeholder="Adress" />
              <x-input-error class="mt-2" :messages="$errors->get('adress')" />
          </div>

          <div class="flex items-center gap-4">
              <x-primary-button>{{ __('Ajouter le locataire') }}</x-primary-button>

              @if (session('status') === 'box-added')
                  <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                      {{ __('Locataire ajoutée avec succès.') }}
                  </p>
              @endif
          </div>
      </form>
  </section>

  <section class="mt-6">
      <header>
          <h2 class="text-lg font-medium text-gray-900">
              {{ __('Liste des locataires') }}
          </h2>
      </header>
      <div class="mt-4">
          <table class="w-full border-collapse border border-gray-300">
              <thead>
                  <tr class="bg-gray-100">
                      <th class="border border-gray-300 px-4 py-2">ID</th>
                      <th class="border border-gray-300 px-4 py-2">Name</th>
                      <th class="border border-gray-300 px-4 py-2">Adresse mail</th>
                      <th class="border border-gray-300 px-4 py-2">Numéro de téléphone</th>
                      <th class="border border-gray-300 px-4 py-2">Adresse postale</th>
                      <th class="border border-gray-300 px-4 py-2">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($tenants as $tenant)
                      <tr
                          x-data="{ 
                              editing: false, 
                              name: @js($tenant->name),
                              email: @js($tenant->email),
                              phone: @js($tenant->phone),
                              adress: @js($tenant->adress),
                          }"
                          class="border border-gray-300"
                      >
                          <td class="border border-gray-300 px-4 py-2">
                              <a href="{{ route('tenants.getOne', ['id' => $tenant->id]) }}" class="text-blue-600 hover:underline">
                                  {{ $tenant->id }}
                              </a>
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              <span x-show="!editing">{{ $tenant->name }}</span>
                              <input type="text" name="name" x-show="editing" x-model="name" class="w-full p-1 border border-gray-300 rounded">
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              <span x-show="!editing">{{ $tenant->email }}</span>
                              <input type="text" name="email" x-show="editing" x-model="email" class="w-full p-1 border border-gray-300 rounded">
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              <span x-show="!editing">{{ $tenant->phone }}</span>
                              <input type="text" name="phone" x-show="editing" x-model="phone" class="w-full p-1 border border-gray-300 rounded">
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              <span x-show="!editing">{{ $tenant->adress }}</span>
                              <input type="text" name="adress" x-show="editing" x-model="adress" class="w-full p-1 border border-gray-300 rounded">
                          </td>
                          <td class="border border-gray-300 px-4 py-2">
                              <button x-show="!editing" @click="editing = true" class="text-blue-600 hover:underline">Modifier</button>
                              <form x-show="editing" method="POST" action="{{ route('tenants.update', ['id' => $tenant->id]) }}" class="inline">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="name" x-model="name">
                                  <input type="hidden" name="email" x-model="email">
                                  <input type="hidden" name="phone" x-model="phone">
                                  <input type="hidden" name="adress" x-model="adress">
                                  <button type="submit" class="text-green-600 hover:underline">Enregistrer</button>
                                  <button type="button" @click="editing = false" class="text-red-600 hover:underline">Annuler</button>
                              </form>
                              <form method="POST" action="{{ route('tenants.delete', ['id' => $tenant->id]) }}" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
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
