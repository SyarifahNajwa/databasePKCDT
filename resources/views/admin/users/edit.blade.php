@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Edit User</h2>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email / Username')" />
                <x-text-input id="email" name="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password (kosongkan jika tidak diubah)')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
            </div>

            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded">
                    <option value="staff" {{ old('role', $user->role)=='staff' ? 'selected' : '' }}>staff</option>
                    <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>admin</option>
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
