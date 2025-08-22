<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
     // mostra a página inicial
    public function showHomepage(){
        return view('util.homepage');
    }
}
