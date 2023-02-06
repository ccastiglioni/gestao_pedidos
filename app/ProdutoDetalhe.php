<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;

    protected $fillable = [
                "produto_id",
                "unidade_id",
                "comprimento",
                "largura",
                "altura",
    ];


    public function produto_belongsTo()
    {
       
        return $this->belongsTo('App\ProdutoModel', 'produto_id', 'id');
        // SQL SELECT * from `produtos` where `produtos`.`id` = 2 limit 1   
        
        //return $this->hasOne('App\ProdutoModel','id','produto_id' );  // isso também funciona! 
    }

}
