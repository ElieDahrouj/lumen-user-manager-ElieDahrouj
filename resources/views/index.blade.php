@extends('layout.default')
@section('title', 'All users')
@section('content')
<div class="container d-flex justify-content-between align-items-center">
    <h1 class="mt-4 mb-4 text text-center text-secondary">Dashboard gestion utilisateurs</h1>
    <div class="d-flex">
        <div class="mr-4">
            <a href="/api/users">
                <button type="button" class="btn btn-outline-info">API Users</button>
            </a>
        </div>
        <a href="/users/create">
            <button type="button" class="btn btn-outline-info">Create user</button>
        </a>
    </div>
</div>
<div class="container" style="height: 80vh;overflow-y: scroll;">
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
            <td>
                <a href="users/{{ $user->id }}">
                    <button type="button" class="btn btn-primary" value="{{$user->id}}">Détails</button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection