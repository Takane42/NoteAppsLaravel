<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">NoteApp</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show" 
                x-transition 
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-4"
            >
                {{ session('success') }}
            </div>
        @endif

        {{-- Menu Tabs --}}
        <div class="flex space-x-4 mb-6">
            <a href="?menu=tambah" class="px-4 py-2 rounded {{ request('menu') == 'tambah' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Tambah Note</a>
            <a href="?menu=lihat" class="px-4 py-2 rounded {{ request('menu') == 'lihat' || request('menu') == '' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Lihat Notes</a>
            <a href="?menu=hapus" class="px-4 py-2 rounded {{ request('menu') == 'hapus' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">Hapus Notes</a>
        </div>

        {{-- Tampilkan sesuai menu --}}
        @if(request('menu') == 'tambah')
            {{-- Form Tambah Note --}}
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" name="title" placeholder="Judul Catatan" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <textarea name="content" rows="4" placeholder="Isi catatan" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                </form>
            </div>

        @elseif(request('menu') == 'hapus')
            {{-- Hapus Notes --}}
            <div class="space-y-4">
                @forelse($notes as $note)
                    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $note->title }}</h3>
                            <p class="text-gray-600">{{ $note->content }}</p>
                        </div>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                @empty
                    <p>Tidak ada catatan untuk dihapus.</p>
                @endforelse
            </div>

        @else
            {{-- Lihat Notes --}}
            <div class="space-y-4">
                @forelse($notes as $note)
                    <div class="bg-white p-4 rounded shadow">
                        @if(request('edit') == $note->id)
                            {{-- Form Edit --}}
                            <form action="{{ route('notes.update', $note->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-2">
                                    <input type="text" name="title" value="{{ $note->title }}" class="w-full p-2 border rounded" required>
                                </div>
                                <div class="mb-2">
                                    <textarea name="content" rows="4" class="w-full p-2 border rounded">{{ $note->content }}</textarea>
                                </div>
                                <div class="flex gap-2 justify-end">
                                    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Update</button>
                                    <a href="{{ route('notes.index', ['menu' => 'lihat']) }}" class="bg-gray-400 text-white px-4 py-1 rounded hover:bg-gray-500">Batal</a>
                                </div>
                            </form>
                        @else
                            {{-- Tampilkan note --}}
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $note->title }}</h3>
                                    <p class="text-gray-600">{{ $note->content }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $note->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('notes.index', ['menu' => 'lihat', 'edit' => $note->id]) }}"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <p>Tidak ada catatan.</p>
                @endforelse
            </div>
        @endif
    </div>
</x-app-layout>
