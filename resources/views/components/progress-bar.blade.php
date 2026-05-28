@props(['currentPage' => 1, 'penomoranId' => null])

<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Progress Pengisian Form</h3>
        <span class="text-sm text-gray-500">{{ $currentPage }}/10 halaman</span>
    </div>

    <div class="flex items-center space-x-2">
        @php
            $steps = [
                1 => ['title' => 'Penomoran'],
                2 => ['title' => 'Pengirim & Penerima', 'route' => 'penomoran-form.page2'],
                3 => ['title' => 'Pemberitahu & Surat Izin', 'route' => 'penomoran-form.page3'],
                4 => ['title' => 'Pengangkutan', 'route' => 'penomoran-form.page4'],
                5 => ['title' => 'PIB', 'route' => 'penomoran-form.page5'],
                6 => ['title' => 'Uraian Barang', 'route' => 'penomoran-form.page6'],
                7 => ['title' => 'Pemeriksaan', 'route' => 'penomoran-form.page7'],
                8 => ['title' => 'Petugas', 'route' => 'penomoran-form.page8'],
                9 => ['title' => 'Jaminan', 'route' => 'penomoran-form.page9'],
                10 => ['title' => 'Review & Simpan', 'route' => 'penomoran-form.page10'],
            ];
        @endphp

        @foreach($steps as $step => $data)
            @php
                $isCompleted = $step < $currentPage;
                $isCurrent = $step === $currentPage;
                // Step bisa diakses jika sudah completed atau current, atau jika ada penomoranId (sudah tersimpan)
                $isAccessible = $step <= $currentPage || $penomoranId !== null;

                if ($step === 1) {
                    $route = $penomoranId ? route('penomoran-form.edit', $penomoranId) : route('penomoran-form.create');
                } elseif ($penomoranId && isset($data['route'])) {
                    $route = route($data['route'], $penomoranId);
                } else {
                    $route = '#';
                }
            @endphp

            <div class="flex items-center">
                @if($isAccessible && ($step === 1 || $penomoranId))
                    <a href="{{ $route }}"
                       class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium transition-all duration-200
                              {{ $isCompleted ? 'bg-green-500 text-white hover:bg-green-600' :
                                 ($isCurrent ? 'bg-blue-500 text-white ring-2 ring-blue-300' :
                                 'bg-gray-200 text-gray-600 hover:bg-gray-300') }}">
                        {{ $step }}
                    </a>
                @else
                    <div class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium
                                {{ $isCompleted ? 'bg-green-500 text-white' :
                                   ($isCurrent ? 'bg-blue-500 text-white ring-2 ring-blue-300' :
                                   'bg-gray-200 text-gray-400') }}">
                        {{ $step }}
                    </div>
                @endif

                @if($step < 10)
                    <div class="w-8 h-0.5 mx-1 {{ $isCompleted ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-3 text-center">
        <span class="text-sm text-gray-600">{{ $steps[$currentPage]['title'] }}</span>
    </div>
</div>