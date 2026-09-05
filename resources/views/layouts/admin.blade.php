<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIRTA')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

    @yield('content')


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- SIDEBAR MOBILE -->
    <script>

        const mobileMenu = document.getElementById("mobileMenu");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (mobileMenu && sidebar && overlay) {

            mobileMenu.addEventListener("click", function () {

                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");

            });


            overlay.addEventListener("click", function () {

                sidebar.classList.remove("show");
                overlay.classList.remove("show");

            });

        }

    </script>

</body>

</html>