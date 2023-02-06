<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use Illuminate\Support\Facades\DB;


class FornecedorController extends Controller
{
    public function index() {
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '0',
                'ddd' => '', //São Paulo (SP)
                'telefone' => '0000-0000'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '85', //Fortaleza (CE)
                'telefone' => '0000-0000'
            ],
            2 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '32', //Juiz de fora (MG)
                'telefone' => '0000-0000'
            ]
        ];
        

        return view('app.fornecedor.index', compact('fornecedores'));
    }
    
    

    public function listar(Request $request)
    {
        $objFornec = Fornecedor::where('nome','like', '%'. $request->input('nome') .'%')
        ->where('site','like', '%'. $request->input('site') .'%')
        ->where('uf','like', '%'. $request->input('uf') .'%')
        ->where('email','like', '%'. $request->input('email') .'%')
        ->get();
    
        //dd($objFornec);

        return view('app.fornecedor.listar',['fornecedores'=>$objFornec]);
    }

    public function adicionar(Request $request)
    {   
        $msg =''; 
        $btnlabel ="Atualizar";

        if ( $request->input('id') =='' ) {
            $btnlabel ="Cadastrar";
            if ($request->input('create') =='1') {

                $regras = [
                    'nome' => 'required|min:3|max:90',
                    'site' => 'required',
                    'uf' => 'required|max:2',
                    'email' => 'required|email',
                ];

                $mensagem_erro = [
                    'require' => 'O campo :attribute de ser preenchido',
                    'nome.min' => 'O Campo nome deve ter no mínimo 3 Caracteres!',
                    'nome.max' => 'O Campo nome deve ter no maximo 90 Caracteres!',
                    'uf.max' => 'O Campo nome deve ter no Máximo 2 Caracteres!',
                    'email.email' => 'O Campo email nao foi digitado segundo modelo de um email Valido!',
                ];

                $request->validate($regras,$mensagem_erro);
                $objFornec = new Fornecedor();
                $objFornec->create($request->all());    
                $msg = 'Fornecedor Cadastrado com Sucesso (create) !!';  
            }

            if ($request->input('DB') =='1') {
                DB::table('fornecedores')->insert([
                    ['nome' =>$request->input('nome'), 
                    'site'  =>$request->input('site'), 
                    'uf'    =>$request->input('uf'), 
                    'email' =>$request->input('email'),
                    'created_at' =>date('Y-m-d H:i:s')]
                ]);
                $msg = 'Fornecedor Cadastrado com Sucesso (DB) !!';  
            }

            if ($request->input('save') =='1') {
                $Objforn = new Fornecedor() ; 
                $Objforn->nome = $request['nome'];
                $Objforn->site = $request['email'];
                $Objforn->uf = $request['uf'];
                $Objforn->email = $request['email'];
                $Objforn->created_at = date('Y-m-d H:i:s');
                $query = $Objforn->save();
                $msg = 'Fornecedor Cadastrado com Sucesso (create) !!';      
            }
        }else{
              $btnlabel   ="Atualizar";
              $fornecedor = Fornecedor::find( $request->input('id') );  
               
              $status_update = $fornecedor->update( $request->all() );

              if ($status_update ) {
                $msg = 'Fornecedor Atualizado com Sucesso!!'; 
                return redirect()->route('app.fornecedor.listar');
                die;
              }
        }
        
        $data = [
            'msg'=>$msg,
            'btnlabel'=>$btnlabel
        ];
        return view('app.fornecedor.adicionar', ["data" =>$data]);
    }

    public function editar($id)
    {
        $fornecedores = Fornecedor::find($id);
        return view('app.fornecedor.adicionar',['fornecedor' => $fornecedores,'data'=> ['btnlabel'=>'Atualizar']] );
    }

    public function excluir($id)
    {
        //$fornecedores = Fornecedor::find($id)->delete();
        $fornecedores = Fornecedor::find($id)->forceDelete();
        //OBS se for usando o SoftDeletes a funcao pra deletar PERMANENTE do banco é : forceDelete

        return redirect()->route('app.fornecedor.listar'); 
    }
}




