<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'post_date',
        'author',
        'image',
        'status',
    ];

    public function post_details()
    {
        return $this->hasMany(PostDetail::class);
    }
}
