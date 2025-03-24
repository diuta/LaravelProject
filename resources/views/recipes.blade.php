@extends('layout')
@section('content')
    <div class="content">
        <div class="head">
            <h1>{{$dishes->dishName}}</h1>
        </div>

        <div class="addContent" hidden>
            <form action="{{ route('add-recipe', ['dishId' => $dishId]) }}" method="post" id="addForm" >
                @csrf
                <input type="text" name="recipeName" placeholder="Recipe Name" required>
                <input type="submit" value="Submit">
            </form>
        </div>
        
        <div class="deleteContent">
            <form action="{{ route('delete-recipe', ['dishId' => $dishId]) }}" method="post" id="deleteForm">
                @csrf
                <div class="alterButtons">
                    <button id="addBtn" type="button">ADD</button>
                    <button id="deleteBtn" type="submit" value="Submit">DELETE</button>
                </div>
                <div class="dishTable">
                    <table>
                        <tr>
                            <th></th>
                            <th>Recipe Name</th>
                            <th>Toggle</th>
                        </tr>
        
                        @foreach ($recipes as $item)
                            <tr>
                                <td><input type="checkbox" value={{ $item->recipeId }} name="recipe[]" class="cBox"></td>
                                <td>{{$item->recipeName}}</td>
                                <td><a href="{{ route('recipe-details', ['dishId'=> $item->dishId, 'recipeId' => $item->recipeId]) }}">Detail</a></td>
                            </tr> 
                        @endforeach
                    </table>
                </div>
            </form>
        </div>
        
    </div>

    <script>
        $(document).ready(function () {
            $('#addBtn').click(function () {
                document.querySelector('.addContent').removeAttribute('hidden');
            });

            $('#deleteForm').submit(function (){
                if($('.cBox:checked').length == 0){
                    alert('please check the checkboxes');
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection