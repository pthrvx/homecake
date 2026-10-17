@extends('layouts.admin')
@section('title', 'Masuk')
@section('content')
<div class="mx-auto max-w-sm rounded-2xl border border-cocoa/10 bg-white p-6">
  <h1 class="font-display text-2xl font-bold">Masuk admin</h1>
  <form method="POST" action="{{ route('admin.login.post') }}" class="mt-5 space-y-4">
    @csrf
    <x-input name="email" label="Email" type="email" required autofocus />
    <x-input name="password" label="Password" type="password" required />
    <x-button class="w-full">Masuk</x-button>
  </form>
</div>
@endsection
