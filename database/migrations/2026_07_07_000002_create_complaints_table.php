<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('province_id');
            $table->string('province_name');
            $table->string('regency_id');
            $table->string('regency_name');
            $table->string('district_id');
            $table->string('district_name');
            $table->string('village_id');
            $table->string('village_name');
            $table->string('title');
            $table->text('description');
            $table->string('photo')->nullable();
            $table->text('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->date('complaint_date');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->timestamps();

            $table->index(['status', 'complaint_date']);
            $table->index(['province_id', 'regency_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
