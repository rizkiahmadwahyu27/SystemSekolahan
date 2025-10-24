<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-900">Pilih Level</label>
            <select name="level" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="kepsek">Kepala Sekolah</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-900">Masukan Kode</label>
            <input type="text" name="kode" class="block w-full rounded border-gray-300 shadow-sm" placeholder="masukan NIS/Kode Pegawai" required>
        </div>
        <div class="block mt-4">
            <label for="show_pass" class="inline-flex items-center">
                <input id="show_pass" type="checkbox" class="rounded border-gray-300 ">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show Password') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:font-semibold" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    const pass = document.getElementById('password');
    const showPassCheckbox = document.getElementById('show_pass'); 
    const password_confirmation = document.getElementById('password_confirmation');
    showPassCheckbox.addEventListener('change', (event) => {
        
        if (event.currentTarget.checked) {
            pass.type = 'text';
            password_confirmation.type = 'text';
        } else {
            pass.type = 'password';  
            password_confirmation.type = 'password';
        }
    });
</script>