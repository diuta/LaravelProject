@extends('layout')

@section('content')

    <h1>TODO APP</h1>

    <form action="{{ route('index') }}" method="get">
        <button>Go To Main</button>
    </form>

    <h2>Data List</h2>
    <ul>
        @foreach ($todos as $t)
            <li>{{ $t->name }} - {{$t->id}}</li>
        @endforeach
    </ul>

    <h2>Data Insert</h2>
    <form action="{{ route('submit-todo') }}" method="post">
        @csrf
        <input type="text" name="nameInput">
        <input type="submit" value="Submit">
    </form>

    <h2>Data Remove</h2>
    <form action="{{ route('delete-todo') }}" method="post">
        @csrf
        <input type="text" name="idInput">
        <input type="submit" value="Submit">
    </form>

    <h2>Data Update</h2>
    <form action="{{ route('update-todo') }}" method="post">
        @csrf
        <input type="text" name="idInput" placeholder="Input ID">
        <input type="text" name="newName" placeholder="Input New Name">
        <input type="submit" value="Submit">
    </form>
@endsection