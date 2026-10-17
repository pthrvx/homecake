<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUSES = ['Baru', 'Diproses', 'Selesai', 'Dibatalkan'];

    // Teks yang dilihat pelanggan di halaman Cek Pesanan
    public const STATUS_INFO = [
        'Baru' => ['icon' => '📝', 'title' => 'Pesanan diterima',
            'text' => 'Pesanan Anda sudah masuk dan menunggu diperiksa admin HomeCake.',
            'next' => 'Tidak ada yang perlu Anda lakukan sekarang. Cek lagi nanti untuk melihat perubahan status.'],
        'Diproses' => ['icon' => '🧁', 'title' => 'Pesanan sedang diproses',
            'text' => 'Admin sudah memeriksa pesanan Anda dan sedang menyiapkannya.',
            'next' => 'Jika ada yang ingin diubah, segera hubungi HomeCake dan sebutkan kode pesanan.'],
        'Selesai' => ['icon' => '✅', 'title' => 'Pesanan selesai',
            'text' => 'Pesanan ini sudah ditandai selesai oleh admin HomeCake.',
            'next' => 'Terima kasih sudah memesan! Mau pesan lagi? Silakan lihat menu.'],
        'Dibatalkan' => ['icon' => '⚠️', 'title' => 'Pesanan dibatalkan',
            'text' => 'Pesanan ini sudah dibatalkan oleh admin HomeCake.',
            'next' => 'Jika ini tidak sesuai, hubungi HomeCake. Anda juga bisa membuat pesanan baru.'],
    ];

    protected $fillable = ['customer_name', 'whatsapp', 'email', 'product_id', 'quantity', 'event_date', 'notes', 'status'];
    protected $casts = ['event_date' => 'date'];

    protected static function booted(): void
    {
        static::creating(fn ($o) => $o->code ??= static::makeCode());
    }

    public function product() { return $this->belongsTo(Product::class); }
    public function getWaLinkAttribute(): string { return 'https://wa.me/'.static::normalizePhone($this->whatsapp); }

    public function getEventDateLabelAttribute(): string
    {
        return $this->event_date->copy()->locale('id')->translatedFormat('l, j F Y');
    }

    public function wib(string $field): string
    {
        return $this->{$field}->copy()->timezone('Asia/Jakarta')->format('d/m/Y H:i').' WIB';
    }

    public static function earliestDate(): \Illuminate\Support\Carbon
    {
        return now('Asia/Jakarta')->addDays((int) config('homecake.min_days'))->startOfDay();
    }

    public static function makeCode(): string
    {
        $abc = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // tanpa I, O, 0, 1 agar tidak membingungkan
        do {
            $code = 'HC-';
            for ($i = 0; $i < 6; $i++) $code .= $abc[random_int(0, strlen($abc) - 1)];
        } while (static::where('code', $code)->exists());
        return $code;
    }

    public static function normalizeCode(string $c): string
    {
        $raw = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $c));
        return strlen($raw) === 8 ? 'HC-'.substr($raw, 2) : 'HC-'.$raw; // boleh tanpa "HC-"
    }

    public static function normalizePhone(string $n): string
    {
        $d = preg_replace('/\D/', '', $n);
        return str_starts_with($d, '0') ? '62'.substr($d, 1) : $d; // 0812.. = +62812.. = 62812..
    }
}
