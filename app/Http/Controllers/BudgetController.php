<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // busca os dados da bd e mostra o formulário
    public function showForm()
    {
        $categories = Category::with('services')->get(); // traz os servicos as categorias associados
        return view('budget.form', compact('categories'));
    }

    // função privada que vai buscar os dados á base de dados dos serviços
    private function getDataServices()
    {
        // join de categorias e servicos
        $services = Category::join('service', 'category.id', '=', 'service.category_id')
            ->select(
                'service.*',
                'category.name as category_name'
            )
            ->get()
            ->groupBy('category_name');

        return $services;
    }



    // valida o formulario
    public function form( Request $request)
    {
        //
    }
}
