<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesPart extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];
    protected $table = "series_parts";
    protected $fillable = [
        'series_id',
        'part_number',
        'title',
    ];

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id', 'id');
    }

    public function seriesPartContents()
    {
        return $this->hasMany(SeriesPartContent::class, 'series_part_id', 'id');
    }
}
