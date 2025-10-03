<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="show_pass" class="inline-flex items-center">
                <input id="show_pass" type="checkbox" class="rounded border-gray-300 ">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show Password') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-2 text-xs text-gray-600 hover:text-gray-900 hover:font-semibold">Jika kamu belum punya akun, Register sekarang</a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    
</x-guest-layout>
<script>
    const pass = document.getElementById('password');
    const showPassCheckbox = document.getElementById('show_pass'); // Nama variabel diperjelas

    showPassCheckbox.addEventListener('change', (event) => {
        // Event 'change' akan terpicu saat checkbox dicentang atau tidak dicentang.
        if (event.currentTarget.checked) {
            pass.type = 'text';      // Tampilkan password
        } else {
            pass.type = 'password';  // Sembunyikan password
        }
    });
</script>
