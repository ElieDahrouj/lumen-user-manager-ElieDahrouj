@extends('layout.default')
@section('title', 'Create user')
@section('content')
<div class="container mt-4" style="max-width: 500px;">
    <div class="p-3 mb-2 bg-info text-white">Create a user</div>
    <form method="post" action="/users">
        <div class="form-group">
            <label for="last_name">Last name :</label>
            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Mckarter" >
        </div>

        <div class="form-group">
            <label for="first_name"><b>First name </b></label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Kilyan" >
        </div>

        <div class="form-group">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" >
        </div>

        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="**********" >
        </div>

        <button type="submit" class="btn btn-secondary">Create</button>
    </form>
    @if(isset($errors))
        <div class="alert alert-danger mt-3" role="alert">
            @foreach($errors as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
</div>
@endsection