@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Tambah User</h2>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" class="mt-1 block w-full" value="{{ old('name') }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email / Username')" />
                <x-text-input id="email" name="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
            </div>

            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="staff" {{ old('role')=='staff' ? 'selected' : '' }}>staff</option>
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
