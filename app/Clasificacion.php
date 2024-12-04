<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'nom_clasificacion', 'slug'];
    protected $table = 'clasificaciones';

    public function getRouteKeyName()
    {
        return "slug";
    }
}
