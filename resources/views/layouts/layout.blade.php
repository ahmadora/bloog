
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
    {{Html::style("Web/css/bootstrap.min.css")}}
    {{Html::style("Web/fontawesome/css/all.min.css") }}
    {{Html::style("Web/css/templatemo-diagoona.css") }}

</head>

<body>
<div class="tm-container">
    <div class="tm-row pt-4">
        <div class="tm-col-left">
            <div class="tm-site-header media">
                <i class="fas fa-umbrella-beach fa-3x mt-1 tm-logo"></i>
                <div class="media-body">
                    <h1 class="tm-sitename text-uppercase">Advertisement</h1>
                    <p class="tm-slogon">Make it easy</p>
                </div>
            </div>
    </div>

        @yield('navbar')
    </div>
    <main>
        @yield('content')
    </main>
    <div class="tm-row">
        <div class="tm-col-left text-center">
            <ul class="tm-bg-controls-wrapper">
                <li class="tm-bg-control active" data-id="0"></li>
                <li class="tm-bg-control" data-id="1"></li>
                <li class="tm-bg-control" data-id="2"></li>
            </ul>
        </div>
        <div class="tm-col-right tm-col-footer">
            <footer class="tm-site-footer text-right">
                <p class="mb-0">Copyright 2020 Ahmad Orabi
            </footer>
        </div>
    </div>
    <div class="tm-bg">
        <div class="tm-bg-left"></div>
        <div class="tm-bg-right"></div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="Web/js/jquery-3.4.1.min.js"></script>
<script src="Web/js/bootstrap.min.js"></script>
<script src="Web/js/jquery.backstretch.min.js"></script>
<script src="Web/js/templatemo-script.js"></script>
</body>
@yield('scripts')
</html>
