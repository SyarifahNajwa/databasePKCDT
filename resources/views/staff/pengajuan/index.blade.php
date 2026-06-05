<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Surat Masuk - Menunggu Diproses</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Surat Masuk</h3>
                            <p class="text-sm text-gray-600">Surat yang menunggu diproses oleh staff.</p>
                        </div>
                        <a href="{{ route('staff.pengajuan.drafts') }}" class="inline-flex items-center justify-center rounded-md bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-700">
                            Lihat Draft Surat
                        </a>
                    </div>
                    @if($pengajuans->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6 text-center text-sm text-gray-600">
                            Belum ada surat masuk yang perlu diproses.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama Pengguna Jasa</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tgl Submit</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($pengajuans as $index => $pengajuan)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $pengajuan->penggunaJasa->name ?? '-' }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $pengajuan->submitted_by_pengguna_at?->format('d M Y H:i') ?? '-' }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                                <a href="{{ route('staff.pengajuan.edit', $pengajuan->id) }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                                    Proses Surat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
