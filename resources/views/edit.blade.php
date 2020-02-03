@extends('layout.default')
@section('title', "Editing {$infoUser->last_name}")
@section('content')
<div class="container mt-4" style="max-width: 500px;">
    <div class="p-3 mb-2 bg-warning text-black">Editing {{$infoUser->last_name}}'s profile</div>
    <form method="post" action="/users/{{$infoUser->id}}">
        <div class="form-group">
            <label for="last_name">Last name :</label>
            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Mckarter" value="{{$infoUser->last_name}}">
        </div>
        <div class="form-group">
            <label for="first_name"><b>First name </b></label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Kilyan" value="{{$infoUser->first_name}}">
        </div>
        <div class="form-group">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{$infoUser->email}}">
        </div>
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="**********" value="{{$infoUser->password}}">
        </div>
        <button type="submit" name="_method" value="patch" class="btn btn-secondary">Update</button>
    </form>
</div>
@endsection