<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

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

    // editar categoria
    public function editCategory($id)
    {
        $myCategory = Category::where('id', $id)->first();
        return view('admin.category-edit', compact('myCategory'));
    }

    // mostrar eliminar categoria
    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();

        return back();
    }

    // mostrar adicionar servicos
    public function addService()
    {

        return view('admin.service-add');
    }

    // mostrar editar servicos
    public function editService($id)
    {
        $myService = Service::where('id', $id)->first();
        $categories = $this->getDataCategories();
        return view('admin.service-edit', compact ('myService', 'categories'));
    }

    // mostrar apagar servicos
    public function deleteService($id)
    {
        Service::where('id', $id)->delete();

        return back();
    }

    // função privada que vai buscar os dados á base de dados das categorias
    private function getDataCategories()
    {
        $categories = Category::get();

        return $categories;
    }

    // função privada que vai buscar os dados á base de dados dos serviços
    private function getDataServices()
    {
        // join de categorias e servicos
        $services = Category::join('service', 'category.id', '=', 'service.category_id')
            ->select(
                'service.*',
                'category.name'
            )
            ->get();

        return $services;
    }
}
