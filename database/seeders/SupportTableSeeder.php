<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupportTableSeeder extends Seeder
{
    /**
     * Database connection
     */
    protected $connection = 'SMART';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // =============================================
        // 1. REQUEST STATUSES
        // =============================================
        $this->command->info('Seeding request_statuses...');
        
        DB::connection($this->connection)->table('request_statuses')->insert([
            [
                'name' => 'Draft',
                'slug' => 'draft',
                'sort_order' => 1,
                'description' => 'Request masih dalam draft, belum disubmit',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Pending',
                'slug' => 'pending',
                'sort_order' => 2,
                'description' => 'Request sudah disubmit, menunggu review dari Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'In Review',
                'slug' => 'in_review',
                'sort_order' => 3,
                'description' => 'Request sedang dalam proses review oleh Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Approved',
                'slug' => 'approved',
                'sort_order' => 4,
                'description' => 'Request disetujui secara penuh',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Partial Approved',
                'slug' => 'partial',
                'sort_order' => 5,
                'description' => 'Request disetujui sebagian karena keterbatasan stok',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rejected',
                'slug' => 'rejected',
                'sort_order' => 6,
                'description' => 'Request ditolak oleh Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ready for Pickup',
                'slug' => 'ready',
                'sort_order' => 7,
                'description' => 'Barang sudah siap untuk diambil',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Completed',
                'slug' => 'completed',
                'sort_order' => 8,
                'description' => 'Request selesai, barang sudah diambil',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cancelled',
                'slug' => 'cancelled',
                'sort_order' => 9,
                'description' => 'Request dibatalkan oleh requester',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 2. REQUEST PRIORITIES
        // =============================================
        $this->command->info('Seeding request_priorities...');
        
        DB::connection($this->connection)->table('request_priorities')->insert([
            [
                'name' => 'Low',
                'slug' => 'low',
                'sort_order' => 1,
                'sla_hours' => 72,
                'description' => 'Prioritas rendah, dapat diproses dalam 3 hari kerja',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Normal',
                'slug' => 'normal',
                'sort_order' => 2,
                'sla_hours' => 48,
                'description' => 'Prioritas normal, diproses dalam 2 hari kerja',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'High',
                'slug' => 'high',
                'sort_order' => 3,
                'sla_hours' => 24,
                'description' => 'Prioritas tinggi, diproses dalam 1 hari kerja',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Urgent',
                'slug' => 'urgent',
                'sort_order' => 4,
                'sla_hours' => 4,
                'description' => 'Prioritas urgent, diproses dalam 4 jam',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 3. REQUEST ITEM STATUSES
        // =============================================
        $this->command->info('Seeding request_item_statuses...');
        
        DB::connection($this->connection)->table('request_item_statuses')->insert([
            [
                'name' => 'Pending',
                'slug' => 'pending',
                'sort_order' => 1,
                'description' => 'Item menunggu review',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Approved',
                'slug' => 'approved',
                'sort_order' => 2,
                'description' => 'Item disetujui sesuai qty yang diminta',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Partial',
                'slug' => 'partial',
                'sort_order' => 3,
                'description' => 'Item disetujui sebagian karena keterbatasan stok',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rejected',
                'slug' => 'rejected',
                'sort_order' => 4,
                'description' => 'Item ditolak',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Fulfilled',
                'slug' => 'fulfilled',
                'sort_order' => 5,
                'description' => 'Item sudah diserahkan ke requester',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Out of Stock',
                'slug' => 'out_of_stock',
                'sort_order' => 6,
                'description' => 'Item tidak tersedia karena stok habis',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 4. REQUEST ACTIONS
        // =============================================
        $this->command->info('Seeding request_actions...');
        
        DB::connection($this->connection)->table('request_actions')->insert([
            [
                'name' => 'Created',
                'slug' => 'created',
                'description' => 'Request dibuat',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Submitted',
                'slug' => 'submitted',
                'description' => 'Request disubmit untuk direview',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Reviewed',
                'slug' => 'reviewed',
                'description' => 'Request sedang direview',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Approved',
                'slug' => 'approved',
                'description' => 'Request disetujui',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Partial Approved',
                'slug' => 'partial_approved',
                'description' => 'Request disetujui sebagian',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rejected',
                'slug' => 'rejected',
                'description' => 'Request ditolak',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Ready for Pickup',
                'slug' => 'ready_pickup',
                'description' => 'Barang siap diambil',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Picked Up',
                'slug' => 'picked_up',
                'description' => 'Barang sudah diambil',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Completed',
                'slug' => 'completed',
                'description' => 'Request selesai',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cancelled',
                'slug' => 'cancelled',
                'description' => 'Request dibatalkan',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Note Added',
                'slug' => 'note_added',
                'description' => 'Catatan ditambahkan ke request',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Handler Assigned',
                'slug' => 'handler_assigned',
                'description' => 'Handler ditugaskan untuk menangani request',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 5. STOCK MOVEMENT TYPES
        // =============================================
        $this->command->info('Seeding stock_movement_types...');
        
        DB::connection($this->connection)->table('stock_movement_types')->insert([
            [
                'name' => 'Stock In',
                'slug' => 'in',
                'description' => 'Barang masuk ke gudang (restock, pembelian baru)',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Stock Out',
                'slug' => 'out',
                'description' => 'Barang keluar dari gudang (fulfilled request)',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Adjustment Add',
                'slug' => 'adjustment_add',
                'description' => 'Penyesuaian stok penambahan (koreksi stock opname)',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Adjustment Subtract',
                'slug' => 'adjustment_subtract',
                'description' => 'Penyesuaian stok pengurangan (rusak, hilang, expired)',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Reserved',
                'slug' => 'reserved',
                'description' => 'Stok di-hold untuk request yang sudah diapprove',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Unreserved',
                'slug' => 'unreserved',
                'description' => 'Stok yang di-hold dikembalikan (request dibatalkan)',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 6. REIMBURSEMENT REASONS
        // =============================================
        $this->command->info('Seeding reimbursement_reasons...');
        
        DB::connection($this->connection)->table('reimbursement_reasons')->insert([
            [
                'name' => 'Partial Stock',
                'slug' => 'partial_stock',
                'description' => 'Stok hanya tersedia sebagian, karyawan membeli sendiri sisanya',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Out of Stock',
                'slug' => 'out_of_stock',
                'description' => 'Stok habis, karyawan membeli sendiri seluruh kebutuhan',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Urgent No Budget',
                'slug' => 'urgent_no_budget',
                'description' => 'Kebutuhan urgent tetapi tidak ada budget dari Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Over Budget Limit',
                'slug' => 'over_budget_limit',
                'description' => 'Harga item melebihi batas budget yang dapat disediakan Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Special Item',
                'slug' => 'special_item',
                'description' => 'Item khusus yang tidak tersedia di inventory Asset Team',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // =============================================
        // 7. REIMBURSEMENT STATUSES
        // =============================================
        $this->command->info('Seeding reimbursement_statuses...');
        
        DB::connection($this->connection)->table('reimbursement_statuses')->insert([
            [
                'name' => 'Pending',
                'slug' => 'pending',
                'sort_order' => 1,
                'description' => 'Reimbursement menunggu review',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Approved',
                'slug' => 'approved',
                'sort_order' => 2,
                'description' => 'Reimbursement disetujui, menunggu pembayaran',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rejected',
                'slug' => 'rejected',
                'sort_order' => 3,
                'description' => 'Reimbursement ditolak',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Paid',
                'slug' => 'paid',
                'sort_order' => 4,
                'description' => 'Reimbursement sudah dibayarkan',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Cancelled',
                'slug' => 'cancelled',
                'sort_order' => 5,
                'description' => 'Reimbursement dibatalkan oleh karyawan',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('');
        $this->command->info('✅ All support tables seeded successfully!');
        $this->command->info('');
        $this->command->table(
            ['Table', 'Records'],
            [
                ['request_statuses', '9'],
                ['request_priorities', '4'],
                ['request_item_statuses', '6'],
                ['request_actions', '12'],
                ['stock_movement_types', '6'],
                ['reimbursement_reasons', '5'],
                ['reimbursement_statuses', '5'],
            ]
        );
        $this->command->info('Total: 47 records');
    }
}