<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fornecedor::query();

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('nome', 'like', '%' . $busca . '%');
        }

        $fornecedors = $query->get();
        return view('produto/fornecedor', compact('fornecedors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        Fornecedor::create($request->all());
        return redirect(route('fornecedor.index', absolute: false));

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
        if(!$fornecedor = Fornecedor::find($id))
            return redirect()->route('fornecedor.index');
        $data = $request->all();
        $fornecedor->update($data);
        return redirect()->route('fornecedor.index');
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
        if(!$fornecedor = Fornecedor::find($id))
            return redirect()->route('fornecedor.index');
        return view('produto/edit-fornecedor', compact('fornecedor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function delete(string $id)
    {
        if(!$fornecedor = Fornecedor::find($id))
            return redirect()->route('fornecedor.index');
        $fornecedor->status = 1;
        $fornecedor->save();
        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }
}
