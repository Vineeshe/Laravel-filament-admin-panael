<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'catagory_id',
        'thumbnail',
        'content',
        'tags',
        'published'


    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function catagory()
    {
        return $this->belongsTo(Catagories::class, 'catagory_id');
    }
}
