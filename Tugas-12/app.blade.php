<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoKita') | E-Commerce</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #1e2a78;
            color: #fff;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main { flex: 1; padding: 40px; }
        .notif { background:#274690; padding:10px 15px; border-radius:5px; margin-bottom:20px; }
    </style>
</head>
<body>

    <x-navbar />

    <main>
        @if(session('pesan'))
            <div class="notif">{{ session('pesan') }}</div>
        @endif

        @yield('content')
    </main>

    <x-footer />

</body>
</html>
