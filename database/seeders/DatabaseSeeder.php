<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        if (DB::table('biodata')->count() === 0) {
            $contents = @file_get_contents(storage_path('biodata.json'));
            $items = json_decode($contents, true) ?? [];

            $rows = array_map(function ($item) {
                return [
                    'zk_nama' => $item['nama'] ?? $item['zk_nama'] ?? '',
                    'zk_npm' => $item['npm'] ?? $item['zk_npm'] ?? '',
                    'zk_prodi' => $item['prodi'] ?? $item['zk_prodi'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $items);

            if (! empty($rows)) {
                DB::table('biodata')->insert($rows);
            }
        }
    }
}
