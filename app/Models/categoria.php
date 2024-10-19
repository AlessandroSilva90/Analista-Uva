<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';

    protected $fillable = [
        'name'
    ];

    public function categoria(){
        return $this->belongsTo(produtos::class,'id_categoria');
    }


}
