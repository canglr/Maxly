@extends('layouts.content')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-users primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $users }}</h3>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-link warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $links }}</h3>
                                <span>Links</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-graph success font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $link_stats }}</h3>
                                <span>Link stats</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-archive danger font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $logs }}</h3>
                                <span>Logs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
