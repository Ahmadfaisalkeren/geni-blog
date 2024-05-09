<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SeriesPartContentsService;
use App\Http\Requests\SeriesPartContents\SeriesPartContentsStoreRequest;
use App\Http\Requests\SeriesPartContents\SeriesPartContentsUpdateRequest;

class SeriesPartContentsController extends Controller
{
    protected $seriesPartContentsService;

    public function __construct(SeriesPartContentsService $seriesPartContentsService)
    {
        $this->seriesPartContentsService = $seriesPartContentsService;
    }

    public function index($seriesPartId)
    {
        $seriesPartContents = $this->seriesPartContentsService->getSeriesPartContents($seriesPartId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part Contents Fetched Successfully",
            'seriesPartContents' => $seriesPartContents,
        ], 200);
    }

    public function store(string $seriesPartId, SeriesPartContentsStoreRequest $request)
    {
        $seriesPartContents = $this->seriesPartContentsService->storeSeriesPartContents($seriesPartId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Part Contents Stored Successfully",
            'seriesPartContents' => $seriesPartContents,
        ], 200);
    }

    public function edit($seriesPartId)
    {
        $seriesPartContents = $this->seriesPartContentsService->getSeriesPartContentsById($seriesPartId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part Contents By Id Fetched Successfully",
            'seriesPartContents' => $seriesPartContents,
        ], 200);
    }

    public function update(string $seriesPartContentsId, SeriesPartContentsUpdateRequest $request)
    {
        $seriesPartContents = $this->seriesPartContentsService->updateSeriesPartContents($seriesPartContentsId, $request->validated());

        return response()->json([
            'status' => 200,
            'message' => "Series Part Contents Updated Successfully",
            'seriesPartContents' => $seriesPartContents,
        ], 200);
    }

    public function destroy($seriesPartId)
    {
        $this->seriesPartContentsService->deleteSeriesPartContents($seriesPartId);

        return response()->json([
            'status' => 200,
            'message' => "Series Part Contents Deleted Successfully",
        ], 200);
    }
}
