<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    //
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];


    public function fornecedor_tem_muitosProdutos()
    { 
        return $this->hasMany('App\ProdutoModel','fornecedor_id','id'); //Aqui ele ja sabe que tem uma tabela produto_detalhes e consege relacionar os IDs
    }

}
