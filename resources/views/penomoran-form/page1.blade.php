<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman 1: Penomoran PIBK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <x-progress-bar :currentPage="1" :penomoranId="$id" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('penomoran-form.savePage1') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ old('id', $id ?? '') }}">

                        <div class="mb-6">
                            <x-input-label for="penomoran" :value="__('Nomor Penomoran')" />
                            <x-text-input
                                id="penomoran"
                                name="penomoran"
                                type="number"
                                class="mt-1 block w-full"
                                value="{{ old('penomoran', $penomoran->penomoran ?? '') }}"
                                placeholder="Masukkan angka bulat tanpa nol di depan. Contoh: 1, 16, 125"
                                inputmode="numeric"
                                min="1"
                                max="999999"
                                step="1"
                                autocomplete="off"
                                required
                            />
                            <p class="mt-2 text-sm text-gray-500"></p>
                            @error('penomoran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="tanggal_pibk" :value="__('Tanggal PIBK')" />
                            <x-text-input id="tanggal_pibk" name="tanggal_pibk" type="date" class="mt-1 block w-full" value="{{ old('tanggal_pibk', $penomoran->tanggal_pibk?->format('Y-m-d') ?? '') }}" />
                            @error('tanggal_pibk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            @if($id)
                                <a href="{{ route('penomoran-form.back', [$id, 1]) }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            @else
                                <a href="{{ route('penomoran-form.list') }}" class="text-gray-600 hover:text-gray-800">← Kembali</a>
                            @endif
                            <x-primary-button>
                                {{ __('Simpan & Lanjut Halaman 2') }} →
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const penomoranInput = document.getElementById('penomoran');
            if (! penomoranInput) {
                return;
            }

            penomoranInput.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 6) {
                    this.value = this.value.slice(0, 6);
                }
            });

            penomoranInput.addEventListener('paste', function (event) {
                const pastedText = (event.clipboardData || window.clipboardData).getData('text');
                if (! /^[0-9]+$/.test(pastedText)) {
                    event.preventDefault();
                }
            });

            penomoranInput.addEventListener('wheel', function (event) {
                event.preventDefault();
                const currentValue = Number(this.value) || 0;
                const delta = event.deltaY < 0 ? 1 : -1;
                const nextValue = currentValue + delta;
                if (nextValue >= 1 && nextValue <= 999999) {
                    this.value = nextValue;
                }
            });
        });
    </script>
</x-app-layout>
