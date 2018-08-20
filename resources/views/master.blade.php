<!DOCTYPE html>
<html lang="en">
<head>
    <title>評屋網</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.2.0/css/bootstrap.min.css"/>


    @yield('resource')
    @yield('style')

    <style>
        .jumbotron{
            padding:2rem  2rem;
        }
        .footer {
            bottom: 0;
            width: 100%;
            height: 5rem;
            line-height: 5rem;
            background-color: #eee;
            position:fixed;


        }
        body{
            padding-bottom:8rem;
        }

    </style>

</head>
<body>


<div class="jumbotron text-center">
    <h1>評屋網</h1>
    <p>@yield('description')</p>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="/">首頁</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/user/upload">上傳物件</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">關於評屋網</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">贊助</a>
        </li>
    </ul>

    
</div>

<div class="container ">
    @yield('content')
</div>


<footer class="footer">
    <div class="container">
        <span class="text-muted pull-right">由Kavin Flynn製作</span>
    </div>
</footer>
</body>
</html>

@yield('script')