<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Main title -->
        <title>CekFaskesmu - Mudah Akses Informasi Kesehatan Dengan CekFaskesmu</title>
        
        <!-- Meta Tags -->
        <meta name="description" content="Stay healthy within your budget with Healthy Budget. Find information about health facilities, medicines, and services in Indonesia.">
        <meta name="keywords" content="CekFaskesmu, kesehatan, informasi, obat-obatan, fasilitas kesehatan, harga obat, harga layanan kesehatan">
        
        <meta property="og:title" content="CekFaskesmu - Mudah Akses Informasi Kesehatan Dengan CekFaskesmu">
        <meta property="og:description" content="CekFaskesmu adalah platform yang memudahkan masyarakat untuk mengakses informasi biaya fasilitas kesehatan dan obat-obatan resmi dari pemerintah. Dapatkan informasi harga dan ulasan untuk layanan dan obat-obatan, temukan fasilitas kesehatan terdekat dengan mudah, dan buat keputusan yang lebih cerdas tentang kesehatan Anda.">
        <meta property="og:image" content="https://example.com/healthy-budget-image.jpg">
        <meta property="og:url" content="https://healthybudget.com">
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="CekFaskesmu - Mudah Akses Informasi Kesehatan Dengan CekFaskesmu">
        <meta name="twitter:description" content="Stay healthy within your budget with Healthy Budget. Find information about health facilities, medicines, and services in Indonesia.">
        <meta name="twitter:image" content="https://example.com/healthy-budget-image.jpg">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome 6 -->
        <script src="https://kit.fontawesome.com/b026c11a83.js" crossorigin="anonymous"></script>

        <!-- Animate On Scroll -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Leaflet JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

        <!-- Leaflet Routing Machine -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="antialiased min-h-screen bg-gray-100">
        @inertia
    </body>
</html>
