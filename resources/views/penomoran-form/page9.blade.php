<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 9: Jaminan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="9" :penomoranId="$penomoran->id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage9', $penomoran->id) }}">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Jaminan</h3>

                                <div class="mb-4">
                                    <x-input-label for="pembayaran" :value="__('Pembayaran')" />
                                    <x-text-input id="pembayaran" name="pembayaran" type="text" class="mt-1 block w-full" value="{{ old('pembayaran', $jaminan->pembayaran ?? '') }}" />
                                    @error('pembayaran')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="jaminan" :value="__('Jaminan')" />
                                    <textarea id="jaminan" name="jaminan" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('jaminan', $jaminan->jaminan ?? '') }}</textarea>
                                    @error('jaminan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="mb-6">
                                    <x-input-label for="pejabat_penerima" :value="__('Pejabat Penerima')" />
                                    <x-text-input id="pejabat_penerima" name="pejabat_penerima" type="text" class="mt-1 block w-full" value="{{ old('pejabat_penerima', $jaminan->pejabat_penerima ?? '') }}" />
                                    @error('pejabat_penerima')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('penomoran-form.back', [$penomoran->id, 9]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            <x-primary-button>
                                {{ __('Simpan Data') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
