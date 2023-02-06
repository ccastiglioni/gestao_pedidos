<?php

namespace App\Http\Controllers;

use App\ProdutoDetalhe;
use Illuminate\Http\Request;
use App\UnidadeModel;
use Illuminate\Support\Facades\Redirect;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "met INDEX";
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $unidade = UnidadeModel::all();

        return view('app.produto_detalhe.create', ['unidades'=>$unidade]);
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          ProdutoDetalhe::create($request->all());
     
          return redirect()->route('produto.index', ['msg' => 'Produto Inserido com Sucesso!']); 

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
    public function edit(ProdutoDetalhe $produtoDetalhe )
    {
        $unidade = UnidadeModel::all();

        return view('app.produto_detalhe.edit', ['produto_detalhe'=>$produtoDetalhe,"unidades"=>$unidade] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ProdutoDetalhe $produto)
    {
      $produto->update($request->all());
        die("Atualiado!");
     //return redirect()->route("produto.show",['produto'=>$produto->id ]);
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
