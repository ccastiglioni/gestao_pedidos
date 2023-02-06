<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
     
    protected $fillable = ['nome','cliente_id'];

    public function Produto_n_pedidos()
    {
        return $this->belongsToMany('App\ProdutoModel', 'pedidos_produtos','pedido_id','produto_id')->withPivot('created_at'); //
    }
}
