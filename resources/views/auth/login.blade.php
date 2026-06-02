<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
            <p class="text-sm text-gray-500">Masuk menggunakan akun Anda untuk melanjutkan.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Username')" class="text-gray-700 font-semibold" />
                <x-text-input id="email" class="mt-2 block w-full rounded-2xl border-gray-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                <x-text-input id="password" class="mt-2 block w-full rounded-2xl border-gray-300 px-4 py-3 shadow-sm focus:border-blue-500 focus:ring-blue-500" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800 font-medium transition" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full inline-flex justify-center rounded-2xl bg-blue-600 px-4 py-3 text-white font-semibold shadow-lg shadow-blue-500/10 transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Masuk') }}
            </button>
        </form>
    </div>
</x-guest-layout>
