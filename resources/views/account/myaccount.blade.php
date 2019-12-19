@extends('layouts.content')

@section('title', 'My account')

@section('card-header')
    <div class="card-header">
        <div class="btn-group btn-group-sm float-right" role="group">
            <a href="/go/myaccount/edit" class="btn btn-dark btn-sm" role="button"><i class="fas fa-user-edit"></i></a>
            <a href="/go/myaccount/password" class="btn btn-dark btn-sm" role="button"><i class="fas fa-key"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=250" alt="{{ Auth::user()->name }}" class="img-thumbnail rounded-circle">
            </div>

            <div class="col">
                <div class="form-group input-group-sm">
                    <label><span class="badge badge-secondary text-capitalize">Email</span></label><br>
                    <small><label>{{ Auth::user()->email }}</label></small>

                    <br>

                    <label><span class="badge badge-secondary text-capitalize">Name</span></label><br>
                    <small><label class="text-capitalize">{{ Auth::user()->name }}</label></small>

                    <br>

                    <label><span class="badge badge-secondary text-capitalize">Create date</span></label><br>
                    <small><label class="text-capitalize">{{ Auth::user()->created_at }} </label></small>

                    <br>

                    <label><span class="badge badge-secondary text-capitalize">Last update</span></label><br>
                    <small><label class="text-capitalize">{{ Auth::user()->updated_at }} </label></small>
                </div>

            </div>
        </div>
    </div>

@endsection
