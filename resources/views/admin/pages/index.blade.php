@extends('layouts.content')

@section('title','Pages')

@section('card-header')
    <div class="card-header">
        <div class="btn-group btn-group-sm" role="group">
            <a href="/admin/pages/new" class="btn btn-dark btn-sm" role="button"><i class="fas fa-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Create date</th>
            <th scope="col">Last update</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                <td><a target="_blank" href="/page/{{ $page->title_sef }}">{{ $page->title }}</a></td>
                <td>{{ $page->created_at }}</td>
                <td>{{ $page->updated_at }}</td>
                <td><a href="/admin/pages/{{ $page->id }}/edit" class="btn btn-dark btn-sm" role="button"><i class="fas fa-edit"></i></a></td>
                <td><a href="/admin/pages/{{ $page->id }}/delete" onclick="return confirm('Are you sure you want to delete it?')" class="btn btn-dark btn-sm" role="button"><i class="fas fa-trash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pages->links() }}
@endsection
