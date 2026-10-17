<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\GalleryPhoto;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Atur ADMIN_EMAIL dan ADMIN_PASSWORD di .env sebelum menjalankan db:seed.
        Admin::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@homecake.test')],
            ['name' => 'Admin HomeCake', 'password' => env('ADMIN_PASSWORD', 'ganti-password-ini')]
        );

        // Data contoh bersifat idempotent: seeder bisa dijalankan ulang tanpa menggandakan data ini.
        $samples = [
            ['Kue Ulang Tahun Mini', 'Kue Ulang Tahun', 150000, true, true, 'Kue ulang tahun mini dengan krim lembut, cocok untuk perayaan keluarga.'],
            ['Brownies Cokelat', 'Brownies & Bolu', 65000, true, true, 'Brownies cokelat panggang dengan tekstur fudgy dan taburan cokelat.'],
            ['Bolu Pandan', 'Brownies & Bolu', 45000, true, true, 'Bolu pandan lembut dengan aroma pandan yang harum.'],
            ['Snack Box Arisan', 'Paket Acara', 25000, false, true, 'Paket camilan praktis untuk arisan, rapat, dan acara keluarga.'],
            ['Kue Lapis', 'Kue Basah', 30000, false, false, 'Kue lapis tradisional berlapis dengan tekstur kenyal.'],
            ['Cheesecake Strawberry', 'Cheesecake', 95000, true, true, 'Cheesecake creamy dengan topping stroberi segar.'],
            ['Red Velvet Cake', 'Kue Ulang Tahun', 185000, true, true, 'Kue red velvet dengan cream cheese frosting.'],
            ['Chocolate Moist Cake', 'Kue Ulang Tahun', 175000, true, true, 'Kue cokelat moist dengan ganache cokelat.'],
            ['Tiramisu Cake', 'Kue Ulang Tahun', 165000, false, true, 'Kue tiramisu dengan sentuhan kopi dan krim mascarpone.'],
            ['Lemon Cake', 'Brownies & Bolu', 55000, false, true, 'Bolu lemon dengan rasa segar dan manis seimbang.'],
            ['Bolu Pisang', 'Brownies & Bolu', 48000, false, true, 'Bolu pisang rumahan yang lembut dan wangi.'],
            ['Brownies Keju', 'Brownies & Bolu', 72000, true, true, 'Brownies cokelat dengan topping keju parut.'],
            ['Brownies Almond', 'Brownies & Bolu', 75000, false, true, 'Brownies cokelat dengan taburan almond panggang.'],
            ['Donat Gula', 'Roti & Donat', 5000, false, true, 'Donat empuk dengan taburan gula halus.'],
            ['Donat Cokelat', 'Roti & Donat', 7000, false, true, 'Donat lembut berlapis cokelat.'],
            ['Roti Sobek Cokelat', 'Roti & Donat', 38000, false, true, 'Roti sobek lembut dengan isian cokelat.'],
            ['Roti Keju', 'Roti & Donat', 8000, false, true, 'Roti lembut dengan isian dan taburan keju.'],
            ['Risoles Mayo', 'Gorengan & Snack', 4000, false, true, 'Risoles renyah berisi mayo, telur, dan smoked beef.'],
            ['Pastel Ayam', 'Gorengan & Snack', 4000, false, true, 'Pastel gurih dengan isian ayam dan sayuran.'],
            ['Lumpia Sayur', 'Gorengan & Snack', 3500, false, true, 'Lumpia sayur renyah untuk teman minum teh.'],
            ['Puding Cokelat', 'Dessert', 18000, false, true, 'Puding cokelat lembut dengan saus vla.'],
            ['Puding Mangga', 'Dessert', 20000, false, true, 'Puding mangga segar dengan rasa buah tropis.'],
            ['Dessert Box Tiramisu', 'Dessert', 28000, true, true, 'Dessert box berlapis krim, biskuit, dan rasa kopi.'],
            ['Dessert Box Cokelat', 'Dessert', 28000, true, true, 'Dessert box cokelat dengan lapisan ganache.'],
            ['Cupcake Vanilla', 'Cupcake', 12000, false, true, 'Cupcake vanilla dengan buttercream dekoratif.'],
            ['Cupcake Red Velvet', 'Cupcake', 14000, false, true, 'Cupcake red velvet dengan frosting lembut.'],
            ['Cookies Choco Chip', 'Cookies', 45000, false, true, 'Cookies renyah dengan choco chips.'],
            ['Cookies Oatmeal', 'Cookies', 42000, false, true, 'Cookies oatmeal dengan tekstur renyah.'],
            ['Kue Nastar', 'Cookies', 65000, false, true, 'Nastar dengan selai nanas, cocok untuk suguhan.'],
            ['Kastengel Keju', 'Cookies', 70000, false, true, 'Kastengel gurih dengan keju yang melimpah.'],
            ['Klepon', 'Kue Basah', 2500, false, true, 'Klepon pandan dengan isian gula merah dan kelapa parut.'],
            ['Onde-onde', 'Kue Basah', 3000, false, true, 'Onde-onde wijen dengan isian kacang hijau.'],
            ['Dadar Gulung', 'Kue Basah', 3000, false, true, 'Dadar gulung pandan dengan isian kelapa manis.'],
            ['Serabi Mini', 'Kue Basah', 4000, false, true, 'Serabi mini lembut untuk camilan sore.'],
            ['Paket Snack Meeting', 'Paket Acara', 22000, false, true, 'Paket snack untuk rapat dan kegiatan kantor.'],
            ['Paket Ulang Tahun 10 Orang', 'Paket Acara', 325000, true, true, 'Paket kue dan camilan untuk perayaan kecil sepuluh orang.'],
            ['Kue Custom Premium', 'Kue Ulang Tahun', 275000, true, true, 'Kue custom untuk momen spesial dengan dekorasi pilihan.'],
        ];

        // Foto demo relevan dari Unsplash. Produk tetap berstatus data contoh.
        $photo = static fn (string $id, int $width = 1000): string => "https://images.unsplash.com/{$id}?auto=format&fit=crop&w={$width}&q=80";
        $photoSets = [
            'cake' => [$photo('photo-1578985545062-69928b1d9587'), $photo('photo-1563729784474-d77dbb933a9e'), $photo('photo-1533134242443-d4fd215305ad')],
            'chocolate' => [$photo('photo-1606313564200-e75d5e30476c'), $photo('photo-1578985545062-69928b1d9587'), $photo('photo-1563729784474-d77dbb933a9e')],
            'bread' => [$photo('photo-1509440159596-0249088772ff'), $photo('photo-1555507036-ab1f4038808a'), $photo('photo-1608198093002-ad4e005484df')],
            'donut' => [$photo('photo-1551024506-0bccd828d307'), $photo('photo-1555507036-ab1f4038808a')],
            'cookie' => [$photo('photo-1499636136210-6f4ee915583e'), $photo('photo-1606313564200-e75d5e30476c')],
            'dessert' => [$photo('photo-1488477181946-6428a0291777'), $photo('photo-1563729784474-d77dbb933a9e'), $photo('photo-1533134242443-d4fd215305ad')],
            'pastry' => [$photo('photo-1555507036-ab1f4038808a'), $photo('photo-1509440159596-0249088772ff'), $photo('photo-1499636136210-6f4ee915583e')],
        ];
        $choosePhoto = static function (string $name, string $category, int $index) use ($photoSets): string {
            $text = mb_strtolower($name.' '.$category);
            if (str_contains($text, 'donat')) $key = 'donut';
            elseif (str_contains($text, 'roti') || str_contains($text, 'bolu')) $key = 'bread';
            elseif (str_contains($text, 'cookie') || str_contains($text, 'nastar') || str_contains($text, 'kastengel')) $key = 'cookie';
            elseif (str_contains($text, 'brownies') || str_contains($text, 'cokelat')) $key = 'chocolate';
            elseif (str_contains($text, 'puding') || str_contains($text, 'dessert') || str_contains($text, 'cheesecake')) $key = 'dessert';
            elseif (str_contains($text, 'snack') || str_contains($text, 'risoles') || str_contains($text, 'pastel') || str_contains($text, 'lumpia') || str_contains($text, 'klepon') || str_contains($text, 'onde-onde') || str_contains($text, 'dadar') || str_contains($text, 'serabi')) $key = 'pastry';
            else $key = 'cake';
            $set = $photoSets[$key];
            return $set[$index % count($set)];
        };

        $products = collect();
        foreach ($samples as $sampleIndex => [$name, $category, $price, $featured, $available, $description]) {
            $slug = Str::slug($name) . '-contoh';
            $product = Product::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'category' => $category,
                    'price' => $price,
                    'description' => $description,
                    'is_featured' => $featured,
                    'is_available' => $available,
                    'is_sample' => true,
                ]
            );
            if ($product->is_sample && (!$product->image_path || !str_starts_with($product->image_path, 'products/'))) {
                $product->forceFill(['image_path' => $choosePhoto($name, $category, $sampleIndex)])->save();
            } elseif ($product->is_sample && str_starts_with((string) $product->image_path, 'products/')) {
                // Foto unggahan lokal yang sudah ada tidak ditimpa.
            } elseif ($product->is_sample) {
                $product->forceFill(['image_path' => $choosePhoto($name, $category, $sampleIndex)])->save();
            }
            $products->push($product);
        }

        // Galeri demo untuk memberi isi pada halaman galeri dan panel admin.
        $gallerySamples = [
            ['Kue cokelat untuk perayaan spesial', $photo('photo-1578985545062-69928b1d9587', 900)],
            ['Brownies cokelat panggang', $photo('photo-1606313564200-e75d5e30476c', 900)],
            ['Donat manis untuk teman santai', $photo('photo-1551024506-0bccd828d307', 900)],
            ['Aneka pastry dari oven', $photo('photo-1555507036-ab1f4038808a', 900)],
            ['Roti hangat gaya artisan', $photo('photo-1509440159596-0249088772ff', 900)],
            ['Cookies untuk bingkisan', $photo('photo-1499636136210-6f4ee915583e', 900)],
            ['Inspirasi dessert manis', $photo('photo-1488477181946-6428a0291777', 900)],
            ['Suasana dapur dan proses baking', $photo('photo-1608198093002-ad4e005484df', 900)],
        ];
        foreach ($gallerySamples as [$caption, $imageUrl]) {
            $gallery = GalleryPhoto::firstOrCreate(['caption' => '[DEMO] '.$caption], ['image_path' => $imageUrl]);
            if (!$gallery->image_path) $gallery->forceFill(['image_path' => $imageUrl])->save();
        }

        // Pesanan demo dengan tanggal pembuatan historis dan tanggal acara mendatang.
        // Prefix DUMMY memudahkan admin mengenali pesanan simulasi.
        $customers = [
            ['Alya Putri', '081234560101'], ['Bima Pratama', '081234560102'],
            ['Citra Maharani', '081234560103'], ['Daffa Ramadhan', '081234560104'],
            ['Elsa Permata', '081234560105'], ['Farhan Akbar', '081234560106'],
            ['Gita Anindya', '081234560107'], ['Hana Safitri', '081234560108'],
            ['Ilham Maulana', '081234560109'], ['Jihan Azzahra', '081234560110'],
            ['Kevin Saputra', '081234560111'], ['Laras Wulandari', '081234560112'],
            ['Miko Firmansyah', '081234560113'], ['Nadia Amelia', '081234560114'],
            ['Omar Fadillah', '081234560115'], ['Putri Lestari', '081234560116'],
            ['Rafi Kurniawan', '081234560117'], ['Salsa Nabila', '081234560118'],
            ['Tio Prakoso', '081234560119'], ['Vina Oktaviani', '081234560120'],
            ['Wahyu Hidayat', '081234560121'], ['Yasmin Zahra', '081234560122'],
            ['Zaki Alfarizi', '081234560123'], ['Dinda Aprilia', '081234560124'],
            ['Fikri Nugraha', '081234560125'], ['Intan Puspita', '081234560126'],
            ['Rizky Ananda', '081234560127'], ['Naufal Hakim', '081234560128'],
            ['Maya Kusuma', '081234560129'], ['Aditya Prasetyo', '081234560130'],
            ['Nina Kurniasih', '081234560131'], ['Bagas Setiawan', '081234560132'],
            ['Siti Rahma', '081234560133'], ['Arman Wijaya', '081234560134'],
            ['Tania Putri', '081234560135'], ['Reza Firmansyah', '081234560136'],
        ];
        $statuses = ['Baru', 'Diproses', 'Selesai', 'Selesai', 'Dibatalkan'];
        $notesList = [
            'Minta tulisan ucapan sederhana.', 'Untuk acara keluarga, kemasan rapi ya.',
            'Mohon konfirmasi sebelum pesanan dikirim.', 'Pesanan demo untuk acara kantor.',
            'Tolong pisahkan tiap porsi.', 'Dekorasi warna pastel jika memungkinkan.',
            'Untuk kejutan ulang tahun.', 'Tidak perlu lilin tambahan.',
            'Mohon cantumkan nama penerima di kotak.', 'Pesanan simulasi untuk dashboard admin.',
        ];

        foreach ($customers as $i => [$customerName, $phone]) {
            $number = $i + 1;
            $product = $products[$i % $products->count()];
            $note = sprintf('[DUMMY %02d] %s', $number, $notesList[$i % count($notesList)]);
            $createdAt = now()->subDays(($i * 3) % 45)->setTime(9 + ($i % 9), ($i * 7) % 60);
            $eventDate = now()->addDays(3 + (($i * 2) % 30))->toDateString();

            $order = Order::firstOrCreate(
                ['notes' => $note],
                [
                    'customer_name' => $customerName,
                    'whatsapp' => $phone,
                    'email' => 'pelanggan' . $number . '@example.test',
                    'product_id' => $product->id,
                    'quantity' => 1 + ($i % 5),
                    'event_date' => $eventDate,
                    'status' => $statuses[$i % count($statuses)],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
            // Memastikan kode pesanan dibuat jika aplikasi sebelumnya pernah menyimpan kode kosong.
            if (!$order->code) {
                $order->forceFill(['code' => Order::makeCode()])->save();
            }
        }
    }
}
