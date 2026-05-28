@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold">Staff Dashboard</h1>
        <p class="mt-2">Selamat datang, {{ Auth::user()->name }}.</p>
    </div>
</div>
@endsection
