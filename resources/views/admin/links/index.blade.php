@extends('layouts.content')

@section('title','Links')

@section('content')
    <form action="/admin/links" method="get">
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-link"></i></span>
        </div>
        <input type="text" name="id" autocomplete="off" class="form-control form-control-lg" value="{{request()->get('id')}}" placeholder="Link id => 2zUn...">
        <div class="input-group-append">
            <button type="submit" class="btn btn-block btn-lg btn-dark"><i class="fas fa-check"></i></button>
        </div>
    </div>
    </form>

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
        @foreach ($links as $link)
            <tr>
                <td>
                    <a target="_blank" href="{{ URL('/').'/'.$link->share_id }}">{{ URL('/').'/'.$link->share_id }}</a>
                    <br>
                    <small><a target="_blank" href="{{ $link->links }}">Direct link</a></small>

                </td>
                <td>{{ $link->created_at }}</td>
                <td><a href="/admin/links/{{ $link->share_id }}/stats" class="btn btn-dark btn-sm" role="button"><i class="fas fa-chart-pie"></i></a></td>
                <td><a href="/admin/links/{{ $link->share_id }}/delete" onclick="return confirm('Are you sure you want to delete it?')" class="btn btn-dark btn-sm" role="button"><i class="fas fa-trash"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $links->links() }}
@endsection
