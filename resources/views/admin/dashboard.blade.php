@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <p class="mt-2">Selamat datang, {{ Auth::user()->name }}.</p>

        <div class="mt-6">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Kelola Users</a>
        </div>
    </div>
</div>
@endsection
