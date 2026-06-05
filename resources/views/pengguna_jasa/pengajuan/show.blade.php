<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengajuan</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pengajuan</h3>
                        @php
                            $status = $penomoran->status_pengajuan;
                            $badgeClass = 'bg-gray-100 text-gray-700';
                            $statusLabel = $status ?? '-';

                            if ($status === 'pending_staff') {
                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                                $statusLabel = 'Menunggu Staff';
                            } elseif ($status === 'selesai') {
                                $badgeClass = 'bg-green-100 text-green-800';
                                $statusLabel = 'Selesai';
                            }
                        @endphp

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="space-y-3">
                                <div class="inline-flex items-center gap-2">
                                    <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $badgeClass }}">{{ $statusLabel }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium text-gray-800">Tgl Submit</p>
                                    <p>{{ $penomoran->submitted_by_pengguna_at?->format('d M Y H:i') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pengirim</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Nama Pengirim</p>
                                <p>{{ $penomoran->pengirim->nama_pengirim ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Pengirim</p>
                                <p>{{ $penomoran->pengirim->alamat_pengirim ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Penerima</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Nama Penerima</p>
                                <p>{{ $penomoran->penerima->nama_penerima ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Penerima</p>
                                <p>{{ $penomoran->penerima->alamat_penerima ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pemberitahu</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Nama Pemberitahu</p>
                                <p>{{ $penomoran->pemberitahu->nama_pemberitahu ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Alamat Pemberitahu</p>
                                <p>{{ $penomoran->pemberitahu->alamat_pemberitahu ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengangkutan</h3>
                        <div class="space-y-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">Cara Pengangkutan</p>
                                <p>{{ $penomoran->pengangkutan->cara_pengangkutan ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Sarana Angkut</p>
                                <p>{{ $penomoran->pengangkutan->nama_sarkut ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Rute</p>
                                <p>{{ $penomoran->pengangkutan->pelabuhan_muat ?? '-' }} → {{ $penomoran->pengangkutan->pelabuhan_bongkar ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('pengguna-jasa.pengajuan.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
