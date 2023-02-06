<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use App\ProdutoModel;
use App\UnidadeModel;
 
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $objUni = UnidadeModel::get();
        
       /*
        foreach($produtos as $key => $produto) {
            //print_r($produto->getAttributes());
    
            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
            //collection ProdutoDetalhe
            //ProdutoDetalhe
            if(isset($produtoDetalhe)) {
                //print_r($produtoDetalhe->getAttributes());
                
                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
        }
        */

        $objProd = ProdutoModel::paginate(10);
        //$objProd = ProdutoModel::with(['produtoDetalhe_hasOne'])->paginate(10); // Pode-se usar o relacionamento no with tmb

        return view('app.produto.index',['produtos'=>$objProd, 'request'=>$request->all(), 'unidades'=>$objUni ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objUni = UnidadeModel::get(); //OU $objUni = UnidadeModel::all();
        $fornecedores = Fornecedor::all();
        return view("app.produto.create",['unidades'=>$objUni,'fornecedores'=>  $fornecedores  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $regras = [
            'nome' =>'required|min:2',
            'descricao' =>'required',
            'peso' =>'required|integer',
            'unidade_id' =>'exists:unidades,id',
       ];

       $feedbacksregras =
        [
            'required' =>'Desculpe,O campo precisa ser preechido!',
            'nome.required' =>'Ops,Vc precisa informar um nome',
            'nome.min' =>'Desculpe,O nome de ter mais de 2 caracteres!',
            'peso.integer' =>'Desculpe,O Peso deve ser um numero Inteiro!',
            'unidades.existes' =>'Opa,A unidade de medida informada nao existe!',
            //'required' =>'Ops,Vc precisa informar um caractere para enviar', // Esse fica como default para todos Required
        ];

        $request->validate($regras,$feedbacksregras);

        $obprod = new ProdutoModel();
        $obprod->nome      = $request->get('nome');
        $obprod->peso      = $request->get('peso');
        $obprod->descricao = $request->get('descricao');
        $obprod->unidade_id = $request->get('unidade_id');
        $obprod->fornecedor_id = $request->get('fornecedor_id');
        $obprod->save();
        //OU: $objProd = ProdutoModel::create($request->all());
        
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProdutoModel $produto)
    {
        return view("app.produto.show",['produto'=>$produto ]);
        //dd($produto);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdutoModel $produto)
    {
        $unidade      = UnidadeModel::all();
        $fornecedores = Fornecedor::all();
    
        //return view("app.produto.edit",['produto'=>$produto,'unidades'=>$unidade ]);
        return view("app.produto.create",['produto'=>$produto,'unidades'=>$unidade, 'fornecedores' =>$fornecedores ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ProdutoModel $produto)
    {
      $produto->update($request->all());

     return redirect()->route("produto.show",['produto'=>$produto->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdutoModel $produto)
    {   
      
        $produto->delete(); //OU $objUni = UnidadeModel::all();
         
        return redirect()->route('produto.index', ['msg' => 'Produto deletado com Sucesso!']); 
    }
}
