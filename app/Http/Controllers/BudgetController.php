<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Mail\BudgetMail;
use App\Models\Category;
use App\Mail\MyTestEmail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Mail;

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
        $codesJson = $request->input('code'); // recebe array de strings JSON
        $codesJson2 = $request->input('data');

        $codes = json_decode($codesJson, true);
        $data = json_decode($codesJson2, true);

        $request->input('name');
        $request->input('email');

        if($request->input('action') === 'download'){

            $pdf = PDF::loadView('pdf.orcamento', ['codes' => $codes]);

            return $pdf->download('pdf.orcamento', ['codes' => $codes]);

        }elseif($request->input('action') === 'sendEmail'){

            $pdf = PDF::loadView('pdf.orcamento', ['codes' => $codes])->output();

            Mail::to('admin@admin.com')->send(new MyTestEmail($pdf));


        return back()->with('success', 'Certificado enviado com sucesso para ' . 'email');
        }
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
