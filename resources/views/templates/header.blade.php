<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ url('') }}favicon.png">
    <link href="{{ asset('') }}css/style.css?v={{ date('H:m:s') }}" rel="stylesheet">
        <style>
            .post-img .img {
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
            .post-box {
                border: 1px solid gray;
                /* max-width: 450px; */
                overflow: hidden;
            }
            .post-data {
                box-sizing: border-box;
                padding: 15px 10px;
            }
            .post-img {
            position: relative;
            margin-bottom: 20px;
                    }
        .post-format-icons {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            border-radius: 50%;
            text-align: center;
            border: 3px solid #fff!important;
            left: 28px;
            bottom: -18px;
            line-height: 30px;
            z-index: 5;
            transition: box-shadow 0.2s;
            font-size: 12px;
            /* border-color:#bb7e68; */
            color:#fff;
        }
        .post-img:hover .post-format-icons svg{
            background-color:rgb(99 49 18);
            box-shadow:0 0 0 3px rgb(99 49 18)
        }
    </style>
    <script src="{{ asset('js/flowbite.js') }}"></script>
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
                    <div class="w-full">