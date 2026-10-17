<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_photos', function (Blueprint $t) {
            $t->id();
            $t->string('image_path');
            $t->string('caption'); // juga dipakai sebagai alt text
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('gallery_photos'); }
};
