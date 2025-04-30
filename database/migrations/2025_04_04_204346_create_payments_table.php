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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['paid', 'pending', 'failed'])->default('pending');
            $table->foreignId('lessor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('renter_id')->constrained('users')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
