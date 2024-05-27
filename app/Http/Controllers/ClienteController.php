<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('busca')) {
            $cpf = $request->input('busca');
            $query->where('cpf', 'like', '%' . $cpf . '%');
        }

        $clientes = $query->get();
        return view('cliente/cliente', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'localidade' => 'required',
            'uf' => 'required',
            'numero' => 'required',
        ]);

        Cliente::create($request->all());
        return redirect(route('cliente.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!$cliente = Cliente::find($id))
            return redirect()->route('cliente.index');
        $data = $request->all();
        $cliente->update($data);
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Edit the specified resource from storage.
     */
    public function edit($id)
    {
        if(!$cliente = Cliente::find($id))
            return redirect()->route('cliente.index');
        return view('cliente/edit', compact('cliente'));

    }
}
