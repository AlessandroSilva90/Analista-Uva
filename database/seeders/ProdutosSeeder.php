<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\produtos;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        produtos::create([
            'nome' => 'Café',
            'descricao' => 'Melhor café da região, plantado em verdes campos',
            'preco_venda' => '10',
            'preco_compra' => '8'
        ]);

        produtos::create([
            'nome' => 'Açucar',
            'descricao' => 'Melhor café da região, plantado em campos altos',
            'preco_venda' => '6',
            'preco_compra' => '3'
        ]);
    }
}
