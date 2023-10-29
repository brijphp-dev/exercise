<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Exercise' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <div class="inner">
            <a href="{{ route('homepage') }}">
                <img src="{{ asset('images/lsi-logo.svg') }}" alt="LSi">
            </a>
        </div>
    </header>

    @isset($navitems)
        <nav>
            <div class="inner">
                @foreach($navitems as $navitem)
                    <a href="{{ $navitem->id == 1 ? url('/') : route('page.show', $navitem) }}">{{ $navitem->title }}</a>
                @endforeach
            </div>
        </nav>
    @endisset
    
    <main>
        <div class="inner">
            {{ $slot }}
        </div>
    </main>

    <footer>
        <div class="inner">
            &copy; <a href="https://www.lsi.co.uk" target="_blank">LSi Ltd</a> 2023
        </div>
    </footer>
    <script src="/js/app.js"></script>
</body>
</html>