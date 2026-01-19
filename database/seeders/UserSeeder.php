<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $connection = 'SMART';
        
        // Truncate table first (hapus semua data existing)
        DB::connection($connection)->table('users')->truncate();
        
        // Insert fresh data
        $users = [
            [
                'name' => 'Reynhard Ramadhan Halaka',
                'username' => '255476',
                'password' => '$2y$12$oAt4sGGxnrB9Wadjwxa94OvKrAh01W0ObZy3VrcFLHxjRaFJzI0wC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rizky Saputra',
                'username' => '235315',
                'password' => '$2y$12$oAt4sGGxnrB9Wadjwxa94OvKrAh01W0ObZy3VrcFLHxjRaFJzI0wC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arya Gesha Pamangkit',
                'username' => '245417',
                'password' => '$2y$12$oAt4sGGxnrB9Wadjwxa94OvKrAh01W0ObZy3VrcFLHxjRaFJzI0wC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::connection($connection)->table('users')->insert($users);
    }
}
