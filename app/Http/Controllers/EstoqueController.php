<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\EventosEstoque;
use App\Models\Fornecedor;
use App\Models\Produtos;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Estoque::query()
            ->join('produtos', 'estoque.id_produto', '=', 'produtos.id')
            ->join('fornecedors', 'produtos.id_fornecedor', '=', 'fornecedors.id')
            ->select('estoque.*', 'fornecedors.nome as nome_fornecedor', 'produtos.nome as nome_produto', 'produtos.cod_produto as cod_produto', 'produtos.status as status', 'produtos.id as id_produto');

        // Filtrar produtos com status 0 (ativo)
        $produtos = Produtos::where('status', 0)->get();

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where(function ($query) use ($busca) {
                $query->where('produtos.nome', 'like', '%' . $busca . '%')
                    ->orWhere('fornecedors.nome', 'like', '%' . $busca . '%')
                    ->orWhere('produtos.cod_produto', 'like', '%' . $busca . '%');
            });
        }

        $estoque = $query->get();
//        dd($produtos);
        return view('estoque/estoque', compact('produtos', 'estoque'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produto' => 'required',
            'qtd' => 'required',
        ]);
        if(!$produto = Produtos::find($request->get('id_produto')))
            return redirect()->route('estoque.index');
        if(!$estoque = Estoque::where('id_produto', $request->get('id_produto'))->first()) {
            $data = $request->all();
            $data['id_fornecedor'] = $produto->id_fornecedor;
            $novoEstoque = Estoque::create($data);

            $eventoEstoque['id_estoque'] = $novoEstoque->id;
            $eventoEstoque['qtd'] = $request->qtd;
            $eventoEstoque['tipo'] = 'Entrada';
            EventosEstoque::create($eventoEstoque);

            return redirect(route('estoque.index', absolute: false));
        }if($estoque){
            $data = $request->all();
            $qtd = (int)$request->qtd;
            $qtd_etq = $estoque->qtd;
            $total = $qtd + $qtd_etq;
            $data['qtd']=$total;
            $estoque->update($data);

            $eventoEstoque['id_estoque'] = $estoque->id;
            $eventoEstoque['qtd'] = $request->qtd;
            $eventoEstoque['tipo'] = 'Entrada';
            EventosEstoque::create($eventoEstoque);
            return redirect()->route('estoque.index');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!($estoqueEvento = EventosEstoque::where('id_estoque', $id)->first())) {
            return redirect()->route('estoque.index');
        }
        $estoqueEventos = EventosEstoque::where('id_estoque', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('estoque/details', compact('estoqueEventos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!$estoque = Estoque::find($id))
            return redirect()->route('estoque.index');
        $data = $request->all();
        $estoque->update($data);
        return redirect()->route('estoque.index');
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMenos(Request $request)
    {
        $request->validate([
            'id_produto' => 'required',
            'qtd' => 'required',
        ]);
        if(!$produto = Produtos::find($request->get('id_produto')))
            return redirect()->route('estoque.index');
        if(!$estoque = Estoque::where('id_produto', $request->get('id_produto'))->first()) {
            $data = $request->all();
            $data['id_fornecedor'] = $produto->id_fornecedor;
            $novoEstoque = Estoque::create($data);

            $eventoEstoque['id_estoque'] = $novoEstoque->id;
            $eventoEstoque['qtd'] = $request->qtd;
            $eventoEstoque['tipo'] = 'Saída';
            EventosEstoque::create($eventoEstoque);

            return redirect(route('estoque.index', absolute: false));
        }if($estoque){
        $data = $request->all();
        $qtd = (int)$request->qtd;
        $qtd_etq = $estoque->qtd;
        $total = $qtd_etq - $qtd;
        $data['qtd']=$total;
        $estoque->update($data);

        $eventoEstoque['id_estoque'] = $estoque->id;
        $eventoEstoque['qtd'] = $request->qtd;
        $eventoEstoque['tipo'] = 'Saída';
        EventosEstoque::create($eventoEstoque);

        return redirect()->route('estoque.index');
    }


    }
}
