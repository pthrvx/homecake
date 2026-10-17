<?php
namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:100'],
            'whatsapp' => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'product_id' => ['required', Rule::exists('products', 'id')->where('is_available', true)],
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'event_date' => ['required', 'date', 'after_or_equal:'.Order::earliestDate()->toDateString()], // batas pesan minimal
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    // Anti-spam: (1) kolom jebakan "website" harus kosong, (2) form tidak boleh terkirim < 3 detik setelah dibuka
    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            if (filled($this->input('website'))) {
                $v->errors()->add('website', 'Pengiriman ditolak.');
                return;
            }
            try { $t = (int) Crypt::decryptString((string) $this->input('form_token')); } catch (\Throwable) { $t = 0; }
            if ($t === 0) $v->errors()->add('form_token', 'Formulir sudah tidak berlaku. Muat ulang halaman, lalu coba lagi.');
            elseif (time() - $t < 3) $v->errors()->add('form_token', 'Formulir terkirim terlalu cepat. Tunggu sebentar, lalu kirim ulang.');
        });
    }

    public function attributes(): array
    {
        return ['customer_name' => 'Nama', 'whatsapp' => 'Nomor WhatsApp', 'email' => 'Email', 'product_id' => 'Produk',
            'quantity' => 'Jumlah', 'event_date' => 'Tanggal acara', 'notes' => 'Catatan'];
    }

    public function messages(): array
    {
        $min = (int) config('homecake.min_days');
        return ['required' => ':attribute wajib diisi.', 'whatsapp.regex' => 'Nomor WhatsApp tidak valid. Contoh: 081234567890.',
            'email' => 'Format email tidak valid.',
            'event_date.after_or_equal' => $min > 0
                ? "Pemesanan minimal {$min} hari sebelum acara. Pilih tanggal mulai ".Order::earliestDate()->copy()->locale('id')->translatedFormat('j F Y').'.'
                : 'Tanggal acara tidak boleh sebelum hari ini.',
            'product_id.exists' => 'Produk ini tidak tersedia.', 'integer' => ':attribute harus angka.', 'min' => ':attribute minimal :min.'];
    }
}
