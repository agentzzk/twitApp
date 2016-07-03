<!DOCTYPE html>
<html>
    <head>
        <title>Tweek</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,500" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <nav><ul>
            <p>Signed In as: {{'@'.Auth::user()->handle }}</p>
            <li><a href ="">More Details</a></li>
            <li><a target="_blank" href ="http://zainzulfiqar.com#page2">Developer</a></li>
            <li><a href ="logout">Logout</a></li>
        </ul></nav>

        <h1>tweek - focus your tweets</h1>

            @if (session('alert'))
            <div class="flash">
                <p>{{ session('alert') }}</p>
            </div>
            @endif
            @if (session('alert-green'))
            <div class="flash green">
                <p>{{ session('alert-green') }}</p>
            </div>
            @endif
            @if (session('alert-red'))
            <div class="flash red">
                <p>{{ session('alert-red') }}</p>
            </div>
            @endif

        <div class="search">
            <h2>Start a list by searching for users:</h2>
            {!! Form::open(array('route' => 'add.sub')) !!}
            {{ csrf_field() }}
            {!! '@'.Form::text('sub_name') !!}
            {!! Form::button('Add', ['type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>

        <div class="tweets">
            @foreach ($subs as $sub)
            <div class='tweetContainer'>
                <div class="info">
                    <a class="button negate" href="{{ route('delete.sub', $sub) }}">Remove</a>
                    <h2>{{ $sub->name }}</h2>
                    <img src="{{ $sub->avatar }}">
                    <p class="tiny">Last updated: {{ Carbon\Carbon::parse(Auth::user()->last_API_fetch)->toDayDateTimeString() }}</p>
                </div>
                <div class="feed">
                    @for ($i = 0; $i < sizeOf(json_decode($sub->timeline)); $i++)
                        <div class="tweet">
                            <p class="text">{{ json_decode($sub->timeline)[$i]->text }}</p>
                            <p class="tiny">{{ date('H:i, M d', strtotime(json_decode($sub->timeline)[$i]->created_at)) }}</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        @endforeach
    </body>
</html>