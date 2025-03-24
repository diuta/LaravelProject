<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Recipe;

class DishController extends Controller
{
    public function index() {
        $dishes = Dish::all();
        $recipes = Recipe::all();

        return view('index', ['dishes' => $dishes, 'recipes' => $recipes]);
    }

    public function addDish(DishRequest $request) {
        
        $dishes = new Dish;
        $dishes->dishName = $request->dishName;
        $dishes->dishType = $request->dishType;
        $dishes->dishPrice = $request->dishPrice;
        $dishes->save();

        return redirect('/');
    }

    public function deleteDish(Request $request) {
        $dishes = Dish::whereIn('dishId', $request->input('dish'));
        $dishes->delete();

        return redirect('/');
    
    }
    
    public function editDish(DishRequest $request) {
        $dishes = Dish::where('dishId', $request->dishId)->first();
        $dishes->dishName = $request->dishName;
        $dishes->dishType = $request->dishType;
        $dishes->dishPrice = $request->dishPrice;
        $dishes->save();

        return redirect('/');
    }
}
