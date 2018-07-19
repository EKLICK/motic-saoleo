<?php

namespace App\Http\Controllers;

use App\Contato;
use App\Sobre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function regulamento()
    {
        return view('regulamento');
    }

    public function contato()
    {
        $contato = Contato::latest()->first();
        return view('contato', compact('contato'));
    }

    public function sobre()
    {
        $sobre = Sobre::latest()->first();
        return view('sobre', compact('sobre'));
    }
}
