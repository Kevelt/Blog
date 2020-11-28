<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Scope;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'price', 'description', 'image_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    public function userName()
    {
        return $this->belongsTo( 'App\Models\User', 'user_id');
    }

    public function getDescription()
    {
        return new HtmlString($this->description);
    }

    public function scopePopular($query)
    {
        return $query->where('votes', '>', 100);
    }
}
