<?php

namespace App\Services;

use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

/**
 * Class HeroService.
 */
class HeroService
{
    public function getHeroes()
    {
        $heroes = Hero::orderby('id', 'desc')->get();

        return $heroes;
    }

    private function storeImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images/heroes', $imageName, 'public');

        return $imagePath;
    }

    public function storeHero(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->storeImage($data['image']);
        }

        Hero::create($data);
    }

    public function getHeroById($id)
    {
        $hero = Hero::findOrFail($id);

        return $hero;
    }

    private function updateImage(Hero $hero, $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/images/heroes', $imageName);

        if ($hero->image) {
            Storage::delete('public/' . $hero->image);
        }

        $hero->image = str_replace('public/', '', $imagePath);
    }

    public function updateHero(Hero $hero, array $data)
    {
        $hero->title = $data['title'] ?? $hero->title;

        if (isset($data['image'])) {
            $this->updateImage($hero, $data['image']);
        }

        $hero->save();

        return $hero;
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath);
        }
    }

    public function deleteHero(Hero $hero)
    {
        $this->deleteImage($hero->image);

        $hero->delete();
    }
}
