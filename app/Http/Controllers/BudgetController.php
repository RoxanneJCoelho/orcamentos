<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Mail\BudgetMail;
use App\Models\Category;
use App\Mail\MyTestEmail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BudgetController extends Controller
{
    // mostra o orcamento
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

        if (!Storage::exists('pdfs')) {
            Storage::makeDirectory('pdfs');
        }
        $codesJson = $request->input('code');
        $codesJson2 = $request->input('data');

        $codes = json_decode($codesJson, true);

        // Guardar name e email em variáveis
        $name = $request->input('name');
        $email = $request->input('email');
        $total = $request->input('total');

        DB::table('users')->updateOrInsert(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make('defaultpassword'), 'updated_at' => now()]
        );


        $user = User::where('email', $email)->first();
        $userId = $user->id;
        $budgetCode = uniqid();

        // dd($request->all());

        $isPDF = $request->input('isPDF');

        if (!DB::table('budget')
            ->where('user_id', $userId)
            ->where('total', $total)
            ->where('emission_date', '>=', now()->subDays(30))
            ->exists()) {

            DB::table('budget')->insert([
                'user_id' => $userId,
                'code' => $budgetCode,
                'emission_date' => now(),
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Gerar PDF
        $pdf = PDF::loadView('pdf.orcamento', [
            'codes' => $codes,
            'name'  => $name,
            'email' => $email,
            'total' => $total,
        ]);

        // Guardar PDF no storage
        $fileName = 'orcamento_' . $budgetCode . '.pdf';
        $storagePath = 'pdfs/' . $fileName;
        Storage::put($storagePath, $pdf->output());

        // Atualizar a tabela budget com caminho do PDF
        DB::table('budget')->where('code', $budgetCode)->update([
            'code' => $storagePath
        ]);

        if ($isPDF === 'true') {
            return $pdf->download('pdf.orcamento.pdf');
        } else {
            Mail::to($email)->send(new MyTestEmail($pdf->output(), $name));
            return back()->with('success', 'Orçamento enviado com sucesso para ' . $email);
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
