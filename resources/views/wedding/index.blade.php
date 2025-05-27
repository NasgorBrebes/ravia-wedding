<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ravia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <!-- Tambahkan CSS transisi -->
    <link rel="stylesheet" href="{{ asset('css/transition.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Overlay untuk efek transisi -->
    <div class="page-transition-overlay"></div>

    <section id="hero"
        class="hero w-100 h-100 p-3 mx-auto text-center d-flex justify-content-center align-items-end text-white">
        <main>
            <h1>Rama & Oktavia</h1>
            <h4>Kepada Bpk/Ibu/Saudara/I </h4>
            <p>Tamu Undangan</p>
            <a href="ravia" style="text-decoration: none;" class="invite-btn">📩 Open Invitation</a>
        </main>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">logout</button>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <!-- Tambahkan JavaScript transisi -->
    <script src="{{ asset('js/transition.js') }}"></script>
</body>

</html>
