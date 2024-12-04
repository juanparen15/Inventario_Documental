<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acto extends Model
{
  public $incrementing = false;
  protected $fillable = ['id', 'clasificacion', 'fechaActo', 'pdf', 'asunto', 'slug'];

  public function getRouteKeyName()
  {
    return "slug";
  }

  //Relacion Uno a Muchos
  public function planadquisiciones()
  {
    return $this->hasMany(Planadquisicione::class);
  }

  //Relacion Uno a Muchos (Inversa)
  public function clasificacion()
  {
    return $this->belongsTo(Clasificacion::class);
  }
}
