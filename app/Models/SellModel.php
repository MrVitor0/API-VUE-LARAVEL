<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellModel extends Model
{
    use HasFactory;
    protected $table = 'sell';

    //make relationship with UserModel
    public function user(){
        return $this->belongsTo('App\Models\UserModel', 'idclient');
    }
    //setup fields
    protected $fillable = [
        'idclient',
        'desproducts'
    ];
    protected $casts = [
        'idclient' => 'string',
        'desproducts' => 'string'
    ];

}
