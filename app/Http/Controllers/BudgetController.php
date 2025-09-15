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
    ini_set('max_execution_time', 120);
    ini_set('memory_limit', '256M');
    $codesJson = $request->input('code'); // recebe array de strings JSON

    // Decodifica todos os itens JSON para arrays PHP
    // $codes = array_map(function ($item) {
    //     return json_decode($item, true);
    // }, $codesJson);

    $codes = json_decode($codesJson, true);
    //print_r($codes);

    return view('pdf.orcamento', ['codes' => $codes]);
    // return Pdf::view('pdf.orcamento', ['codes' => $codes])
    //     ->name('orcamento.pdf')
    //     ->download();
}

// public function downloadPdf(){

//     return Pdf::view('pdf.orcamento')
//     ->name('orcamento.pdf');

// }

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
