<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    //setup fields
    protected $fillable = [
        'desname',
        'desnumero',
        'desdocument',
        'desemail',
        'dtbirth',
        'desbairro',
        'descep',
        'descidade',
        'descomplemento',
        'deslogradouro',
    ];
    protected $casts = [
        'desname' => 'string',
        'desnumero' => 'string',
        'desdocument' => 'string',
        'desemail' => 'string',
        'dtbirth' => 'date',
        'desbairro' => 'string',
        'descep' => 'string',
        'descidade' => 'string',
        'descomplemento' => 'string',
        'deslogradouro' => 'string',
    ];
}
