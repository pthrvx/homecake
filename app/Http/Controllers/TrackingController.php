<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function form(Request $r) { return view('track', ['code' => $r->query('kode')]); }

    public function check(Request $r)
    {
        $r->validate(
            ['code' => ['required', 'string', 'max:20'], 'whatsapp' => ['required', 'string', 'max:25']],
            ['required' => ':attribute wajib diisi.'],
            ['code' => 'Kode pesanan', 'whatsapp' => 'Nomor WhatsApp']
        );

        $order = Order::with('product')->where('code', Order::normalizeCode($r->code))->first();

        // Pesan yang sama untuk "kode salah" dan "nomor salah", agar kode orang lain tidak bisa ditebak
        if (! $order || Order::normalizePhone($order->whatsapp) !== Order::normalizePhone($r->whatsapp)) {
            return back()->withInput($r->only('code'))
                ->withErrors(['lookup' => 'Pesanan tidak ditemukan. Periksa kembali kode pesanan dan nomor WhatsApp yang Anda pakai saat memesan.']);
        }
        return view('track', compact('order'));
    }
}
