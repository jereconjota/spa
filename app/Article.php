<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //Atributos que queramos generarlos a traves de la instancia del objeto 
    protected $fillable = ['title', 'content', 'thumbnail', 'user_id'];
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

}
