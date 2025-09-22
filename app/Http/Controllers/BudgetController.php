<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Budget;
use App\Models\Option;
use App\Models\Category;
use App\Mail\MyTestEmail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Mail;

class BudgetController extends Controller
{
    // mostra o orcamento
    public function showForm()
    {
        $services = $this->getDataServices();

        return view('budget.form', compact('services'));
    }

    // valida o formulario, gera pdf e envia para email
    public function budgetCreation(Request $request)
    {
        // validação de dados
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Criação de novo user
        $user = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now()
        ]);

        //  dd($user);

        // Criação de novo orçamento
        $budget = Budget::insertGetId([
            'user_id' => $user,
            'total'   => 0,
            'created_at' => now()
        ]);

        // Ler os dados da tabela
        $servicosSelecionados = json_decode($request->tabelaSelecionadosJSON, true);
        $total = 0;

        foreach ($servicosSelecionados as $servico) {
            $preco = $servico['preco'];
            $quantidade = $servico['quantidade'];
            $desconto = $servico['desconto'] ?? 0;

            $valorFinal = ($preco * $quantidade) * (1 - $desconto / 100);
            $total += $valorFinal;

            Option::insert([
                'budget_id' => $budget,
                'service_id'   => $servico['id'],
                'qtd'         => $quantidade,
                'discount'     => $desconto,
                'valor'        => $valorFinal,
                'created_at' => now()
            ]);
        }

        // // atualizar o total do orçamento
        $budget->update(['total' => $total]);

        // // mensagem de sucesso
        return redirect()->back()->with('success', 'Orçamento registado com sucesso!');

        // // GERAR PDF
        // $codesJson = $request->input('code'); // recebe array de strings JSON
        // $codesJson2 = $request->input('data');

        // $codes = json_decode($codesJson, true);
        // $data = json_decode($codesJson2, true);

        // $request->input('name');
        // $request->input('email');

        // if ($request->input('action') === 'download') {

        //     $pdf = PDF::loadView('pdf.orcamento', ['codes' => $codes]);

        //     return $pdf->download('pdf.orcamento', ['codes' => $codes]);
        // } elseif ($request->input('action') === 'sendEmail') {

        //     $pdf = PDF::loadView('pdf.orcamento', ['codes' => $codes])->output();

        //     Mail::to('admin@admin.com')->send(new MyTestEmail($pdf));


        //     return back()->with('success', 'Orçamento enviado com sucesso para ' . 'email');
        // }
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
