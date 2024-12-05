<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Viagem;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }
    public function create()
    {
        $viagens = Viagem::all();
        return view('usuario.create', compact('viagens'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'number' => 'required',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);


    }

}
