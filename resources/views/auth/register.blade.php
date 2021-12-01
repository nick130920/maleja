<x-guest-layout>
    <x-auth-card>
        <div class="flex justify-center py-3">
            {{-- <img src="{{ asset('img/fondolegal.jpg') }}" class="h-16 sm:h-24" /> --}}
            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>
        </div>
        <style>
            .f-outline input:focus-within~label,
            .f-outline input:not(:placeholder-shown)~label {
                transform: translateY(-2rem) translatex(-1rem) scaleX(0.90) scaleY(0.90);
            }

        </style>

        <div class="divide-y divide-gray-200">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="overflow-hidden space-y-6 text-base leading-6 text-gray-700 sm:text-lg sm:leading-7">
                    {{-- <div class="f-outline relative border rounded-lg focus-within:border-indigo-500">
                        <input type="email" name="email" placeholder=" "
                            class="block p-2 w-full text-lg appearance-none focus:outline-none bg-transparent rounded-lg" />
                        <label for="email"
                            class="absolute ml-5 top-0 text-lg text-gray-700 mt-2 -z-1 duration-300 origin-0">Email</label>
                    </div> --}}
                    <!-- Name -->
                    <div class="f-outline relative border rounded-lg focus-within:border-indigo-500 mt-4">
                        <x-input-nick id="name" type="text" name="name" :value="old('name') " />
                        <x-label-nick for="name" :value="__('Nombre')" />
                    </div>
                    <!-- Email Address -->
                    <div class="f-outline relative border rounded-lg focus-within:border-indigo-500">
                        <x-input-nick id="email" type="email" name="email" :value="old('email')" />
                        <x-label-nick for="email" :value="__('Email')" />
                    </div>
                    <!-- Phone -->
                    <div class="f-outline relative border rounded-lg focus-within:border-indigo-500">
                        <x-input-nick id="phone" type="tel" name="phone" :value="old('phone')" />
                        <x-label-nick for="phone" :value="__('Celular')" />
                    </div>
                    <!-- Password -->
                    <div class="f-outline relative border rounded-lg focus-within:border-indigo-500">
                        <x-input-nick id="password" type="password" name="password" autocomplete="new-password" />
                        <x-label-nick for="password" :value="__('Contraseña')" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="f-outline relative border rounded-lg focus-within:border-indigo-500">
                        <x-input-nick id="password_confirmation" type="password" name="password_confirmation" />
                        <x-label-nick for="password_confirmation" :value="__('Confirmar Contraseña')" />
                    </div>
                    <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('login') }}">
                                {{ __('Ya registrado?') }}
                            </a>
                            <x-button class="ml-4">
                                {{ __('Registrar') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </x-auth-card>
</x-guest-layout>
