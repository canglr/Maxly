@extends('layouts.content')

@section('title','Logs')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Data</th>
            <th scope="col">Create date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>
                    <button class="btn btn-dark btn-sm" type="button" data-toggle="collapse" data-target="#data-{{ $log->id }}" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-eye"></i>
                    </button>
                    <div class="collapse" id="data-{{ $log->id }}">
                        <small>{!! json_viewer($log->data) !!}</small>
                    </div>

                </td>
                <td>{{ $log->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
@endsection
