@extends('layout')
@section('content')
    <div class="content">
        <div class="head">
            <h1>Dishes</h1>
            <p>View, manage, and choose your disired dish here.</p>
        </div>

        <div class="addContent" hidden>
            <form action="{{ route('add-dish') }}" method="post" id="addForm">
                @csrf
                <input type="text" name="dishName" placeholder="Add Dish Name" required>
                <input type="text" name="dishType" placeholder="Dish Type" required>
                <input type="text" name="dishPrice" placeholder="Dish Price" required>
                <input type="submit" value="Submit">

                @error('dishName')
                    <div>{{$message}}</div>
                @enderror
                @error('dishType')
                    <div>{{$message}}</div>
                @enderror
                @error('dishPrice')
                    <div>{{$message}}</div>
                @enderror

            </form>
        </div>

        <div class="editContent" hidden>
            <form action="{{ route('edit-dish') }}" method="post" id="editForm">
                @csrf
                <input type="hidden" name="dishId" id="editDishId">
                <input type="text" name="dishName" id="editDishName" required>
                <input type="text" name="dishType" id="editDishType" required>
                <input type="text" name="dishPrice" id="editDishPrice" required>
                <input type="submit" value="Submit">

                @error('dishName')
                    <div>{{$message}}</div>
                @enderror
                @error('dishType')
                    <div>{{$message}}</div>
                @enderror
                @error('dishPrice')
                    <div>{{$message}}</div>
                @enderror
            </form>
        </div>
        
        <div class="deleteContent">
            <form action="{{ route('delete-dish') }}" method="post" id="deleteForm">
                @csrf
                <div class="alterButtons">
                    <button id="addBtn" type="button">ADD</button>
                    <button id="deleteBtn" type="submit">DELETE</button> 
                </div>
                <div class="dishTable">
                    <table>
                        <tr>
                            <th></th>
                            <th>Dish Name</th>
                            <th>Dish Type</th>
                            <th>Dish Price</th>
                            <th>Toggle</th>
                        </tr>
        
                        @foreach ($dishes as $item)
                            <tr>
                                <td><input type="checkbox" value={{ $item->dishId }} name="dish[]" class="cBox"></td>
                                <td>{{$item->dishName}}</td>
                                <td>{{$item->dishType}}</td>
                                <td>{{$item->dishPrice}}</td>
                                <td><a href="{{ route('recipes', ['dishId' => $item->dishId]) }}">Recipes</a> <button type="button" class="editBtn">Edit</button></td>
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
                document.querySelector('.editContent').hidden = true;
                document.querySelector('.addContent').removeAttribute('hidden');
            });

            $('.editBtn').click(function () {
                document.querySelector('.addContent').hidden = true;
                document.querySelector('.editContent').removeAttribute('hidden');

                let row = $(this).closest('tr');
                let dishId = row.find('.cBox').val();
                let dishName = row.find('td:nth-child(2)').text();
                let dishType = row.find('td:nth-child(3)').text();
                let dishPrice = parseInt(row.find('td:nth-child(4)').text());

                $('#editDishId').val(dishId);
                $('#editDishName').val(dishName);
                $('#editDishType').val(dishType);
                $('#editDishPrice').val(dishPrice);
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
