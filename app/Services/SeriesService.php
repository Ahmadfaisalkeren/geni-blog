<?php

namespace App\Services;

use App\Models\Series;
use Illuminate\Support\Facades\Storage;

/**
 * Class SeriesService.
 */
class SeriesService
{
    public function getSeries()
    {
        $series = Series::orderBy('created_at', 'desc')->get();

        return $series;
    }

    public function getPublishedSeries()
    {
        $series = Series::with('seriesPart')->where('status', '=', 'publish')->orderBy('created_at', 'desc')->get();

        return $series;
    }

    public function storeSeries(array $seriesData)
    {
        if (isset($seriesData['image'])) {
            $seriesData['image'] = $this->storeImage($seriesData['image']);
        }

        $series = Series::create($seriesData);

        return $series;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/series', $imageName, 'public');

        return $imagePath;
    }

    public function getSeriesById($seriesId)
    {
        $series = Series::findOrFail($seriesId);

        return $series;
    }

    public function updateSeries(string $seriesId, array $seriesData)
    {

        $series = Series::findOrFail($seriesId);

        if (isset($seriesData['image'])) {
            $this->updateImage($series, $seriesData['image']);
        }

        $series->save();

        return $series;
    }

    private function updateImage(Series $series, $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images/series', $imageName);

        if ($series->image) {
            Storage::delete('public/' . $series->image);
        }

        $series->image = str_replace('public/', '', $imagePath);
    }

    public function deleteSeries(string $seriesId)
    {
        $series = Series::findOrFail($seriesId);

        $series->seriesPart()->each(function ($seriesPart) {
            $seriesPart->seriesPartContents()->delete();
        });
        $series->seriesPart()->delete();

        $this->deleteImage($series->image);

        $series->delete();
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath);
        }
    }
}
