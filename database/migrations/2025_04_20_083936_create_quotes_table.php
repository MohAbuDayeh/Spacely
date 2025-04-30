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
    Schema::create('quotes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // ربط مع المستخدم
        $table->foreignId('workspace_id')->constrained('workspaces')->onDelete('cascade');  // ربط مع المساحة
        $table->decimal('amount', 10, 2);  // المبلغ المطلوب
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');  // حالة الطلب
        $table->date('availability_date')->nullable();
        $table->timestamps();  // تاريخ الإنشاء والتعديل
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
