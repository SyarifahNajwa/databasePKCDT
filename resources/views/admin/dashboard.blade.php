<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-600 uppercase tracking-wide">Total Surat</p>
                    <p class="mt-3 text-3xl font-semibold text-blue-800">{{ $totalPenomorans }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-600 uppercase tracking-wide">Total User</p>
                    <p class="mt-3 text-3xl font-semibold text-green-800">{{ $totalUsers }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-600 uppercase tracking-wide">Total Staff</p>
                    <p class="mt-3 text-3xl font-semibold text-purple-800">{{ $totalStaff }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-600 uppercase tracking-wide">Pengguna Jasa</p>
                    <p class="mt-3 text-3xl font-semibold text-orange-800">{{ $totalPenggunaJasa }}</p>
                </div>
            </div>

            <!-- Buat Surat Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Buat Surat PIBK Baru</h3>
                        <p class="text-gray-600">Mulai input data surat PIBK dengan form lengkap dan kelola dokumen dengan cepat</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('penomoran-form.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition">
                            ➕ Buat Surat Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Surat by Status -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Surat Berdasarkan Status</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($suratByStatus as $status)
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600 capitalize">{{ str_replace('_', ' ', $status->status_pengajuan) }}</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $status->total }}</p>
                        </div>
                    @empty
                        <p class="text-gray-600">Belum ada data surat</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Surats -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Surat Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No. Penomoran</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pengirim</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentSurats as $surat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-800">#{{ $surat->penomoran }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $surat->tanggal_pibk ? \Carbon\Carbon::parse($surat->tanggal_pibk)->format('d/m/Y') : '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $surat->pengirim?->nama_pengirim ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold
                                            @if($surat->status_pengajuan === 'pending_staff') bg-yellow-100 text-yellow-800
                                            @elseif($surat->status_pengajuan === 'diproses_staff') bg-blue-100 text-blue-800
                                            @elseif($surat->status_pengajuan === 'selesai') bg-green-100 text-green-800
                                            @elseif($surat->status_pengajuan === 'ditolak') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif
                                        ">
                                            {{ str_replace('_', ' ', $surat->status_pengajuan) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('penomoran-form.show', $surat->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-600">Belum ada surat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-bold text-blue-900 mb-2">📋 Lihat Semua Surat</h4>
                    <p class="text-blue-700 mb-4">Akses daftar lengkap semua surat PIBK</p>
                    <a href="{{ route('penomoran-form.list') }}" class="inline-flex items-center text-blue-600 hover:text-blue-900 font-semibold">Lihat Daftar →</a>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-bold text-purple-900 mb-2">👥 Kelola User</h4>
                    <p class="text-purple-700 mb-4">Tambah, edit, atau hapus user sistem</p>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-900 font-semibold">Kelola User →</a>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-bold text-green-900 mb-2">🔧 Admin Settings</h4>
                    <p class="text-green-700 mb-4">Konfigurasi sistem dan pengaturan aplikasi</p>
                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-900 font-semibold">Pengaturan →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>