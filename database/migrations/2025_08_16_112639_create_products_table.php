<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // اسم المنتج
            $table->string('description');          // الوصف
            $table->integer('price');               // الثمن
            $table->integer('quantity');            // الكمية
            $table->foreignId('category_id')->constrained()->onDelete('set null');
            $table->string('image')->nullable();    // صورة المنتج
            $table->string('status')->default('pending')
                ->check('status in ("pending","approved","rejected")'); // زدنا rejected
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // البائع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
