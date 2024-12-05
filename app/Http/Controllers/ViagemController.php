<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Viagem;

class ViagemController extends Controller
{
    public function index()
    {
        $viagens =Viagem::all();
        return view('viagens.index',compact('viagens'));
    }

    public function create()
    {
        return view('viagens.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:100',
            'description' => 'required|max:100',
            'local' => 'required|max:100',
        ]);
        Viagem::create($request->all());
        return redirect()->route('viagens.index');
    }
    public function show($id)
    {
        $viagem = Viagem::fidOrfail($id);
        return view('viagens.show',compact('viagem'));
    }

}
