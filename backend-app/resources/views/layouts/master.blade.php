<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master page</title>

    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog-detail.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product-detail.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contact-us.css') }}" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

</head>

<body>
    <header>
        @include('layouts.header')
        @yield('content')
</header> 

<footer>
        @include('layouts.footer')
</footer> 
</body>