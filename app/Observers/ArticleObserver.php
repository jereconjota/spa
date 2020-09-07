<?php

namespace App\Observers;
use Illuminate\Support\Str;
use App\Article;

class ArticleObserver
{
    public function saving($article){ //se ejecuta antes de almacenar un objeto de nuestra base de datos
        //aca vamos a generar un slug para cada objeto creado

        $slug = Str::slug($article->title,'-');

        if (Article::where('slug',$slug)->exists()) {
            $slug = $slug . uniqid();
        }

        $article->slug = $slug; 
    }
}