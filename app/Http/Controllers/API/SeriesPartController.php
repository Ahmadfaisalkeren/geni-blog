<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\SeriesPartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesPart\SeriesPartStoreRequest;
use App\Http\Requests\SeriesPart\SeriesPartUpdateRequest;

class SeriesPartController extends Controller
{
    protected $seriesPartService;

    public function __construct(SeriesPartService $seriesPartService)
    {
        $this->seriesPartService = $seriesPartService;
    }

    public function index($seriesId)
    {
        $seriesPart = $this->seriesPartService->getSeriesPartBySeriesId($seriesId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part Fetched Successfully",
            'seriesPart' => $seriesPart,
        ], 200);
    }

    public function store(SeriesPartStoreRequest $request)
    {
        $seriesPart = $this->seriesPartService->storeSeriesPart($request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Part Stored Successfully",
            'seriesPart' => $seriesPart,
        ], 200);
    }

    public function edit($seriesPartId)
    {
        $seriesPart = $this->seriesPartService->getSeriesPartById($seriesPartId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part By Id Fetched Successfully",
            'seriesPart' => $seriesPart,
        ], 200);
    }

    public function update(SeriesPartUpdateRequest $request, $seriesPartId)
    {
        $seriesPart = $this->seriesPartService->updateSeriesPart($seriesPartId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Part Updated Successfully",
            'seriesPart' => $seriesPart,
        ], 200);
    }

    public function destroy($seriesPartId)
    {
        $this->seriesPartService->deleteSeriesPart($seriesPartId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part Deleted Successfully",
        ], 200);
    }
}
