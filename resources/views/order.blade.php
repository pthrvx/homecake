@extends('layouts.app')
@section('title', 'Pesan Kue')
@section('content')
<section class="mx-auto max-w-2xl px-4 py-12">
  <h1 class="font-display text-4xl font-bold">Pesan kue</h1>
  <p class="mt-2 text-cocoa/80">Isi data berikut. Pesanan Anda akan tercatat dan diperiksa admin HomeCake.</p>
  @if($products->isEmpty())
    <p class="mt-8 rounded-2xl bg-white p-6">Saat ini belum ada produk yang bisa dipesan.</p>
  @else
  <form method="POST" action="{{ route('order.store') }}" class="mt-8 space-y-5"
        onsubmit="const b=this.querySelector('button[type=submit]');b.disabled=true;b.textContent='Mengirim…'">
    @csrf
    @if($errors->has('form_token') || $errors->has('website'))<div role="alert" class="rounded-xl bg-red-100 p-4 text-red-800">{{ $errors->first('form_token') ?: $errors->first('website') }}</div>@endif
    <div class="sr-only" aria-hidden="true"><label>Kosongkan kolom ini<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
    <input type="hidden" name="form_token" value="{{ $token }}">
    <x-input name="customer_name" label="Nama" required maxlength="100" autocomplete="name" />
    <x-input name="whatsapp" label="Nomor WhatsApp" type="tel" placeholder="081234567890" required pattern="(\+62|62|0)8[0-9]{8,12}" title="Contoh: 081234567890" autocomplete="tel" />
    <x-input name="email" label="Email (opsional)" type="email" autocomplete="email" />
    <div>
      <label for="product_id" class="mb-1 block text-sm font-medium">Produk</label>
      <select id="product_id" name="product_id" required class="field">
        <option value="">Pilih produk…</option>
        @foreach($products as $p)<option value="{{ $p->id }}" @selected(old('product_id', $selected) == $p->id)>{{ $p->name }} — {{ $p->price_label }}</option>@endforeach
      </select>
      @error('product_id')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
    </div>
    <x-input name="quantity" label="Jumlah" type="number" :value="1" min="1" max="100" required />
    <x-input name="event_date" label="Tanggal acara / pengambilan" type="date" :min="$minDate->toDateString()" required />
    @if($minDays > 0)<p class="-mt-3 text-sm text-cocoa/75">Agar kue sempat disiapkan, mohon pesan minimal <strong>{{ $minDays }} hari</strong> sebelumnya. Tanggal paling cepat: <strong>{{ $minLabel }}</strong>.</p>@endif
    <div>
      <label for="notes" class="mb-1 block text-sm font-medium">Catatan tambahan (opsional)</label>
      <textarea id="notes" name="notes" rows="4" maxlength="1000" class="field">{{ old('notes') }}</textarea>
      @error('notes')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
    </div>
    <x-button class="w-full">Kirim pesanan</x-button>
  </form>
  @endif
</section>
@endsection
