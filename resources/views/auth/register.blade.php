<div class="row">
    <div class="col-6 m-auto">
        <x-guest-layout>
            <form method="POST" action="{{ route('register') }}">
                @csrf
        
                <div class="row">
                    <!-- Prenom -->
                    <div class="col-md-6 col-sm-12">
                        <x-input-label for="name" :value="__('Prénom')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Nom -->
                    <div class="col-md-6 col-sm-12">
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>
                </div>
                <div class="row">
                    <!-- Email Address -->
                    <div class="col-md-6 col-sm-12 mt-4">
                        <x-input-label for="email" :value="__('Addresse email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Telephone -->
                    <div class="col-md-6 col-sm-12 mt-4">
                        <x-input-label for="telephone" :value="__('Téléphone')" />
                        <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="telephone" />
                        <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                    </div>
                </div>
        
                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6 col-sm-12 mt-4">
                        <x-input-label for="password" :value="__('Mot de passe')" />
            
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="col-md-6 col-sm-12 mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmez votre mot de passe')" />
            
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
        
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4" style="background: #36329f">
                        {{ __("S'enregistrer ") }}
                    </x-primary-button>
                </div>
                <div class="d-flex justify-center mt-3">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Vous avez déjà un compte ? Connectez-vous') }}
                    </a>
                </div>
            </form>
        </x-guest-layout>
    </div>
</div>
