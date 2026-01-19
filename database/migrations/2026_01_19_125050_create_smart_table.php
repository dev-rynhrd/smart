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
        // Gunakan koneksi database SMART
        $connection = 'SMART';

        // 1. Table: items
        if (!Schema::connection($connection)->hasTable('items')) {
            Schema::connection($connection)->create('items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('sku')->unique();
                $table->string('unit');
                $table->integer('unit_contents')->default(1);
                $table->string('category')->nullable();
                $table->integer('min_stock')->default(0);
                $table->timestamps();
            });
        }

        // 2. Table: stocks
        if (!Schema::connection($connection)->hasTable('stocks')) {
            Schema::connection($connection)->create('stocks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
                $table->integer('qty_available')->default(0);
                $table->integer('qty_reserved')->default(0);
                $table->string('location')->nullable();
                $table->timestamps();
            });
        }

        // 3. Table: requests
        if (!Schema::connection($connection)->hasTable('requests')) {
            Schema::connection($connection)->create('requests', function (Blueprint $table) {
                $table->id();
                $table->string('request_number')->unique();
                // Foreign keys ke database USER_HRIS (tidak menggunakan ->constrained())
                $table->unsignedBigInteger('requester_id')->index(); 
                $table->unsignedBigInteger('handler_id')->nullable()->index();
                $table->string('status');
                $table->string('priority')->default('normal');
                $table->timestamps();
            });
        }

        // 4. Table: request_items
        if (!Schema::connection($connection)->hasTable('request_items')) {
            Schema::connection($connection)->create('request_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
                $table->foreignId('item_id')->constrained('items');
                $table->integer('qty_requested');
                $table->integer('qty_approved')->default(0);
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }

        // 5. Table: stock_movements
        if (!Schema::connection($connection)->hasTable('stock_movements')) {
            Schema::connection($connection)->create('stock_movements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('stock_id')->constrained('stocks');
                $table->foreignId('request_id')->nullable()->constrained('requests');
                $table->string('movement_type'); // in, out, adjustment
                $table->integer('qty');
                $table->unsignedBigInteger('created_by')->index(); // Link ke USER_HRIS
                $table->timestamps();
            });
        }

        // 6. Table: request_histories
        if (!Schema::connection($connection)->hasTable('request_histories')) {
            Schema::connection($connection)->create('request_histories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
                $table->string('action');
                $table->unsignedBigInteger('action_by')->index(); // Link ke USER_HRIS
                $table->timestamps();
            });
        }

        // 7. Table: reimbursements
        if (!Schema::connection($connection)->hasTable('reimbursements')) {
            Schema::connection($connection)->create('reimbursements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
                $table->unsignedBigInteger('user_id')->index(); // Link ke USER_HRIS
                $table->string('status');
                $table->decimal('amount', 15, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connection = 'SMART';
        
        // Drop tables dalam urutan terbalik untuk menghindari error foreign key
        Schema::connection($connection)->dropIfExists('reimbursements');
        Schema::connection($connection)->dropIfExists('request_histories');
        Schema::connection($connection)->dropIfExists('stock_movements');
        Schema::connection($connection)->dropIfExists('request_items');
        Schema::connection($connection)->dropIfExists('requests');
        Schema::connection($connection)->dropIfExists('stocks');
        Schema::connection($connection)->dropIfExists('items');
    }
};