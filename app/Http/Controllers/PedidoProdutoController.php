<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\PedidoProduto;
use App\ProdutoModel;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $obProd =  ProdutoModel::all();
        $pedido->Produto_n_pedidos; // EAGER loading
       return  view('app.pedido_produto.create',['pedido' => $pedido,'produtos' => $obProd]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Pedido $pedido)
    {
        $regras = [
            'produto_id' =>'exists:produtos,id',
            'quantidade' =>'required'
       ];

       $feedbacksregras =[
            'produto_id.exists' =>'Desculpe,O produto deve ser informado!',
            'required'        =>'Desculpe,A ::Attribute deve ser informado'
        ];

        $request->validate($regras,$feedbacksregras);
        
        /* ESSE É UM JEITO DE FAZER!
        $obped_prod = new PedidoProduto();
        $obped_prod->pedido_id      = $pedido->id;
        $obped_prod->quatidade      = $request->get('produto_id');
        $obped_prod->produto_id     = $request->get('produto_id');
        $obped_prod->save();
        */

        /* ESSE É OUTRO JEITO DE FAZER! */
        $pedido->Produto_n_pedidos()->attach(
            $request->get('produto_id'),
            ['quantidade' => $request->get('quantidade')]
        );

        return redirect()->route('pedido-produto.create',['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
