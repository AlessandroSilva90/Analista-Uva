<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\produtos;
use App\Models\categoria;
use App\Models\Estoque;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $bebida = categoria::firstOrCreate(['name' => 'Bebidas']);
        $alimento = categoria::firstOrCreate(['name' => 'Alimentos']);

        $produto1 = produtos::updateOrCreate(
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

        Estoque::updateOrCreate(
            [
                'produto_id' => $produto1->id // Condição de busca no estoque
            ],
            [
                'quantidade_disponivel' => 20 // Quantidade de estoque
            ]
        );

        $produto2 = produtos::updateOrCreate(
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

            Estoque::updateOrCreate(
                [
                    'produto_id' => $produto2->id // Condição de busca no estoque
                ],
                [
                    'quantidade_disponivel' => 35 // Quantidade de estoque
                ]
            );






    }
}
