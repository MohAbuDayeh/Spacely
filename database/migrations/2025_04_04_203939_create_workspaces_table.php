<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // المؤجر (Lessor)
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('price_per_hour', 10, 2)->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->decimal('price_per_month', 10, 2)->nullable();
            $table->integer('minimum_term')->default(1);
            $table->enum('minimum_term_unit', ['hour', 'day'])->default('hour');
            $table->decimal('size', 8, 2);
            $table->integer('people_capacity');
            $table->enum('space_type', ['Coworking space', 'Meeting space', 'Office space']);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->decimal('rating', 2, 1)->default(0);  // إضافة عمود التقييم
            $table->string('image')->nullable();  // إضافة عمود الصورة
            $table->timestamps();
            $table->softDeletes();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspaces');
    }
};
