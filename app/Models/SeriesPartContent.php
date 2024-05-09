<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesPartContent extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];
    protected $table = "series_part_contents";
    protected $fillable = [
        'series_part_id',
        'type',
        'content',
    ];

    public function seriesPart()
    {
        return $this->belongsTo(SeriesPart::class, 'series_part_id', 'id');
    }
}
