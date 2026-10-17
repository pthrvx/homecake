<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->string('customer_name');
            $t->string('whatsapp', 20);
            $t->string('email')->nullable();
            $t->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $t->unsignedSmallInteger('quantity')->default(1);
            $t->date('event_date');
            $t->text('notes')->nullable();
            $t->string('status')->default('Baru');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
