<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeDescriptionRequest;
use App\Http\Requests\RecipeDetailRequest;
use App\Models\RecipeDetail;    
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeDetailController extends Controller
{
    public function recipeDetailView($dishId, $recipeId){
        $recipes = Recipe::find($recipeId);
        $recipeDetails = RecipeDetail::where('recipeId', $recipeId)->get();
        // dd($recipes);

        return view('recipeDetail', ['recipeDetails' => $recipeDetails, 'recipes' => $recipes]);
    }

    public function addIngredient($dishId, $recipeId, RecipeDetailRequest $request){
        $recipeDetails = new RecipeDetail();
        $recipeDetails->recipeId = $recipeId;
        $recipeDetails->ingredient = $request->ingredient;
        $recipeDetails->quantity = $request->quantity;
        $recipeDetails->unit = $request->unit;
        $recipeDetails->save();

        return redirect()->route('recipe-details', ['dishId' => $dishId, 'recipeId' => $recipeId]);
    }
    
    public function deleteIngredient($dishId, $recipeId, Request $request){

        $recipeDetails = RecipeDetail::whereIn('ingredientId', $request->input('recipeDetail'));
        $recipeDetails->delete();

        return redirect()->route('recipe-details', ['dishId' => $dishId, 'recipeId' => $recipeId]);
    }

    public function editIngredient($dishId, $recipeId, RecipeDetailRequest $request) {

        $recipeDetails = RecipeDetail::find($request->ingredientId);
        $recipeDetails->ingredient = $request->ingredient;
        $recipeDetails->quantity = $request->quantity;
        $recipeDetails->unit = $request->unit;
        $recipeDetails->save();

        return redirect()->route('recipe-details', ['dishId' => $dishId, 'recipeId' => $recipeId]);
    }

    public function recipeDesc($dishId, $recipeId, RecipeDescriptionRequest $request) {
        $recipes = Recipe::find($recipeId);
        $recipes->recipeDescription = $request->recipeDescription;
        $recipes->save();

        return redirect()->route('recipe-details', ['dishId' => $dishId, 'recipeId' => $recipeId]);
    }

}
