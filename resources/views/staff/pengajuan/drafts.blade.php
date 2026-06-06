<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Draft Surat - Surat Selesai</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($drafts->isEmpty())
                        <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6 text-center text-sm text-gray-600">
                            Belum ada draft surat selesai.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No. Penomoran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama Pengirim</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tgl Selesai</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($drafts as $index => $draft)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-800">#{{ $draft->formatted_penomoran }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $draft->pengirim->nama_pengirim ?? '-' }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $draft->completed_by_staff_at?->format('d M Y H:i') ?? '-' }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm">
                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Selesai</span>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-right space-y-2 sm:space-y-0 sm:space-x-2 sm:flex sm:justify-end">
                                                <a href="{{ route('penomoran-form.show', $draft->id) }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-700">
                                                    Lihat
                                                </a>
                                                <a target="_blank" href="{{ route('penomoran-form.print', $draft->id) }}" class="inline-flex items-center rounded-md bg-sky-500 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-sky-600">
                                                    PIBK
                                                </a>
                                                <a target="_blank" href="{{ route('penomoran-form.printIp', $draft->id) }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-700">
                                                    IP
                                                </a>
                                                <a target="_blank" href="{{ route('penomoran-form.printSppb', $draft->id) }}" class="inline-flex items-center rounded-md bg-amber-500 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-amber-600">
                                                    SPPB
                                                </a>
                                                <a target="_blank" href="{{ route('penomoran-form.printLhpIp', $draft->id) }}" class="inline-flex items-center rounded-md bg-rose-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-rose-700">
                                                    LHP IP
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
