<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <i class="bi bi-shield-lock-fill text-3xl text-blue-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 text-uppercase">Connexion Admin</h2>
        <p class="text-sm text-gray-500">Quincaillerie Keït - Accès sécurisé</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" class="font-semibold" :value="__('Email')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-envelope"></i>
                </div>
                <x-text-input id="email" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" class="font-semibold" :value="__('Mot de passe')" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 hover:text-blue-800 underline transition" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-lock"></i>
                </div>
                <x-text-input id="password" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 transition ease-in-out duration-150 shadow-md">
                <i class="bi bi-box-arrow-in-right me-2 text-lg"></i> {{ __('Se connecter') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-4 border-t pt-4">
            <p class="text-sm text-gray-600">
                Pas encore de compte ?
                <a class="font-bold text-blue-600 hover:text-blue-800 underline transition" href="{{ route('register') }}">
                    S'enregistrer
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
