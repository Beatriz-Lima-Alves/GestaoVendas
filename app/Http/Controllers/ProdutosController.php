<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produtos::join('fornecedors', 'produtos.id_fornecedor', '=', 'fornecedors.id')
            ->select('produtos.*', 'fornecedors.nome as nome_fornecedor');

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('produtos.nome', 'like', '%' . $busca . '%');
            $query->orWhere('produtos.cod_produto', 'like', '%' . $busca . '%');
        }

        $produtos = $query->get();

        return view('produto/produto', compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:150',
            'cod_produto' => 'required',
            'categoria' => 'required',
            'id_fornecedor' => 'required',
            'preco' => 'required',
        ]);
        Produtos::create($request->all());
        return redirect(route('produto.index', absolute: false));

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
        if(!$produto = Produtos::find($id))
            return redirect()->route('produto.index');
        $request->validate([
            'nome' => 'required|max:150',
            'cod_produto' => 'required',
            'categoria' => 'required',
            'id_fornecedor' => 'required',
            'preco' => 'required',
        ]);
        $data = $request->all();
        $produto->update($data);
        return redirect()->route('produto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * NEW the specified resource from storage.
     */
    public function new()
    {
        $fornecedors = Fornecedor::where('status', 0)->get();
        return view('produto/form', compact('fornecedors'));
    }
    /**
     * Edit the specified resource from storage.
     */
    public function edit($id)
    {
        if(!$produto = Produtos::find($id))
            return redirect()->route('produto.index');
        $fornecedors = Fornecedor::where('status', 0)->get();
        return view('produto/edit-produto', compact('produto','fornecedors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete(string $id)
    {
        if(!$produto = Produtos::find($id))
            return redirect()->route('produto.index');
        $produto->status = 1;
        $produto->save();
        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }

    public function search(Request $request)
    {
        $codProduto = $request->input('cod_produto');

        // Faça a busca no banco de dados
        $produtos = Produtos::where('cod_produto', 'like', '%'.$codProduto.'%')
            ->orWhere('nome', 'like', '%'.$codProduto.'%')
            ->get();

        return response()->json($produtos);
    }

    public function getProdutos()
    {
        $produtos = Produtos::join('fornecedors', 'produtos.id_fornecedor', '=', 'fornecedors.id')
            ->select('produtos.*', 'fornecedors.nome as nome_fornecedor')
            ->get()->toJson(JSON_PRETTY_PRINT);
        return response($produtos, 200);
    }

}
