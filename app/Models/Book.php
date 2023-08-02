<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable =['title','slug','description','image','user_id','published_at'];

    protected $hidden =['key'];

    protected static function booted()
    {
        static::creating(function(Book $book){
            $book->slug=Str::slug($book->title);
//********************  Bad Practise********************************
//            $book->key=md5($book->slug);
//            $book->key=md5(time());
//            $book->key=uniqid("slug",true);
//********************Good Practise********************************
            //secure random function to generate cryptographically unique keys
            $book->key=Str::random(40);

        });
    }
    public function scopeSearch(Builder $query, $search=null){
        $query->when($search, function ($query, $searchTerm) {
//************Bad Practise*************************
//            return $query->whereRaw("slug LIKE '%{$searchTerm}%'");
//************Good Practise two solution***********
//            return $query->whereRaw('slug LIKE ?', ['%' . $searchTerm . '%']);
            return $query->where("slug" ,"LIKE", '%' . $searchTerm . '%');
        });
    }

    public function scopePublished(Builder $query){
        $query->whereNotNull('published_at');
    }

    public function user(){
        return $this->belongsTo(User::class);
     }
     public function getRouteKeyName()
     {
         return 'slug';
     }
     public function escapeDescription():Attribute
     {
         //escape description value in markdown
         return Attribute::get(
             fn()=>Str::of($this->description)->markdown([
                 'html_input'=>'escape',
                 'allow_unsafe_links'=>false,
                 'max_nesting_level'=>5,
             ])->toHtmlString()
         );

         //escape values before operations , then operate on them, then return as html string
//         return Attribute::get(fn()=> new HtmlString(nl2br(e($this->description))));

     }
}
