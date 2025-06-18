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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('address')->nullable();
            $table->enum('governorate', [
                "Amman", "Zarqa", "Irbid", "Aqaba", "Mafraq",
                "Balqa", "Karak", "Madaba", "Tafilah", "Jerash",
                "Ajloun", "Maan"
            ])->default("Amman");
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->decimal('price_per_hour', 10, 2)->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->decimal('price_per_month', 10, 2)->nullable();
            $table->integer('minimum_term')->default(1);
            $table->enum('minimum_term_unit', ['hour', 'day', 'month'])->default('hour');
            $table->decimal('size', 8, 2);
            $table->integer('people_capacity');
            $table->enum('space_type', ['Coworking space', 'Meeting space', 'Private Office']);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->decimal('rating', 2, 1)->default(0);
            $table->json('images')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['governorate', 'status']);
            $table->index(['latitude', 'longitude']);
            $table->index('space_type');
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
