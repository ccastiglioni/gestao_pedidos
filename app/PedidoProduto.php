<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    use HasFactory;

    protected $table = 'pedidos_produtos';

    protected $fillable = [ 
        'pedido_id',
        'produto_id',
        'quantidade'
    ];

}
