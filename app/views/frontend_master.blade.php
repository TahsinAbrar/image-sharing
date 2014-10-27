<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Image Sharing</title>
{{ HTML::style('css/style.css') }}
</head>
<body>
    <h2>Your Awesome Image Sharing Website</h2>

    {{--If there is an error flashdata in session (from form validation), we show the first one--}}
    @if(Session::has('errors'))
    <h3 class="error">{{ $errors->first() }}</h3>
    @endif

    {{--If there is an error flashdata in session which is set manually, we will show it--}}
    @if(Session::has('error'))
        <h3 class="error">{{ Session::get('error') }}</h3>
    @endif
    {{--If we have a success message to show, we print it--}}
    @if(Session::has('success'))
            <h3 class="error">{{ Session::get('success') }}</h3>
    @endif

    @yield('content')
</body>
</html>