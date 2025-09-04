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

    public function showForm(){

        $categories = $this->getDataCategories();
        $services = $this->getDataServices();
        return view('budget.form', compact('categories', 'services'));
    }

    // valida o formulario
    public function form( Request $request)
    {
        //
    }

    // public function budgetCreation(Request $request)
    // {
    //     $code = ($request->code);
    //     return view('pdf.orcamento', compact('code'));
    // }

public function budgetCreation(Request $request)
{
    $codesJson = $request->input('code'); // recebe array de strings JSON

    // Decodifica todos os itens JSON para arrays PHP
    $codes = array_map(function ($item) {
        return json_decode($item, true);
    }, $codesJson);
    // Agora $codes é um array com todos os arrays PHP decodificados
    return view('pdf.orcamento', ['codes' => $codes]);
}




        // função privada que vai buscar os dados á bd das categorias
    private function getDataCategories()
    {
        $categories = Category::get();

        return $categories;
    }

    // função privada que vai buscar os dados á bd dos serviços
    private function getDataServices()
    {
        // join de categorias e servicos
        $services = Category::join('service', 'category.id', '=', 'service.category_id')
            ->select('service.*', 'category.name')
            ->get();

        return $services;
    }

}
