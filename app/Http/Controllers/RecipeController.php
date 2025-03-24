<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeRequest;
use App\Models\Dish;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function recipeView($dishId) {
        $recipes = Recipe::where('dishId', $dishId)->get();
        $dishes = Dish::find($dishId);

        return view('recipes', ['recipes' => $recipes, 'dishId' => $dishId, 'dishes' => $dishes]);
    }

    public function addRecipe($dishId, RecipeRequest $request) {
        $recipes = new Recipe;
        $recipes->dishId = $request->dishId;
        $recipes->recipeName = $request->recipeName;
        $recipes->save();

        return redirect()->route('recipes', ['dishId' => $dishId]);
    }

    public function deleteRecipe($dishId, Request $request) {
        $recipes = Recipe::whereIn('recipeId', $request->input('recipe'));
        $recipes->delete();

        return redirect()->route('recipes', ['dishId' => $dishId]);
    }
}
