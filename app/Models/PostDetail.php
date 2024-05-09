<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];
    protected $table = 'post_details';
    protected $fillable = [
        'post_id',
        'type',
        'content',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
