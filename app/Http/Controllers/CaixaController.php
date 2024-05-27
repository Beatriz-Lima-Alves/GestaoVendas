<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\EventosEstoque;
use App\Models\Sequencia;
use App\Models\Cliente;
use App\Models\Produtos;
use App\Models\TotalVendas;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaixaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('caixa/caixa', ['msg'=>'']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function startSale(Request $request)
    {
        if(!$cliente = Cliente::where('cpf', $request->get('cpf'))->first()) {
            return view('caixa/caixa', ['msg'=>'CPF do cliente não encontrado']);
        }
        $itens = Venda::join('produtos', 'produtos.id', '=', 'venda.id_produto')
            ->select('venda.*', 'produtos.nome as nome')
            ->where('id_cliente', $cliente->id)
            ->where('sequence', 0)
            ->get();

        $total = Venda::where('id_cliente', $cliente->id)
            ->where('sequence', 0)
            ->sum('valor_total');

        return view('caixa/form', compact('cliente','itens', 'total'));
    }

    /**
     * Display a listing of the resource.
     */
    public function addItens(Request $request, $id)
    {
        $cliente = Cliente::where('id', $id)->first();
        if(!$produto = Produtos::where('cod_produto', $request->get('cod_produto'))->first()) {
            $itens = Venda::where('id_cliente', $id)
                ->where('sequence', 0)
                ->get();
            return view('caixa/form', ['msg'=>'Código do produto não encontrado', 'cliente'=>$cliente, 'itens'=>$itens]);
        }

        $data = $request->all();
        $data['sequence'] = 0;
        $data['id_cliente'] = $id;
        $data['id_funcionario'] = Auth::id();
        $data['id_produto'] = $produto->id;
        $data['valor_unidade'] = $produto->preco;
        $data['valor_total'] = $produto->preco * $data['qtd'];

        Venda::create($data);


        $itens = Venda::join('produtos', 'produtos.id', '=', 'venda.id_produto')
                        ->select('venda.*', 'produtos.nome as nome')
                        ->where('id_cliente', $id)
                        ->where('sequence', 0)
                        ->get();

        $total = Venda::where('id_cliente', $cliente->id)
            ->where('sequence', 0)
            ->sum('valor_total');

        return redirect()->route('caixa.sale', ['itens' => $itens, 'cliente' => $cliente, 'total' => $total, 'cpf'=>$cliente->cpf]);

//        return view('/caixa/form', compact('itens', 'cliente', 'total'));
    }

    /**
     * Display a listing of the resource.
     */
    public function finalizeSale(Request $request)
    {
        $sequences = Sequencia::get()->first();
        $sequence = $sequences['sequence'] + 1;

        $total = Venda::where('id_cliente', $request->cliente_id)
            ->where('sequence', 0)
            ->sum('valor_total');

        $data['sequence_venda'] = $sequence;
        $data['total_venda'] = $total;
        $data['tipo_pagamento'] = $request->tipo_pagamento;

        TotalVendas::create($data);

        Venda::where('id_cliente', $request->cliente_id)
            ->where('sequence', 0)
            ->update(['sequence' => $sequence]);

        Sequencia::get()
            ->first()
            ->update(['sequence' => $sequence]);

        $itens = Venda::where('id_cliente', $request->cliente_id)
            ->where('sequence', $sequence)
            ->get();

        Foreach ($itens as $item) {
        // Chama a função para subtrair a quantidade vendida do estoque
            $this->subtractFromStock($item->id_produto, $item->qtd);
        }

        return redirect()->route('caixa.index');
    }

    public function subtractFromStock($productId, $quantitySold)
    {
        $estoque = Estoque::where('id_produto', $productId)->first();
        if ($estoque) {
            $estoque->qtd -= $quantitySold;
            $estoque->save();
            $eventoEstoque['id_estoque'] = $estoque->id;
            $eventoEstoque['qtd'] = $quantitySold;
            $eventoEstoque['tipo'] = 'Saída';
            EventosEstoque::create($eventoEstoque);
        }
    }

    public function canceledSale(Request $request)
    {
        Venda::where('id_cliente', $request->cliente_id)
            ->where('sequence', 0)
            ->delete();

        return redirect()->route('caixa.index');
    }

}
