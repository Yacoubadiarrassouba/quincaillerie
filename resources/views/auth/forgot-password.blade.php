<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
            <i class="bi bi-key-fill text-3xl text-yellow-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Mot de passe oublié ?</h2>
        <p class="text-sm text-gray-500 mt-2">
            Pas de souci. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.
        </p>
    </div>

    <x-auth-session-status class="mb-4 p-3 bg-green-50 border-s-4 border-green-500 text-green-700 rounded shadow-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" class="font-semibold" :value="__('Votre adresse Email')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="bi bi-envelope-at"></i>
                </div>
                <x-text-input id="email" class="block pl-10 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autofocus placeholder="admin@keit.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-3 bg-gray-800 hover:bg-black transition ease-in-out duration-150 shadow-md">
                <i class="bi bi-send me-2"></i> Envoyer le lien de récupération
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition" href="{{ route('login') }}">
                <i class="bi bi-arrow-left"></i> Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
