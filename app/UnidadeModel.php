<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeModel extends Model
{
    use HasFactory;
    protected $table = 'unidades';
    protected $fillable = ['unidade', 'descricao'];

}
