<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="skcats">

        <!-- Title -->
        <title>{{ config('app.name') }}</title>

        <!-- Styles -->
        @include('partials.links')
    </head>
    <body>
        <!-- Page Container -->
        <div class="page-container">
            @include('partials.header')
            @include('partials.sidebar')
            
            <!-- Page Content -->
            <div class="page-content">
                @yield('content')
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->

        <!-- Javascripts -->
        @include('partials.scripts')
    </body>
</html>
