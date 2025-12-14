<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Mellow Hotel')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- External libs -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* =============================== */
/*      GLOBAL NAVBAR FIXES        */
/* =============================== */
.nav-logout-btn {
    background: #ffffff;
    padding: 10px 22px;
    border-radius: 12px;
    font-weight: 600;
    color: #333 !important;
    border: 1px solid #ddd;
    transition: 0.2s;
}

.nav-logout-btn:hover {
    background: #f7f2ee;
    cursor: pointer;
}

/* Make sure button text is visible */
.navbar a,
.navbar button {
    color: #222 !important;
    font-weight: 500;
}

/* =============================== */
/*         HERO SECTION FIX        */
/* =============================== */
.hero-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 80px 5%;
    gap: 40px;
}

.hero-text {
    max-width: 550px;
}

.hero-title {
    font-size: 64px;
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 25px;
}

.hero-subtext {
    font-size: 18px;
    color: #555;
    margin-bottom: 30px;
}

.hero-btn {
    background: #f7f2ee;
    padding: 14px 32px;
    border-radius: 12px;
    text-decoration: none;
    color: #222;
    font-weight: 600;
    border: 2px solid transparent;
    transition: 0.2s;
}

.hero-btn:hover {
    background: #e9dfd8;
    border-color: #c5b7ae;
}

.hero-img {
    width: 600px;
    height: 450px;
    object-fit: cover;
    border-radius: 30px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

/* =============================== */
/*         ADMIN THEMING           */
/* =============================== */
.admin-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    padding: 20px 0;
}

.admin-card {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    width: 330px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    transition: 0.3s;
}

.admin-card:hover {
    transform: translateY(-5px);
}

.admin-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.admin-card-body {
    padding: 18px;
}

.admin-card-body h4 {
    margin: 0;
    font-weight: 600;
    font-size: 22px;
}

.admin-card-body p {
    margin: 4px 0;
    color: #444;
}

.delete-btn {
    background: #d9534f;
    border: none;
    color: white;
    padding: 10px 18px;
    border-radius: 10px;
    margin-top: 10px;
    font-weight: 600;
    cursor: pointer;
}
.delete-btn:hover {
    background: #c9302c;
}

.admin-form {
    background: #ffffff;
    padding: 30px;
    border-radius: 18px;
    width: 600px;
    margin: 20px auto;
    box-shadow: 0 6px 16px rgba(0,0,0,0.07);
}

.admin-form label {
    margin-top: 15px;
    font-weight: 600;
}

.admin-form input,
.admin-form textarea {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #ddd;
    margin-top: 5px;
}

.create-btn {
    background: #0a8754;
    color: white;
    border: none;
    padding: 12px 28px;
    font-weight: 600;
    border-radius: 12px;
    margin-top: 20px;
}
.create-btn:hover {
    background: #086b42;
}

</style>

</head>
<body>

    @include('includes.header')

    @yield('content')

    @include('includes.footer')

    <!-- JS Load Order Matters -->
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- External JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 800, once: true });
    </script>

</body>
</html>
