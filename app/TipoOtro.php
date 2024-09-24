<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOtro extends Model
{
    protected $table = 'tipo_otro';
    protected $fillable= ['id','tipo','slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    //Relacion Uno a Muchos
    public function planadquisiciones()
    {
        return $this->hasMany(Planadquisicione::class);
    }
}
