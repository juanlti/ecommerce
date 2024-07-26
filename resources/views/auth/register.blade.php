<x-guest-layout>
    <x-authentication-card width="sm:max-w-2xl">
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <x-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="grid grid-cols-2 gap-4">
            {{-- nombres  --}}
            <div>
                <x-label for="name" value="{{ __('Name') }}"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus autocomplete="name"/>
            </div>
            {{-- apellidos  --}}
            <div>
                <x-label for="last_name" value="Appelidos"/>
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required
                         autofocus autocomplete="last_name"/>
            </div>
            {{-- tipo de documento  --}}
            <div>
                <x-label for="document_type" value="Tipo de documento"/>
                <x-select class="w-full" id="document_type"  name="document_type">
                    {{--  foreach y enums obtengo una lista pre definida--}}
                    {{---  accedo y llamo, a la clase Enums, y para acceder  a los  elementosm utilizo ::cases() as $unEnums ---}}
                    @foreach(\App\Enums\TypeOfDocuments::cases() as $unEnums)
                        <option value="{{$unEnums->value}}">
                            {{$unEnums->name}}
                        </option>


                        @endforeach


                    {{-- para enlazar las opciones de x-select con la opcion selecionada con el usuario, utilizo  id="document_type"  --}}
                    {{-- lista desplegable --}}
                    {{--
                    <option value="1">DNI</option>
                    <option value="2">CE</option>
                    <option value="3">RUC</option>
                    <option value="4">PP</option>
                    <option value="4">LE</option>
                    <option value="4">ID</option>

                --}}

                </x-select>

            </div>
            {{-- numero de documento  --}}
            <div>
                <x-label for="document_number" value="Documento"/>
                <x-input id="document_number" class="block mt-1 w-full" name="document_number" :value="old('document_number')" required/>
            </div>
            {{-- correo electronico --}}

            <div>
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autocomplete="username"/>
            </div>
            {{-- numero de telefeno --}}
            <div>
                <x-label for="phone" value="Telefono"/>
                <x-input id="phone" class="block mt-1 w-full" name="phone" :value="old('phone')" required/>
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                         autocomplete="new-password"/>
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
            </div>
        </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required/>

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>

            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
