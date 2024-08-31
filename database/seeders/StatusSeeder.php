<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Menunggu Konfirmasi',
            'color' => 'warning',
        ]);
        Status::create([
            'name' => 'Terkonfirmasi',
            'color' => 'info',
        ]);
        Status::create([
            'name' => 'Dikemas',
            'color' => 'primary',
        ]);
        Status::create([
            'name' => 'Dikirim',
            'color' => 'success',
        ]);
        Status::create([
            'name' => 'Dibatalkan',
            'color' => 'danger',
        ]);
    }
}
