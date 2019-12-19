@extends('layouts.content')

@section('title','Users')

@section('content')
    <form action="/admin/users" method="get">
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-at"></i></span>
        </div>
        <input type="text" name="email" autocomplete="off" id="link" class="form-control form-control-lg" value="{{request()->get('email')}}" placeholder="Email">
        <div class="input-group-append">
            <button  type="submit" class="btn btn-block btn-lg btn-dark"><i class="fas fa-check"></i></button>
        </div>
    </div>
    </form>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Last update</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->updated_at }}</td>
                <td><a href="/admin/users/{{ $user->id }}/info" class="btn btn-dark btn-sm" role="button"><i class="fas fa-user"></i></a></td>
                <td><a href="/admin/users/{{ $user->id }}/edit" class="btn btn-dark btn-sm" role="button"><i class="fas fa-user-edit"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
