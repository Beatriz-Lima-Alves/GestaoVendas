<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produtos;
use App\Models\TotalVendas;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sequence = $request->input('busca');

        // Verifica se foi fornecida uma sequência na consulta
        if ($sequence) {
            // Filtra as vendas pela sequência fornecida
            $vendas = TotalVendas::where('sequence_venda', $sequence)->get();
        } else {
            // Caso não tenha sido fornecida uma sequência, retorna todas as vendas
            $vendas = TotalVendas::all();
        }
        return view('vendas/vendas', compact('vendas'));
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
        if (!($itensVendas = Venda::where('sequence', $id)->first())) {
            return redirect()->route('vendas.index');
        }
        $itensVendas = Venda::join('produtos', 'produtos.id', '=', 'venda.id_produto')
            ->join('clientes', 'clientes.id', '=', 'venda.id_cliente')
            ->select('venda.*', 'produtos.nome as nome_produto', 'clientes.nome as cliente_nome')
            ->where('sequence', $id)->get();

        $cliente = Venda::join('clientes', 'clientes.id', '=', 'venda.id_cliente')
            ->select('clientes.*', 'venda.sequence as sequence')
            ->where('sequence', $id)
            ->first();


        $total = Venda::where('sequence', $id)
            ->sum('valor_total');


        return view('vendas/details', compact('itensVendas', 'total', 'cliente'));
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

    public function productSalesChart()
    {
        // Obter todos os produtos
        $products = Produtos::all();

        // Inicializar arrays para produtos, quantidades em estoque e quantidades vendidas
        $productNames = [];
        $stockQuantities = [];
        $soldQuantities = [];

        // Iterar por cada produto
        foreach ($products as $product) {
            $productNames[] = $product->nome;

            // Quantidade em estoque do produto
            $stockQuantities[] = Estoque::where('id_produto', $product->id)
                ->sum('qtd');

            // Quantidade vendida do produto na última semana
            $soldQuantities[] = Venda::where('id_produto', $product->id)
                ->whereBetween('created_at', [now()->subDays(7), now()])
                ->sum('qtd');
        }

        // Obter os três produtos mais vendidos
        $topThreeProducts = Produtos::select('produtos.*', \DB::raw('SUM(venda.qtd) as total_sales'))
            ->leftJoin('venda', 'produtos.id', '=', 'venda.id_produto')
            ->groupBy('produtos.id')
            ->orderByDesc('total_sales')
            ->take(3)
            ->get();

        // Obter os top 3 produtos com mais quantidade em estoque
        $topThreeStockProducts = Estoque::select('id_produto', \DB::raw('SUM(qtd) as total_quantity'),'produtos.nome as nome_produtos')
            ->leftJoin('produtos', 'produtos.id', '=', 'estoque.id_produto')
            ->groupBy('id_produto')
            ->orderByDesc('total_quantity')
            ->take(3)
            ->get();

        // Renderizar o gráfico usando Charts.js
        return view('dashboard', [
            'productNames' => $productNames,
            'stockQuantities' => $stockQuantities,
            'soldQuantities' => $soldQuantities,
            'topThreeProducts' => $topThreeProducts,
            'topThreeStockProducts' => $topThreeStockProducts,
        ]);

    }
}
