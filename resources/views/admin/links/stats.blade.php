@extends('layouts.content')

@section('title', 'Link stats')


@section('content')
    <hr>
    <h6>General stats</h6>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td>Link id</td>
            <td>{{ $link->share_id }}</td>
        </tr>
        <tr>
            <td>Link create date</td>
            <td>{{ $link->created_at }}</td>
        </tr>
        <tr>
            <td>Total clicks</td>
            <td>{{ $link_clicks }}</td>
        </tr>
        @if(!$owners->isEmpty())
        <tr>
            <td>Owner</td>
            <td>@foreach($owners as $owner) <span class="badge badge-dark"><a target="_blank" href="/admin/users/{{ $owner->id }}/info" class="text-white">{{ $owner->name }}</a></span> @endforeach</td>
        </tr>
        @endif
        </tbody>
    </table>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">Language stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#browser" role="tab" aria-controls="browser" aria-selected="false">Browser stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#referer" role="tab" aria-controls="referer" aria-selected="false">Referer stats</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="language" role="tabpanel" aria-labelledby="language-tab">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Language</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($languages as $language)
                    <tr>
                        <td>{{ $language->language }}</td>
                        <td>{{ $language->total }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="browser" role="tabpanel" aria-labelledby="browser-tab">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Browser</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($browsers as $browser)
                    <tr>
                        <td>{{ $browser->browser }}</td>
                        <td>{{ $browser->total }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="referer" role="tabpanel" aria-labelledby="referer-tab">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Referer</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($referers as $referer)
                    <tr>
                        <td>{{ $referer->referer }}</td>
                        <td>{{ $referer->total }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <h6>Other</h6>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Ip Address</th>
            <th scope="col">Browser</th>
            <th scope="col">Language</th>
            <th scope="col">Referer</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($link_stats as $link_stat)
            <tr>
                <td>{{ $link_stat->ip_address }}</td>
                <td>{{ $link_stat->browser }}</td>
                <td>{{ $link_stat->language }}</td>
                <td>{{ $link_stat->referer }}</td>
                <td>{{ $link_stat->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $link_stats->links() }}
@endsection
