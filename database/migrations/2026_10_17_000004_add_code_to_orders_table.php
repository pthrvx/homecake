<?php
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->string('code', 12)->nullable()->unique()->after('id');
        });
        // Pesanan lama (mis. hasil tes) ikut diberi kode
        Order::whereNull('code')->get()->each(fn ($o) => $o->forceFill(['code' => Order::makeCode()])->saveQuietly());
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $t) {
            $t->dropUnique(['code']);
            $t->dropColumn('code');
        });
    }
};
