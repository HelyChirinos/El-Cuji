<x-guest-layout>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Casa') }}" />
                    <select class="select2-multiple form-control" name="casas[]" multiple="multiple"
                        id="casas">
                      @foreach ($casas as $id => $casa)
                        <option value="{{$id}}" >{{$casa}}</option>
                      @endforeach
                    </select>                        
                </div>                

                <div class="mb-3">
                    <x-jet-label value="{{ __('Nombres') }}" />

                    <x-jet-input class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                                 :value="old('nombre')" required autofocus autocomplete="nombre" />
                    <x-jet-input-error for="nombre"></x-jet-input-error>
                </div>


                <div class="mb-3">
                    <x-jet-label value="{{ __('Apellidos') }}" />

                    <x-jet-input class="{{ $errors->has('apellido') ? 'is-invalid' : '' }}" type="text" name="apellido"
                                 :value="old('apellido')" required autofocus autocomplete="apellido" />
                    <x-jet-input-error for="apellido"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Ceula') }}" />

                    <x-jet-input class="{{ $errors->has('cedula') ? 'is-invalid' : '' }}" type="text" name="cedula"
                                 :value="old('cedula')" required autofocus autocomplete="cedula" />
                    <x-jet-input-error for="cedula"></x-jet-input-error>
                </div>


                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>

  <script>
    
    $('.select2-multiple').select2({
  placeholder: 'Select an option'
    });
  </script>  
</x-guest-layout>