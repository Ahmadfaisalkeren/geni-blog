<?php

namespace App\Http\Controllers\API;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Services\HeroService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hero\HeroStoreRequest;
use App\Http\Requests\Hero\HeroUpdateRequest;

class HeroController extends Controller
{
    protected $heroService;

    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
    }

    public function index()
    {
        $heroes = $this->heroService->getHeroes();

        return response()->json([
            'message' => 'Blas Raono Data',
            'heroes' => $heroes,
        ]);
    }

    public function store(HeroStoreRequest $request)
    {
        $this->heroService->storeHero($request->validated());

        return response()->json(
            [
                'status' => 200,
                'message' => 'Hero Created Successfully',
            ],
            200,
        );
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);

        return response()->json(
            [
                'hero' => $hero,
                'status' => 200,
                'message' => 'Hero Fetched Successfully',
            ],
            200,
        );
    }

    public function update(HeroUpdateRequest $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $this->heroService->updateHero($hero, $request->validated());

        return response()->json(
            [
                'message' => 'Hero Updated Successfully',
                'status' => 200,
                'hero' => $hero,
            ],
            200,
        );
    }

    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $this->heroService->deleteHero($hero);

        return response()->json(
            [
                'status' => 200,
                'message' => 'Hero Deleted Successfully',
            ],
            200,
        );
    }
}
