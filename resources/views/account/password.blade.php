@extends('layouts.content')

@section('title', 'Password change')

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

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
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

                <form method="post" action="/go/myaccount/password">
                    <div class="form-group input-group-sm">
                        <label><span class="badge badge-secondary text-capitalize">Current password</span></label><br>
                        <input type="password" name="current" class="form-control">

                        <br>
                        @csrf
                        <label><span class="badge badge-secondary text-capitalize">New password</span></label><br>
                        <input type="password" name="password" class="form-control">

                        <br>

                        <label><span class="badge badge-secondary text-capitalize">New password repeat</span></label><br>
                        <input type="password" name="password_confirmation" class="form-control">

                        <br>

                        <button type="submit" class="btn btn-dark float-right"><i class="fas fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
