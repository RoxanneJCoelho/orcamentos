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
        $categories = $this->getDataCategories();
        $services = $this->getDataServices();

           // Agrupar serviços por category_id
        $servicesByCategory = [];
        foreach ($services as $service) {
            $servicesByCategory[$service->category_id][] = $service;
        }

        return view('budget.form', compact('categories', 'servicesByCategory'));
    }

    // valida o formulario
    public function form(Request $request)
    {
        //
    }

    public function budgetCreation(Request $request)
    {
        $code = $request->code;
        return view('pdf.orcamento', compact('code'));
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
        $services = Category::join('services', 'categories.id', '=', 'services.category_id')
            ->select('services.*', 'categories.name')
            ->get();

        return $services;
    }
}
