<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;

use function Laravel\Prompts\alert;

class TodoController extends Controller
{
    public function index() {

        $todos = Todo::all();
        
        return view('testing', ['todos' => $todos]);
    }

    public function submit(Request $request) {
        $todos = new Todo;
        $todos->name = $request->nameInput;
        $todos->save();

        return redirect('/todo');
    }

    public function delete(Request $request) {
        $todos = Todo::find($request->idInput);
        $todos->delete();

        return redirect('/todo');
    }

    public function update(Request $request) {
        $todos = Todo::find($request->idInput);
        
        if($todos == null){
            alert('No data with that id');
        } else {
            $todos->name = $request->newName;
            $todos->save();
        }

        return redirect('/todo');
    }
}
