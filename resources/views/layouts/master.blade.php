<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - CAM Media Upload</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/styles.css') }}" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <a id="logo" href="/"><img src="{{asset('img/mediaupload_logo.svg')}}" alt="CAM Media Uploads"></a>
    @if( auth()->check() )
        <nav>
            <ul id="main-nav" class="nav">
                <li><a href="/">Dashboard</a></li>
                <li><a href="/">Settings</a></li>
                <li><a href="/">Help</a></li>
            </ul>
        </nav>
        <div id="user-info-header">
            <span>Welcome {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} <a href="{{ URL::to('logout') }}">(logout)</a></span>
         </div>
    @endif
</header>
@yield('content')
@yield ('scripts')

</body>
</html>