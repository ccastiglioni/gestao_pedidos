<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoModel extends Model
{
    use HasFactory;
    
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    

    protected  $fillable = [
            'nome',
            'unidade_id',
            'fornecedor_id',
            'descricao',
            'peso',
            'created_at',
            'updated_at',
    ];


    public function produtoDetalhe_hasOne()
    {
        return $this->hasOne('App\ProdutoDetalhe','produto_id' ); //Aqui ele ja sabe que tem uma tabela produto_detalhes e consege relacionar os IDs
    }

    public function fornecedor_pertenc_um_produto()
    { 
        return $this->belongsTo('App\Fornecedor','fornecedor_id'); //Aqui ele ja sabe que tem uma tabela produto_detalhes e consege relacionar os IDs
    }
}
