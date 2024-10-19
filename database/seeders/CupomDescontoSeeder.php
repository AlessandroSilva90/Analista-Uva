<?php

namespace Database\Seeders;

use App\Models\CupomDesconto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CupomDescontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CupomDesconto::factory()->count(10)->create();
    }
}
