<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    public function create()
    {
        $categorias = $this->getCategoriasComServicos();
        return view('auth.form', compact('categorias'));
    }

    private function getCategoriasComServicos()
    {
        // Faz join de categorias com serviços
        $categorias = DB::table('category')
            ->leftJoin('service', 'category.id', '=', 'service.category_id')
            ->select(
                'category.id as categoria_id',
                'category.name as categoria_nome',
                'service.id as servico_id',
                'service.name as servico_nome',
                'service.price'
            )
            ->orderBy('category.name')
            ->get();

        // Agrupa serviços por categoria
        $result = [];
        foreach ($categorias as $row) {
            $result[$row->categoria_id]['id'] = $row->categoria_id;
            $result[$row->categoria_id]['nome'] = $row->categoria_nome;
            $result[$row->categoria_id]['servicos'][] = [
                'id' => $row->servico_id,
                'nome' => $row->servico_nome,
                'preco' => $row->preco,
            ];
        }

        return $result;
    }

}
