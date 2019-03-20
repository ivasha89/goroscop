<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        /*.sticky-left {
            position: sticky;
            left: 0;
        }*/
        .table-striped {
            table-layout: fixed;
            width: 100%;
        }

        .text-truncate {
            width: 11.1%;
        }
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 64px;
        }

        .links {
            color: #636b6f;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

</head>
<body>
<div class="spinner-border text-success" style="position: absolute; top: 50%; left: 50%; margin-top: -1.5rem; margin-left: -1.5rem; width: 3rem; height: 3rem;" role="status">
    <span class="sr-only">Loading...</span>
</div>

<header class="page-header d-none">
    @include('nav')
</header>

<main class="page-main d-none">
    <div class="container-fluid">
        @if($errors->any())
            @include('toast')
        @endif

        @yield('content')
    </div>
</main>

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>
    <script>
        $(function () {
            $('body > .spinner-border').addClass('d-none');
            $('.page-header, .page-main, .page-footer').removeClass('d-none');
        });
        $(function () {
            $('a, span').click(function () {
                $('span > .spinner-border').removeClass('d-none');
            });
        });
        $(function () {
            $('#shadowjQ').mouseover(function () {
                $('#shadowjQ').addClass('shadow');
            });
            $('#shadowjQ1').mouseover(function () {
                $('#shadowjQ1').addClass('shadow');
            });
        });
        $(function () {
            $('#shadowjQ').mouseout(function () {
                $('#shadowjQ').removeClass('shadow');
                $('#shadowjQ').addClass('shadow-sm');
            });
            $('#shadowjQ1').mouseout(function () {
                $('#shadowjQ1').removeClass('shadow');
                $('#shadowjQ1').addClass('shadow-sm');
            });
        });
    </script>
</body>
</html>