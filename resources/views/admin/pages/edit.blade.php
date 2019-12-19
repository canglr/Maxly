@extends('layouts.content')

@section('title','Edit Page')

@section('content')
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
    <form method="post" action="/admin/pages/{{ $page->id }}/edit">
        <div class="form-group">
            @csrf
            <input type="text" name="title" class="form-control" value="{{ $page->title }}" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea id="editor" rows="10" name="content" class="form-control" placeholder="Content">{{ $page->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-dark float-right"><i class="fas fa-check"></i></button>
    </form>
@endsection
