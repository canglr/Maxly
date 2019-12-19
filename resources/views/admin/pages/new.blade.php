@extends('layouts.content')

@section('title','New Page')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/admin/pages/new">
        <div class="form-group">
            @csrf
            <input type="text" name="title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea id="editor" rows="10" name="content" class="form-control" placeholder="Content"></textarea>
        </div>
        <button type="submit" class="btn btn-dark float-right"><i class="fas fa-check"></i></button>
    </form>
@endsection
