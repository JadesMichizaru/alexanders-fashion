<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table
                ->foreignId('account_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table
                ->enum('status', ['pending', 'completed', 'cancelled'])
                ->default('pending');
            $table->string('payment_method')->nullable(); // cash, transfer, dll
            $table->text('notes')->nullable();
            $table->timestamps(); // created_at akan otomatis mencatat tanggal transaksi

            // Index untuk memudahkan pencarian
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
