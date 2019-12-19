@extends('layouts.content')

@section('title','My links')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Link</th>
            <th scope="col">Create date</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($mylinks as $mylink)
        <tr>
            <td>
                <a target="_blank" href="{{ URL('/').'/'.$mylink->share_id }}">{{ URL('/').'/'.$mylink->share_id }}</a>
                <br>
                <small><a target="_blank" href="{{ $mylink->links }}">Direct link</a></small>

            </td>
            <td>{{ $mylink->created_at }}</td>
            <td><a href="/go/mylinks/{{ $mylink->share_id }}/stats" class="btn btn-dark btn-sm" role="button"><i class="fas fa-chart-pie"></i></a></td>
            <td><a href="/go/mylinks/{{ $mylink->share_id }}/hide" onclick="return confirm('Are you sure you want to hide it?')" class="btn btn-dark btn-sm" role="button"><i class="fas fa-ghost"></i></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $mylinks->links() }}
@endsection
