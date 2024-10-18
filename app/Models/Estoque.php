<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque' ;

    protected $fillable = [
            'produto_id',
            'quantidade_disponivel'
    ];

    public function produto(){
        return $this->belongsTo(produtos::class,'produto_id');
    }
}
