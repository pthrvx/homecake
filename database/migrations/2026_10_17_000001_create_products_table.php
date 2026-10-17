<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('description')->nullable();
            $t->unsignedInteger('price');
            $t->string('category')->default('Lainnya');
            $t->string('image_path')->nullable();
            $t->boolean('is_featured')->default(false);
            $t->boolean('is_available')->default(true);
            $t->boolean('is_sample')->default(false); // true = contoh data
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};
