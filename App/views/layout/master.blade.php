<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @if( isset($_SESSION['flash_msg']))
    <script>
        let msg = "{{$_SESSION['flash_msg']['msg']}}";
    </script>

    @php
    unset ($_SESSION['flash_msg']);
    @endphp
    @endif
    <script src="/js/app.js"></script>
    @yield('scriptsection')
    <title>Blog</title>
</head>

<body>

    <aside id="submenu">
        <h2 class="my-3 text-center">Submenu</h2>
        @if(isset($_SESSION['user']))
        <a href="/logout" class="btn btn-block btn-outline-primary">로그아웃</a>
        <a href="/post" class="btn btn-block btn-outline-primary">포스팅</a>
        @else
        <a href="/login" class="btn btn-block btn-outline-primary">로그인</a>
        @endif
    </aside>
    <div id="toastList">

    </div>

    <section id="main">
        <div class="container">
            <header class="d-flex">
                <div class="logo">
                    <h1><a href="index.php" style="text-decoration: none; color: #333;">Blog</a></h1>
                </div>
                <div class="icon-bar">
                    <span><i class="fas fa-search"></i></span>
                    <span id="btnSubmenu"><i class="fas fa-ellipsis-v"></i></span>
                </div>
            </header>
        </div>
    </section>


    @yield('maincontent')

    <footer>
        <div class="container text-center">
            Copyright Lee Dawoon, 2019 Allright reserved. Y-Y Digital highschool
            <div class="icon-box">
                <i class="fab fa-facebook-square"></i>
                <i class="fab fa-google"></i>
                <i class="fab fa-twitter-square"></i>
            </div>
        </div>
    </footer>
</body>

</html>