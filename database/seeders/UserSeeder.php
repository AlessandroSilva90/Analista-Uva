<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Uva Admin',
            'email' => 'uva@admin.com.br',
            'cpf' => '99999999999' ,
            'telefone' => '88992254651',
            'is_admin' => true
        ]);

        User::factory()->count(10)->create();
    }
}
