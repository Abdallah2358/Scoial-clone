<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database2</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="/css/cover.css" rel="stylesheet">

</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Cover</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link {{ Request::path() === '/' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                    @yield('navlink')

                </nav>
            </div>
        </header>
        @yield('content')

        <footer class="mt-auto text-white-50">
            <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
                    href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
        </footer>
    </div>
    <script src="/jquery-3.5.1.slim.min.js"></script>
    <script src="/bootstrap.bundle.js"></script>
</body>

</html>
