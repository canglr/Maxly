@extends('layouts.content')

@section('title', 'My account')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=250" alt="{{ Auth::user()->name }}" class="img-thumbnail rounded-circle">
            </div>

            <div class="col">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="/go/myaccount/edit">
                <div class="form-group input-group-sm">
                    <label><span class="badge badge-secondary text-capitalize">Email</span></label><br>
                    <small><label>{{ Auth::user()->email }}</label></small>

                    <br>
                     @csrf
                    <label><span class="badge badge-secondary text-capitalize">Name</span></label><br>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Name">

                    <br>

                    <label><span class="badge badge-secondary text-capitalize">Create date</span></label><br>
                    <small><label class="text-capitalize">{{ Auth::user()->created_at }} </label></small>

                    <br>

                    <label><span class="badge badge-secondary text-capitalize">Last update</span></label><br>
                    <small><label class="text-capitalize">{{ Auth::user()->updated_at }} </label></small>
                    <button type="submit" class="btn btn-dark float-right"><i class="fas fa-check"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
