<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Surat') }}
            </h2>
            <a href="{{ route('penomoran-form.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                + Buat Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($pnomorans->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Penomoran</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal PIBK</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach($pnomorans as $index => $pnomoran)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ ($pnomorans->currentPage() - 1) * $pnomorans->perPage() + $index + 1 }}
                                            </td>
                                            <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                                                {{ $pnomoran->penomoran }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $pnomoran->tanggal_pibk ? $pnomoran->tanggal_pibk->format('d-m-Y') : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $pnomoran->pengirim->nama_pengirim ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $pnomoran->penerima->nama_penerima ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $pnomoran->created_at->format('d-m-Y H:i') }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('penomoran-form.edit', $pnomoran->id) }}"
                                                        title="Edit"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-medium rounded transition">
                                                        ✎ Edit
                                                    </a>
                                                    <a href="{{ route('penomoran-form.show', $pnomoran->id) }}"
                                                        title="Lihat"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-sky-500 hover:bg-sky-600 text-white text-xs font-medium rounded transition">
                                                        ◉ Lihat
                                                    </a>
                                                    <div class="inline-block text-left">
                                                        <button type="button"
                                                            onclick="openPrintModal({{ $pnomoran->id }})"
                                                            title="Pilih Cetak"
                                                            class="inline-flex items-center px-2.5 py-1.5 bg-gray-500 hover:bg-gray-600 text-white text-xs font-medium rounded transition">
                                                            ⎙ Cetak
                                                        </button>
                                                    </div>
                                                    <button type="button"
                                                        onclick="hapusData({{ $pnomoran->id }})"
                                                        title="Hapus"
                                                        class="inline-flex items-center px-2.5 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded transition">
                                                        ✕ Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-center">
                            {{ $pnomorans->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-sm mb-2">Belum ada data PIBK.</p>
                            <a href="{{ route('penomoran-form.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                                + Buat yang baru sekarang
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div id="printModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Pilih Jenis Cetak</h3>
                    <p class="text-sm text-gray-600">Pilih dokumen yang ingin dicetak untuk surat ini.</p>
                </div>
                <button type="button" onclick="closePrintModal()" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <div class="px-5 py-4 space-y-3">
                <input type="hidden" id="printModalId" value="">
                <button type="button" onclick="printSelected(document.getElementById('printModalId').value, 'print')" class="w-full text-left px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">PIBK</button>
                <button type="button" onclick="printSelected(document.getElementById('printModalId').value, 'printIp')" class="w-full text-left px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition">Surat IP</button>
                <button type="button" onclick="printSelected(document.getElementById('printModalId').value, 'printSppb')" class="w-full text-left px-4 py-3 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-md transition">SPPB</button>
                <button type="button" onclick="printSelected(document.getElementById('printModalId').value, 'printLhpIp')" class="w-full text-left px-4 py-3 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-md transition">LHP IP</button>
            </div>
            <div class="px-5 py-4 border-t border-gray-200 text-right">
                <button type="button" onclick="closePrintModal()" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition">Batal</button>
            </div>
        </div>
    </div>
</x-app-layout>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function hapusData(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        document.getElementById('deleteForm').action = '{{ route("penomoran-form.destroy", ":id") }}'.replace(':id', id);
        document.getElementById('deleteForm').submit();
    }
}

function openPrintModal(id) {
    document.getElementById('printModalId').value = id;
    document.getElementById('printModal').classList.remove('hidden');
}

function closePrintModal() {
    document.getElementById('printModal').classList.add('hidden');
}

window.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePrintModal();
    }
});

var printModal = document.getElementById('printModal');
if (printModal) {
    printModal.addEventListener('click', function(event) {
        if (event.target === printModal) {
            closePrintModal();
        }
    });
}

function printSelected(id, doc) {
    closePrintModal();
    var base = '{{ url("/penomoran-form") }}' + '/' + id;
    var url = base + '/print';
    if (doc === 'printIp') url = base + '/print-ip';
    if (doc === 'printSppb') url = base + '/print-sppb';
    if (doc === 'printLhpIp') url = base + '/print-lhp-ip';

    var iframeId = 'printFrameHidden';
    var iframe = document.getElementById(iframeId);
    if (!iframe) {
        iframe = document.createElement('iframe');
        iframe.id = iframeId;
        iframe.style.position = 'absolute';
        iframe.style.left = '-9999px';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';
        document.body.appendChild(iframe);
    }

    var handled = false;

    iframe.onload = function() {
        try {
            if (iframe.contentWindow) {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
                handled = true;
            }
        } catch (e) {
            handled = false;
        }
    };

    iframe.src = url;

    setTimeout(function() {
        if (!handled) {
            window.location.href = url;
        }
    }, 5000);
}
</script>