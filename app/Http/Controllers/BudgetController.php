<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    // busca os dados da bd e mostra o formulário
    public function showForm()
    {
        $categories = Category::with('services')->get(); // traz com os servicos as categorias associados
        return view('budget.form', compact('categories'));
    }

    // valida o formulario
    public function form( Request $request)
    {
        //
    }

}
