<?php

namespace App\Services;

use App\Models\SeriesPart;

/**
 * Class SeriesPartService.
 */
class SeriesPartService
{
    public function getSeriesPartBySeriesId($seriesId)
    {
        $seriesPart = SeriesPart::where('series_id', $seriesId)->orderBy('created_at', 'asc')->get();

        return $seriesPart;
    }

    public function storeSeriesPart(array $seriesPartData)
    {
        $seriesPart = SeriesPart::create($seriesPartData);

        return $seriesPart;
    }

    public function getSeriesPartById($seriesPartId)
    {
        $seriesPart = SeriesPart::findOrFail($seriesPartId);

        return $seriesPart;
    }

    public function updateSeriesPart(string $seriesPartId, array $seriesPartData)
    {

        $seriesPart = SeriesPart::findOrFail($seriesPartId);

        $seriesPart->update($seriesPartData);

        return $seriesPart;
    }

    public function deleteSeriesPart(string $seriesPartId)
    {
        $seriesPart = SeriesPart::findOrFail($seriesPartId);

        $seriesPart->delete();
    }
}
