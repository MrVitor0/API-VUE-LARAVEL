<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    //setup fields
    protected $fillable = [
        'desname',
        'desprice',
    ];
  
    protected $casts = [
        'desname' => 'string',
        'desprice' => 'string',
    ];
}
