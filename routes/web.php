<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeDetailController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', [TodoController::class, 'index'])->name('todo');
Route::post('/todo/add', [TodoController::class, 'submit'])->name('submit-todo');
Route::post('/todo/edit', [TodoController::class, 'update'])->name('update-todo');
Route::post('/todo/delete', [TodoController::class, 'delete'])->name('delete-todo');

Route::get('/dish', [DishController::class, 'index'])->name('index');
Route::post('/dish/add', [DishController::class, 'addDish'])->name('add-dish');
Route::post('/dish/edit', [DishController::class, 'editDish'])->name('edit-dish');
Route::post('/dish/delete', [DishController::class, 'deleteDish'])->name('delete-dish');

Route::get('/recipes/{dishId}', [RecipeController::class, 'recipeView'])->name('recipes');
Route::post('/recipes/{dishId}/add', [RecipeController::class, 'addDish'])->name('add-recipe');
Route::post('/recipes/{dishId}/delete', [RecipeController::class, 'deleteDish'])->name('delete-recipe');

Route::get('/recipes/{dishId}/recipe-details/{recipeId}', [RecipeDetailController::class, 'recipeDetailView'])->name('recipe-details');
Route::post('/recipes/{dishId}/recipe-details/{recipeId}/add', [RecipeDetailController::class, 'addIngredient'])->name('add-ingredients');
Route::post('/recipes/{dishId}/recipe-details/{recipeId}/edit', [RecipeDetailController::class, 'editIngredient'])->name('edit-ingredients');
Route::post('/recipes/{dishId}/recipe-details/{recipeId}/delete', [RecipeDetailController::class, 'deleteIngredient'])->name('delete-ingredients');
Route::post('/recipes/{dishId}/recipe-details/{recipeId}/recipeDescription', [RecipeDetailController::class, 'recipeDesc'])->name('recipe-desc');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
