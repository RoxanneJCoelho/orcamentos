<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // // busca os dados da bd e mostra o formulário
    // public function showForm()
    // {
    //     $categories = Category::with('services')->get(); // traz com os servicos as categorias associados
    //     return view('budget.form', compact('categories'));
    // }

    public function showForm()
    {
        $services = $this->getDataServices();
        return view('budget.form', compact('services'));
    }

    // valida o formulario
    public function form(Request $request)
    {
        //
    }

    public function budgetCreation(Request $request)
    {
        // dd($request->all());
        $tabela = json_decode($request->tabelaSelecionadosJSON, true);
        $precoTotal = $request->precoTotal;

        // Para gerar PDF ou mostrar na view
        return view('pdf.orcamento', compact('tabela', 'precoTotal'));
    }

    // função privada que vai buscar os dados á bd dos serviços
    private function getDataServices()
    {
        // join de categorias e servicos
        $services = Category::join('services', 'categories.id', '=', 'services.category_id')
            ->select('services.*', 'categories.name as category_name')
            ->get()
            ->groupBy('category_id');

        return $services;
    }
}
