<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Series\SeriesStoreRequest;
use App\Http\Requests\Series\SeriesUpdateRequest;
use App\Services\SeriesService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    protected $seriesService;

    public function __construct(SeriesService $seriesService)
    {
        $this->seriesService = $seriesService;
    }

    public function index()
    {
        $series = $this->seriesService->getSeries();

        return response()->json([
            'status' => 200,
            'message' => "Series Fetched Successfully",
            'series' => $series,
        ], 200);
    }

    public function publishedSeries()
    {
        $publishedSeries = $this->seriesService->getPublishedSeries();

        return response()->json([
            'status' => 200,
            'message' => "Series Fetched Successfully",
            'publishedSeries' => $publishedSeries,
        ], 200);
    }

    public function store(SeriesStoreRequest $request)
    {
        $series = $this->seriesService->storeSeries($request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Stored Successfully",
            'series' => $series,
        ], 200);
    }

    public function edit($seriesId)
    {
        $series = $this->seriesService->getSeriesById($seriesId);

        return response()->json([
            'status' => 200,
            'message' => "Series By Id Fetched Successfully",
            'series' => $series,
        ], 200);
    }

    public function update(SeriesUpdateRequest $request, $seriesId)
    {
        $series = $this->seriesService->updateSeries($seriesId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Updated Successfully",
            'series' => $series,
        ], 200);
    }

    public function destroy($seriesId)
    {
        $this->seriesService->deleteSeries($seriesId);

        return response()->json([
            'status' => 200,
            'message' => "Series Deleted Successfully",
        ], 200);
    }
}
