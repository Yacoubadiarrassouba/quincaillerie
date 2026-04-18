<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="bi bi-person-plus-fill text-3xl text-blue-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Créer un compte Admin</h2>
        <p class="text-sm text-gray-500">Gérez votre catalogue Quincaillerie Keït</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" class="font-semibold" :value="__('Nom complet')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-person"></i>
                </div>
                <x-text-input id="name" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Yacouba Keït" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" class="font-semibold" :value="__('Email professionnel')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-envelope"></i>
                </div>
                <x-text-input id="email" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="admin@keit.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" class="font-semibold" :value="__('Mot de passe')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-lock"></i>
                </div>
                <x-text-input id="password" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" class="font-semibold" :value="__('Confirmer le mot de passe')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-shield-check"></i>
                </div>
                <x-text-input id="password_confirmation" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 transition ease-in-out duration-150 shadow-md">
                <i class="bi bi-check-circle me-2"></i> {{ __('Créer mon compte') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-4 border-t pt-4">
            <p class="text-sm text-gray-600">
                Déjà un compte ?
                <a class="font-bold text-blue-600 hover:text-blue-800 underline transition" href="{{ route('login') }}">
                    Connectez-vous
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
