<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // mostrar espaço admin
    public function showAdmin()
    {
        $categories = $this->getDataCategories();
        $services = $this->getDataServices();
        return view('admin.space', compact('categories', 'services'));
    }

    // mostrar adicionar categoria
    public function addCategory()
    {
        return view('admin.category-add');
    }

    // valida a categoria e insere na BD
    public function addCategoryStore(Request $request)
    {
        // Validação dos novos dados
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-zÀ-ÿ\s-]+$/|unique:category,name',
        ], [
            'name.unique' => 'Categoria já existente',
            'name.regex'  => 'Nome inválido: apenas pode colocar espaços, letras e hífen',
        ]);

        // Criação da nova categoria
        Category::insert([
            'name' => $request->name,
        ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('show.admin')->with('message', 'Categoria adicionada com sucesso!');
    }

    // editar categoria
    public function editCategory($id)
    {
        $myCategory = Category::where('id', $id)->first();
        return view('admin.category-edit', compact('myCategory'));
    }

    // atualiza a categoria na bd
    public function editCategoryStore(Request $request)
    {
        // Validação dos novos dados
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-zÀ-ÿ\s-]+$/|unique:category,name'
        ], [
            'name.unique' => 'Categoria já existente',
            'name.regex'  => 'Nome inválido: apenas pode colocar espaços, letras e hífen',
        ]);

        // Atualizar a categoria
        Category::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'updated_at' => now()
            ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('show.admin')->with('message', 'Categoria atualizada com sucesso!');
    }

    // mostrar eliminar categoria
    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();

        return redirect()->route('show.admin')->with('message', 'Categoria removida com sucesso!');
    }

    // mostrar adicionar servicos
    public function addService()
    {
        $categories = $this->getDataCategories();
        return view('admin.service-add', compact('categories'));
    }

    // valida o servico e adiciona na bd
    public function addServiceStore(Request $request)
    {

        // Validação dos novos dados
        $request->validate([
            'code' => 'required|regex:/^[0-9]{6}[a-z]$/|unique:service,code',
            'description' => 'required|max:255|regex:/^[A-Za-zÀ-ÿ\s]+$/|unique:service,description',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required|exists:category,id',
        ], [
            'code.regex' => 'O código deve ter exatamente 6 dígitos seguidos de uma letra minúscula (ex: 654377i).',
            'code.unique' => 'Código já existente',
            'description.unique' => 'Serviço já existente',
            'description.regex'  => 'Nome inválido: apenas pode colocar espaços e letras',
        ]);

        // Criação do novo servico
        Service::insert([
            'code' => $request->code,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
        ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('show.admin')->with('message', 'Serviço adicionado com sucesso!');
    }

    // mostrar editar servicos
    public function editService($id)
    {
        $myService = Service::where('id', $id)->first();
        $categories = $this->getDataCategories();
        return view('admin.service-edit', compact('myService', 'categories'));
    }

    // valida os dados do editar servico
    public function editServiceStore(Request $request)
    {
        // Validação dos novos dados
        $request->validate([
            'code' => 'regex:/^[0-9]{6}[a-z]$/',
            'description' => 'max:255|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'price' => 'numeric',
            'discount' => 'numeric',
            'category_id' => 'exists:category,id',
        ], [
            'code.regex' => 'O código deve ter exatamente 6 dígitos seguidos de uma letra minúscula (ex: 654377i).',
            'code.unique' => 'Código já existente',
            'description.unique' => 'Serviço já existente',
            'description.regex'  => 'Nome inválido: apenas pode colocar espaços e letras',
        ]);

        // Atualizar dados serviços
        Service::where('id', $request->id)
            ->update([
                'code'        => $request->code,
                'description' => $request->description,
                'price'       => $request->price,
                'discount'    => $request->discount,
                'category_id' => $request->category_id,
            ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('show.admin')->with('message', 'Serviço atualizado com sucesso!');
    }

    // mostrar apagar servicos
    public function deleteService($id)
    {
        Service::where('id', $id)->delete();

        return redirect()->route('show.admin')->with('message', 'Serviço removido com sucesso!');
    }

    // mostrar perfil - página principal
    public function showProfile()
    {
        $user = $this->getDataUser();
        return view('admin.profile', compact('user'));
    }

    // mostrar alterar dados perfil
    public function editProfile()
    {
        $user = $this->getDataUser();
        return view('admin.profile-edit', compact('user'));
    }

    // valida os dados do Alterar Dados
    public function editProfileStore(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'string|max:255|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'NIF/NIPC' => 'regex:/^[0-9]{9}$/',
            'telemovel' => 'regex:/^[0-9]{9}$/',
        ], [
            'name.regex' => 'Nome inválido: apenas pode colocar espaços e letras',
            'NIF/NIPC.regex' => 'O NIF/NIPC deve ter exatamente 9 dígitos',
            'telemovel.regex' => 'O número de telemóvel deve ter exatamente 9 dígitos',
        ]);

        // Atualizar dados perfil
        User::where('id', $request->id)
            ->update([
                'name'        => $request->name,
                'morada'      => $request->morada,
                'NIF/NIPC'    => $request->input('NIF/NIPC'),
                'telemovel'   => $request->telemovel,
            ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('show.profile')->with('message', 'Perfil atualizado com sucesso!');
    }

    // mostrar alterar password
    public function editProfilePassword()
    {
        $user = $this->getDataUser();
        return view('admin.profile-password', compact('user'));
    }

    // função privada que vai buscar os dados do user autenticado
    private function getDataUser()
    {
        return Auth::user();
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
