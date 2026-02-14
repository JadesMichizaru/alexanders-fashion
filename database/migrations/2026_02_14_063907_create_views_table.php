<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->string('page'); // halaman yang dilihat
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();
            $table->integer('views')->default(1); // hitungan view
            $table->timestamps();

            // Index untuk pencarian lebih cepat
            $table->index('page');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
