<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\produtos;
use App\Models\categoria;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $bebida = categoria::firstOrCreate(['name' => 'Bebidas']);
        $alimento = categoria::firstOrCreate(['name' => 'Alimentos']);

        produtos::updateOrCreate(
            [
                'nome' => 'Café' // Condição de busca
            ],
            [
                'descricao' => 'Melhor café da região, plantado em verdes campos',
                'preco_venda' => '10',
                'preco_compra' => '8',
                'id_categoria' => $bebida->id,
                'foto_produto' => 'cafe.jpg'
            ]
        );
        produtos::updateOrCreate(
            [
                'nome' => 'Açucar' // Condição de busca
            ],
            [
                'descricao' => 'Melhor açucar da região, plantado em campos altos',
                'preco_venda' => '6',
                'preco_compra' => '3',
                'id_categoria' => $alimento->id,
                'foto_produto' => 'acucar.jpg'
            ]
            );


    }
}
