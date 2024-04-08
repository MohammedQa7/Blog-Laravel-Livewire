<?php

namespace App\Models;

use App\Livewire\PostLists;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\NoCodeCoverageDriverWithPathCoverageSupportAvailableException;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'slug',
        'content',
        'published_at',
        'featured',
    ];
    protected $casts = [
        'published_at' => 'datetime',
    ];


    // releationships
    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'post_like');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }


    // scopes
    public function scopePublished($query)
    {
        $query->where('published_at' , '<=' , Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured',true);
    }

    public function scopeSearch($query , $searchQ)
    {
        $query->where('title' , 'like' , "%{$searchQ}%");
    }

    public function scopeByCategory($query , $category_slug)
    {
        sleep(1);
        $query->whereHas('categories' , function($query) use ($category_slug){
                return $query->where('slug' , $category_slug);
        });
    }


    public function scopegetExcerpt()
    {
        // we will use "strip_tags()" because when we get the content it will be in an html format
        return Str::limit(strip_tags($this->content), 100);   
    }

    public function getThumbnailImage()
    {
        // making sure that the image is URL
         $is_image_url = str_contains($this->image , 'http');

         if($is_image_url){
            return $this->image;
         }else{
             return Storage::disk('public')->url($this->image);
         }
    }
    
}
