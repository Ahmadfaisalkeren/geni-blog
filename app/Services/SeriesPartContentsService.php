<?php

namespace App\Services;

use App\Models\SeriesPart;
use App\Models\SeriesPartContent;
use Illuminate\Support\Facades\Storage;

/**
 * Class SeriesPartContentsService.
 */
class SeriesPartContentsService
{
    public function getSeriesPartContents($seriesPartId)
    {
        $seriesPartContents = SeriesPartContent::with('seriesPart')->with('seriesPart.series')->where('series_part_id', $seriesPartId)->orderBy('created_at', 'asc')->get();

        return $seriesPartContents;
    }

    public function storeSeriesPartContents(string $seriesPartId, array $seriesPartData)
    {
        $seriesPart = SeriesPart::findOrFail($seriesPartId);

        if (isset($seriesPartData['type']) && $seriesPartData['type'] === 'image') {
            $imagePath = $this->storeImage($seriesPartData['content']);
            $seriesPartData['content'] = $imagePath;
        }

        $seriesPartContents = new SeriesPartContent($seriesPartData);
        $seriesPart->seriesPartContents()->save($seriesPartContents);

        return $seriesPartContents;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientoriginalExtension();
        $imagePath = $image->storeAs('images/seriespartcontents', $imageName, 'public');

        return $imagePath;
    }

    public function getSeriesPartContentsById($SeriesPartContentsId)
    {
        $seriesPartContents = SeriesPartContent::findOrFail($SeriesPartContentsId);

        return $seriesPartContents;
    }

    public function updateSeriesPartContents(string $seriesPartContentsId, array $seriesPartData)
    {

        $seriesPartContents = SeriesPartContent::findOrFail($seriesPartContentsId);

        if (isset($seriesPartContents['content']) && $seriesPartContents['type'] === "image") {
            $this->updateImageSeriesPartContents($seriesPartContents, $seriesPartData['content']);
        } else {
            $seriesPartContents->update($seriesPartData);
        }

        return $seriesPartContents;
    }

    private function updateImageSeriesPartContents(SeriesPartContent $seriesPartContents, $content)
    {
        $imageName = time() . '.' . $content->getClientOriginalExtension();
        $imagePath = $content->storeAs('public/images/seriespartcontents', $imageName);

        if ($seriesPartContents->content) {
            Storage::delete('public/' . $seriesPartContents->content);
        }

        $seriesPartContents->content = str_replace('public/', '', $imagePath);
        $seriesPartContents->save();
    }

    public function deleteSeriesPartContents(string $SeriesPartContentsId)
    {
        $seriesPartContents = SeriesPartContent::findOrFail($SeriesPartContentsId);

        $seriesPartContents->delete();
    }
}
