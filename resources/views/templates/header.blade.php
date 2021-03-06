<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <link href="{{ asset('') }}css/style.css?v={{ date('H:m:s') }}" rel="stylesheet">
    <script src="{{ asset('js/flowbite.js') }}"></script>
    @if (Route::current()->getName() == 'posts.show')
    @include('/posts/components/schema')
    @endif
    @if ($_SERVER['HTTP_HOST'] != 'localhost')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2ND73Q1BXP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-2ND73Q1BXP');
    </script>
    @endif
    @if (isset($require_editor) && $require_editor)
    <script src="{{ asset('admin/js/script.js?v=').Str::random(10) }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('summernote/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @endif
</head>

<body class="body">
    @if ($_SERVER['HTTP_HOST'] != 'localhost')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0" nonce="tdlOUxuG"></script>
    @endif
    <div class="container">
        @include('/templates/nav')
        <main>
            <div class="flex flex-wrap w-full">
                <div class="w-full mb-8">
                    <h1 class="text-3xl font-bold text-yellow-700 mb-1">{{ $title }}</h1>
                    @if(Route::is('posts.show'))
                    @include('/posts/components/authors-section')
                    @endif
                    <hr class="my-1">
                </div>
                <div class="w-full lg:w-9/12">
                    @if(!isset($notification_type) || $notification_type != 'none')
                    @if(isset($notification_type) && $notification_type == 'toast')
                    @include('/components/notifications/toast')
                    @else
                    @include('/components/notifications/inline')
                    @endif
                    @endif
                    <div class="w-full">