<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable =['title','slug','description','image','user_id'];

    protected $hidden =['key'];

    protected static function booted()
    {
        static::creating(function(Book $book){
            $book->slug=Str::slug($book->title);
            $book->key=md5($book->slug);
        });
    }

    public function scopePublished(Builder $query){
        $query->whereNotNull('published_at');
    }

    public function user(){
        return $this->belongsTo(User::class);
     }
}
