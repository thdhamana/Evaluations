<div class="row">
    <div class="col-5 m-auto">
        <x-guest-layout>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="Addresse Email" :value="__('Addresse Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="Mot de passe" :value="__('Mot de passe')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="d-flex flex-row justify-content-between align-items-center mt-2 mb-5">
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi !') }}</span>
                        </label>
                    </div>
                    
                    <x-primary-button class="ms-3 mt-4" style="background: #36329f">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </div>

                <div class="d-flex flex-column align-items-center justify-center mt-4">
                    <div class="my-2">
                        <a href="{{route('register')}}">Vous n'avez pas de compte ? Créez-en un </a>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </div>
            </form>
        </x-guest-layout>
    </div>
</div>
