<?php

namespace App\Models;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;

class Commantaire extends Model
{
    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class);
}

    
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
