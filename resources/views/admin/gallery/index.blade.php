@extends('layouts.admin')
@section('title', 'Galeri')
@section('content')
<h1 class="font-display text-3xl font-bold">Galeri dokumentasi</h1>
<p class="mt-1 text-sm">Foto produk tampil otomatis di galeri dari data produk. Di sini Anda menambah foto dokumentasi kegiatan.</p>
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="mt-6 max-w-xl space-y-4 rounded-2xl border border-cocoa/10 bg-white p-5">
  @csrf
  <div>
    <label for="image" class="mb-1 block text-sm font-medium">Foto (jpg/png/webp, maks 2 MB)</label>
    <input id="image" name="image" type="file" required accept="image/jpeg,image/png,image/webp" class="field">
    @error('image')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
  </div>
  <x-input name="caption" label="Keterangan foto (juga dibaca sebagai teks alternatif)" required maxlength="150" />
  <x-button>Unggah foto</x-button>
</form>
@if($photos->isEmpty())
  <p class="mt-8 rounded-2xl bg-white p-6">Belum ada foto dokumentasi.</p>
@else
  <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach($photos as $p)
      <figure class="admin-gallery-tile flex h-full flex-col overflow-hidden rounded-2xl border border-cocoa/10 bg-white">
        <img src="{{ $p->image_url }}" alt="{{ $p->caption }}" class="admin-gallery-image aspect-square w-full object-cover">
        <figcaption class="flex-1 p-3 text-sm">{{ $p->caption }}
          <form method="POST" action="{{ route('admin.gallery.destroy', $p) }}" onsubmit="return confirm('Hapus foto ini?')">@csrf @method('DELETE')<button class="mt-2 min-h-11 text-red-700 underline">Hapus</button></form>
        </figcaption>
      </figure>
    @endforeach
  </div>
@endif
@endsection
