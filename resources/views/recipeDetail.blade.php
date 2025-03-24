@extends('layout')
@section('content')
    <div class="content">
        <div class="head">
            <h1>{{ $recipes->recipeName }}</h1>
        </div>

        <div class="addContent" hidden>
            <form action="{{ route('add-ingredients', ['dishId' => $recipes->dishId, 'recipeId' => $recipes->recipeId]) }}" method="post" id="addForm">
                @csrf
                <input type="text" name="ingredient" placeholder="Add ingredient" required>
                <input type="text" name="quantity" placeholder="quantity" required>
                <input type="text" name="unit" placeholder="unit" required>
                <input type="submit" value="Submit">

                @error('ingredient')
                    <div>{{$message}}</div>
                @enderror
                @error('quantity')
                    <div>{{$message}}</div>
                @enderror
                @error('unit')
                    <div>{{$message}}</div>
                @enderror
            </form>
        </div>

        <div class="editContent" hidden>
            <form action="{{ route('edit-ingredients', ['dishId' => $recipes->dishId, 'recipeId' => $recipes->recipeId]) }}" method="post" id="editForm">
                @csrf
                <input type="hidden" name="ingredientId" id="ingredientId">
                <input type="text" name="ingredient" id="ingredient" required>
                <input type="text" name="quantity" id="quantity" required>
                <input type="text" name="unit" id="unit" required>
                <input type="submit" value="Submit">

                @error('ingredient')
                    <div>{{$message}}</div>
                @enderror
                @error('quantity')
                    <div>{{$message}}</div>
                @enderror
                @error('unit')
                    <div>{{$message}}</div>
                @enderror
            </form>
        </div>
        
        <div class="deleteContent">
            <form action="{{ route('delete-ingredients', ['dishId' => $recipes->dishId, 'recipeId' => $recipes->recipeId]) }}" method="post" id="deleteForm">
                @csrf
                <div class="alterButtons">
                    <button id="addBtn" type="button">ADD</button>
                    <button id="deleteBtn" type="submit">DELETE</button> 
                </div>
                <h3>Recipe Details</h3>
                <div class="dishTable">
                    <table>
                        <tr>
                            <th></th>
                            <th>Ingrident</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Toggle</th>
                        </tr>
        
                        @foreach ($recipeDetails as $item)
                            <tr>
                                <td><input type="checkbox" value={{ $item->ingredientId }} name="recipeDetail[]" class="cBox"></td>
                                <td>{{$item->ingredient}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit}}</td>
                                <td><button type="button" class="editBtn">Edit</button></td>
                            </tr> 
                        @endforeach
                    </table>
                </div>
            </form>
        </div>

        <div class="desc">
            <h3>Recipe Description</h3>
            <form action="{{ route('recipe-desc', ['dishId' => $recipes->dishId, 'recipeId' => $recipes->recipeId]) }}" method="post">
                @csrf
                <textarea name="recipeDescription" id="recipeDescription" disabled>{{$recipes->recipeDescription}}</textarea>
                @error('recipeDescription')
                    <div>{{$message}}</div>
                @enderror
                <div class="descButtons">
                    <button type="button" id="editDesc">Edit</button>
                    <button type="submit" id="saveDesc">Save</button>
                </div>

            </form>
        </div>
        
    </div>

    <script>
        $(document).ready(function () {
            $('#addBtn').click(function () {
                document.querySelector('.addContent').removeAttribute('hidden');
                document.querySelector('.editContent').hidden = true;
            });

            $('.editBtn').click(function () {
                document.querySelector('.editContent').removeAttribute('hidden');
                document.querySelector('.addContent').hidden = true;

                let row = $(this).closest('tr');
                let ingredientId = row.find('.cBox').val();
                let ingredient = row.find('td:nth-child(2)').text();
                let quantity = parseInt(row.find('td:nth-child(3)').text());
                let unit = row.find('td:nth-child(4)').text();

                $('#ingredientId').val(ingredientId);
                $('#ingredient').val(ingredient);
                $('#quantity').val(quantity);
                $('#unit').val(unit);
            })

            $('#deleteForm').submit(function (event){
                if($('.cBox:checked').length == 0){
                    alert('please check the checkboxes');
                    event.preventDefault();
                }
            });

            $('#editDesc').click(function (){
                document.querySelector('#recipeDescription').removeAttribute('disabled');
            });
        });
    </script>
@endsection