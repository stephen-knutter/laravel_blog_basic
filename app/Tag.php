<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  /*
  /-------------------------------------------
  / Allows for mass assignment of given fields
  /-------------------------------------------
  */
  protected $fillable = [
    'name'
  ];
  
  /**
  *Get the articles associated with the given tag.
  *
  *@return \Illuminate\Database\Eloquent\Relations\BelongsToMany
  */
  public function articles(){
    return $this->belongsToMany('App\Article');
  }

}
