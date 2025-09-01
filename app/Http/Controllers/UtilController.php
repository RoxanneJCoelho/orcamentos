<?php

namespace App\Http\Controllers;

class UtilController extends Controller
{
     // mostra a página inicial
    public function showHomepage(){
        return view('util.homepage');
    }
}
