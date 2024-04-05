<!DOCTYPE html>
<html>
<head lang="{{ LaravelLocalization::setLocale() }}">
    <meta charset="UTF-8">
    @section('meta')
        <meta name="description" content="@setting('core::site-description')"/>
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title')@setting('core::site-name')@show</title>
    {!! Theme::style('css/bootstrap.min.css?v='.config('app.version')) !!}
    <link rel="stylesheet" href="http://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
</head>
<body>

@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@yield('scripts')
</body>
</html>


