@extends('layout.default')
@section('title', "About {$user->last_name}")
@section('content')
<div class="container mt-4" style="max-width: 500px;">
    <div class="card-header mb-4">{{$user->last_name}}'s profil</div>
    <div class="card border-dark mb-3" style="flex-direction: inherit;">
        <div class="card-body text-dark" >
            <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
            <p class="card-text"><b>Email: </b>{{$user->email}}</p>
            <p class="card-text"><b>Created at: </b>{{$user->created_at}}</p>
            <p class="card-text"><b>Last update: </b>{{$user->updated_at}}</p>
        </div>
        <div class="card-body text-dark">
            <h5 class="card-title">Actions : </h5>
            <form action="/users/{{$user->id}}" method="post">
                <button name="_method" value="delete" type="submit" class="btn btn-danger mb-4">Delete user {{$user->last_name}} </button>
            </form>
            <a href="/users/{{ $user->id }}/edit"><button type="button" class="btn btn-warning">Update this profil</button></a>
            <a href="/api/users/{{ $user->id }}"><button type="button" class="btn btn-primary mt-3">API</button></a>
        </div>
    </div>
</div>
@endsection