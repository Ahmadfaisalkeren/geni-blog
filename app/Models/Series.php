<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];
    protected $table = "series";
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
        'status',
        'series_date',
    ];

    public function seriesPart()
    {
        return $this->hasMany(SeriesPart::class, 'series_id', 'id');
    }
}
