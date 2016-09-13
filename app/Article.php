<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*
    /-------------------------------------------
    / Allows for mass assignment of given fields
    /-------------------------------------------
    */
    protected $fillable = [
      'title',
      'body',
      'published_at',
      'user_id'
    ];

    protected $dates = ['published_at'];

    //convention set{attr_name}Attribute
    public function setPublishedAtAttribute($date){
      $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date); // Happens each time published_at is set
    }

    //convention for scope selector scope{scope_name}
    public function scopePublished($query){
      $query->where('published_at', '<=', Carbon::now()); // Article::published();
    }

    public function scopeUnpublished($query){
      $query->where('published_at', '>', Carbon::now());
    }

    /**
    * An article is owned by a user.
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(){
      return $this->belongsTo('App\User');
    }

    /**
    * Get the tags associated with the given article.
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function tags(){
      return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
    * Get a list of tag ids associated with the current article.
    * @return array
    */
    public function getTagListAttribute(){
      return $this->tags->lists('id')->all();
    }
}
