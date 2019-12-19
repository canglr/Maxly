@extends('layouts.content')

@section('title','Roles')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form action="/admin/roles" method="post">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-at"></i></span>
            </div>
            @csrf
            <input type="text" name="email" autocomplete="off" id="link" class="form-control form-control-lg" placeholder="Email">
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
            <th scope="col">Role</th>
            <th scope="col">Role date</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->email }}</td>
                <td>{{ $role->role_name }}</td>
                <td>{{ $role->created_at }}</td>
                <td><a href="/admin/users/{{ $role->id }}/info" class="btn btn-dark btn-sm" role="button"><i class="fas fa-user"></i></a></td>
                <td><a href="/admin/roles/{{ $role->role_id }}/delete" onclick="return confirm('Undo the role?')" class="btn btn-dark btn-sm" role="button"><i class="fas fa-user-alt-slash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $roles->links() }}
@endsection
