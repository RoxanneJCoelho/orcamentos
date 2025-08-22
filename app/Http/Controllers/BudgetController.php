<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    // busca os dados da bd e mostra o formulário
    public function showForm()
    {
        $categorias = $this->getDataForm();
        return view('budget.form', compact('categorias'));
    }

    // função privada que vai buscar os dados á base de dados
    private function getDataForm()
    {
        // Faz join de categorias com serviços
        $categorias = DB::table('category')
            ->leftJoin('service', 'category.id', '=', 'service.category_id')
            ->select(
                'category.id as categoria_id',
                'category.name as categoria_nome',
                'service.id as servico_id',
                'service.description as servico_descricao',
                'service.price as preco'
            )
            ->orderBy('category.name')
            ->get();

        // Agrupa serviços por categoria
        $result = [];
        foreach ($categorias as $row) {
            // Cria categoria se ainda não existir
            if (!isset($result[$row->categoria_id])) {
                $result[$row->categoria_id] = [
                    'id' => $row->categoria_id,
                    'name' => $row->categoria_nome,
                    'servicos' => []
                ];
            }

            // Adiciona serviço se existir
            if ($row->servico_id) {
                $result[$row->categoria_id]['servicos'][] = [
                    'id' => $row->servico_id,
                    'name' => $row->servico_descricao,
                    'price' => $row->preco,
                ];
            }
        }

        // Converte para array indexado numericamente para facilitar na view
        return array_values($result);
    }

    // valida o formulario
    public function form( Request $request)
    {
        //
    }
}
