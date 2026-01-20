<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $connection = 'SMART';

        // --- SUPPORT TABLES ---
        
        Schema::connection($connection)->create('item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('request_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('request_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->integer('sla_hours')->default(24);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('request_item_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('request_actions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('stock_movement_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('reimbursement_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('reimbursement_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // --- MASTER & TRANSACTION TABLES ---

        Schema::connection($connection)->create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('item_categories');
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->string('unit');
            $table->integer('unit_contents')->default(1);
            $table->integer('min_stock')->default(0);
            $table->integer('max_request_qty')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::connection($connection)->create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->unique()->constrained('items')->onDelete('cascade');
            $table->integer('qty_available')->default(0);
            $table->integer('qty_reserved')->default(0);
            $table->string('location')->nullable();
            $table->timestamp('last_restock_at')->nullable();
            $table->timestamp('last_checkout_at')->nullable();
            $table->timestamps();
        });

        Schema::connection($connection)->create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->unsignedBigInteger('requester_id')->index(); // HRIS
            $table->unsignedBigInteger('handler_id')->nullable()->index(); // HRIS
            $table->foreignId('status_id')->constrained('request_statuses');
            $table->foreignId('priority_id')->constrained('request_priorities');
            $table->date('needed_date');
            $table->text('purpose')->nullable();
            $table->text('requester_notes')->nullable();
            $table->text('handler_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::connection($connection)->create('request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('qty_requested');
            $table->integer('qty_approved')->default(0);
            $table->integer('qty_fulfilled')->default(0);
            $table->foreignId('status_id')->constrained('request_item_statuses');
            $table->string('unit_at_request')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::connection($connection)->create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained('stocks');
            $table->foreignId('request_id')->nullable()->constrained('requests');
            $table->foreignId('movement_type_id')->constrained('stock_movement_types');
            $table->integer('qty');
            $table->integer('qty_before');
            $table->integer('qty_after');
            $table->string('reference_number')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->index(); // HRIS
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::connection($connection)->create('request_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->foreignId('action_id')->constrained('request_actions');
            $table->unsignedBigInteger('old_status_id')->nullable();
            $table->unsignedBigInteger('new_status_id')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('action_by')->index(); // HRIS
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::connection($connection)->create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->string('reimbursement_number')->unique();
            $table->foreignId('request_id')->nullable()->constrained('requests');
            $table->unsignedBigInteger('user_id')->index(); // HRIS
            $table->string('item_name');
            $table->text('item_description')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->date('purchase_date');
            $table->string('receipt_file')->nullable();
            $table->foreignId('reason_id')->constrained('reimbursement_reasons');
            $table->text('reason_notes')->nullable();
            $table->foreignId('status_id')->constrained('reimbursement_statuses');
            $table->unsignedBigInteger('reviewed_by')->nullable()->index(); // HRIS
            $table->timestamp('reviewed_at')->nullable();
            $table->text('reviewer_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $connection = 'SMART';
        Schema::connection($connection)->dropIfExists('reimbursements');
        Schema::connection($connection)->dropIfExists('request_histories');
        Schema::connection($connection)->dropIfExists('stock_movements');
        Schema::connection($connection)->dropIfExists('request_items');
        Schema::connection($connection)->dropIfExists('requests');
        Schema::connection($connection)->dropIfExists('stocks');
        Schema::connection($connection)->dropIfExists('items');
        Schema::connection($connection)->dropIfExists('reimbursement_statuses');
        Schema::connection($connection)->dropIfExists('reimbursement_reasons');
        Schema::connection($connection)->dropIfExists('stock_movement_types');
        Schema::connection($connection)->dropIfExists('request_actions');
        Schema::connection($connection)->dropIfExists('request_item_statuses');
        Schema::connection($connection)->dropIfExists('request_priorities');
        Schema::connection($connection)->dropIfExists('request_statuses');
        Schema::connection($connection)->dropIfExists('item_categories');
    }
};