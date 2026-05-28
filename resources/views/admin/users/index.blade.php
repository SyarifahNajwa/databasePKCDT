@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Daftar Users</h2>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah User</a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                    <th class="px-6 py-2 text-left text-sm font-medium text-gray-500">Email</th>
                    <th class="px-6 py-2 text-left text-sm font-medium text-gray-500">Role</th>
                    <th class="px-6 py-2 text-right text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-3">{{ $user->name }}</td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">{{ $user->role }}</td>
                    <td class="px-6 py-3 text-right">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</div>
@endsection
