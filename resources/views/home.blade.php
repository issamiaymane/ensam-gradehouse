<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home Page | ENSAM GradeHouse</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ensam-accent: #e74c3c;
            --text-dark: #2c3e50;
            --text-light: #f8f9fa;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            background-color: #f8f9fa;
        }

        .dark body {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* Header Styles */
        .topbar {
            background-color: var(--color-brand-500);
            color: white;
            padding: 10px 0;
            font-size: 0.9rem;
        }

        .dark .topbar {
            background-color: var(--color-brand-500);
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .dark .navbar {
            background-color: #1f2937;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--color-brand-500);
        }

        .dark .navbar-brand {
            color: var(--color-brand-500);
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .dark .nav-link {
            color: #f3f4f6;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--color-brand-500);
        }

        .btn-ensam {
            background-color: var(--color-brand-500);
            color: white;
            border-radius: var(--radius-lg);
        }

        .btn-ensam:hover {
            background-color: var(--color-brand-600);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            background: url('{{ asset('images/shape/grid-01.svg') }}') no-repeat;
            background-size: cover;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .dark .hero-section {
            color : white;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            opacity: 0.2;
        }

        .hero-section .d-flex {
            position: relative;
            z-index: 20;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Features Section */
        .features-section {
            padding: 5rem 0;
            background-color: white;
        }

        .dark .features-section {
            background-color: #1f2937;
            color : white;
        }

        .section-title {
            color: var(--color-brand-500);
            font-weight: 700;
            margin-bottom: 3rem;
            position: relative;
        }

        .dark .section-title {
            color: var(--color-brand-500);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--ensam-accent);
        }

        .feature-card {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            height: 100%;
            border-top: 3px solid var(--color-brand-500);
        }

        .dark .feature-card {
            background-color: #374151;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--color-brand-500);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-weight: 600;
            color: var(--color-brand-950);
            margin-bottom: 1rem;
        }

        .dark .feature-title {
            color: #f3f4f6;
        }

        /* Announcement Section */
        .announcements-section {
            padding: 5rem 0;
        }

        .announcement-slider {
            position: relative;
            margin: 0 auto;
        }

        .announcement-slider img {
            width: 100%;
            height: 720px;
            object-fit: cover;
            border-radius: 8px;
        }

        .dark .announcement-slider .slide-info {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .slide-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 2rem;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .slide-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .slide-info p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .slider-nav:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }

        .slider-prev {
            left: 20px;
        }

        .slider-next {
            right: 20px;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background-color: var(--color-brand-500);
        }

        /* Footer */
        .footer {
            background-color: var(--color-brand-600);
            color: white;
            padding: 3rem 0 1rem;
        }

        .dark .footer {
            background-color: #1f2937;
        }

        .footer-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            display: block;
            margin-bottom: 0.5rem;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
        }
    </style>
</head>

<div
    x-data="{ page: 'home', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
>
    <!-- ===== Preloader Start ===== -->
    <div
        x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
    >
        <div class="flex flex-col items-center">
            <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
            <p class="mt-4 text-gray-600 dark:text-gray-300">Loading GradeHouse...</p>
        </div>
    </div>
    <!-- ===== Preloader End ===== -->

    <!-- Topbar Start -->
    <div class="topbar d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <i class="fas fa-university me-2"></i> High National School Of Arts and Crafts Rabat
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-calendar-alt me-2"></i> Academic Year 2024-2025
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-clock me-2"></i> Last Update: <span id="current-date"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand flex items-center" href="#">
                <img class="dark:hidden" src="{{ url('images/logo/logo-light.svg') }}" alt="ENSAM Logo" class="h-8 w-auto me-2">
                <img class="hidden dark:block" src="{{ url('images/logo/logo-dark.svg') }}" alt="ENSAM Logo" class="h-8 w-auto me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('sign-in')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('sign-in')}}">Grades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('sign-in')}}">Calendar</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            Resources
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">FAQs</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="{{url('sign-in')}}" class="btn btn-ensam ms-3">
                    Sign In <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Monitor Your Academic Progress</h1>
                    <p class="hero-subtitle">ENSAM GradeHouse provides real-time access to your Continuous Control grades and academic performance analytics.</p>
                    <div class="d-flex gap-3">
                        <a href="{{url('sign-in')}}" class="btn btn-ensam btn-lg">Sign In <i class="fas fa-arrow-right ms-2"></i></a>
                        <a href="#" class="btn btn-ensam btn-lg">Learn More</a>
                    </div>
                    <div class="mt-4 p-3 bg-white bg-opacity-10 rounded d-inline-block">
                        <small><i class="fas fa-info-circle me-2"></i> Grades become final only after deliberation</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Features Section Start -->
    <section class="features-section">
        <div class="container">
            <h2 class="text-center section-title">GradeHouse Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Grade Analytics</h3>
                        <p>Visualize your academic performance with detailed charts and progress tracking across all subjects.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Real-time Alerts</h3>
                        <p>Get instant notifications when new grades are published or when there are updates to your academic record.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Class Benchmarking</h3>
                        <p>Compare your performance with class averages while maintaining complete anonymity of other students.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section End -->

    <!-- Announcements Section Start -->
    <section class="announcements-section">
        <div class="container">
            <h2 class="text-center section-title mb-12">Academic Announcements</h2>
            <div class="announcement-slider">
                <div class="relative" x-data="{
                currentIndex: 0,
                slides: [
                    {
                        image: '{{ asset('images/slides/slider1.gif') }}',
                        title: 'Welcome on board',
                        caption: 'Empowering education through efficient grade management.'
                    },
                    {
                        image: '{{ asset('images/slides/slider2.gif') }}',
                        title: 'Registration Deadline',
                        caption: 'May 10, 2025'
                    }
                ],
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.slides.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                }
            }" x-init="setInterval(() => next(), 5000)">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div class="slide" x-show="currentIndex === index" x-transition>
                            <img :src="slide.image" :alt="slide.title">
                            <div class="slide-info">
                                <h3 x-text="slide.title"></h3>
                                <p x-text="slide.caption"></p>
                            </div>
                        </div>
                    </template>

                    <!-- Navigation -->
                    <button @click="prev()" class="slider-nav slider-prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button @click="next()" class="slider-nav slider-next">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Dots -->
                    <div class="slider-dots">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div @click="currentIndex = index" class="slider-dot" :class="{ 'active': currentIndex === index }"></div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Announcements Section End -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title">ENSAM GradeHouse</h5>
                    <p>The official grade management platform for ENSAM Rabat students. Providing transparent access to academic results and performance analytics.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <div class="footer-links">
                        <a href="{{url('sign-in')}}">Dashboard</a>
                        <a href="{{url('sign-in')}}">Grades</a>
                        <a href="{{url('sign-in')}}">Calendar</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Resources</h5>
                    <div class="footer-links">
                        <a href="#">FAQs</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Contact</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> B.P. 6207 Avenue des Forces Armées Royales, Rabat 10100</p>
                    <p><i class="fas fa-envelope me-2"></i> admin@ensam.um5.ac.ma</p>
                    <p><i class="fas fa-phone me-2"></i>+212 5 37 56 40 62</p>
                </div>
            </div>
            <div class="copyright text-center">
                &copy; <span id="year"></span> ENSAM GradeHouse. All rights reserved.
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Toggler -->
    <div class="fixed z-50 hidden bottom-6 right-6 sm:block">
        <button
            class="inline-flex items-center justify-center text-white transition-colors rounded-full size-14 bg-brand-500 hover:bg-brand-600"
            style="border-radius: calc(infinity * 1px);"
            @click.prevent="darkMode = !darkMode"
        >
            <svg
                class="hidden fill-current dark:block"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M9.99998 1.5415C10.4142 1.5415 10.75 1.87729 10.75 2.2915V3.5415C10.75 3.95572 10.4142 4.2915 9.99998 4.2915C9.58577 4.2915 9.24998 3.95572 9.24998 3.5415V2.2915C9.24998 1.87729 9.58577 1.5415 9.99998 1.5415ZM10.0009 6.79327C8.22978 6.79327 6.79402 8.22904 6.79402 10.0001C6.79402 11.7712 8.22978 13.207 10.0009 13.207C11.772 13.207 13.2078 11.7712 13.2078 10.0001C13.2078 8.22904 11.772 6.79327 10.0009 6.79327ZM5.29402 10.0001C5.29402 7.40061 7.40135 5.29327 10.0009 5.29327C12.6004 5.29327 14.7078 7.40061 14.7078 10.0001C14.7078 12.5997 12.6004 14.707 10.0009 14.707C7.40135 14.707 5.29402 12.5997 5.29402 10.0001ZM15.9813 5.08035C16.2742 4.78746 16.2742 4.31258 15.9813 4.01969C15.6884 3.7268 15.2135 3.7268 14.9207 4.01969L14.0368 4.90357C13.7439 5.19647 13.7439 5.67134 14.0368 5.96423C14.3297 6.25713 14.8045 6.25713 15.0974 5.96423L15.9813 5.08035ZM18.4577 10.0001C18.4577 10.4143 18.1219 10.7501 17.7077 10.7501H16.4577C16.0435 10.7501 15.7077 10.4143 15.7077 10.0001C15.7077 9.58592 16.0435 9.25013 16.4577 9.25013H17.7077C18.1219 9.25013 18.4577 9.58592 18.4577 10.0001ZM14.9207 15.9806C15.2135 16.2735 15.6884 16.2735 15.9813 15.9806C16.2742 15.6877 16.2742 15.2128 15.9813 14.9199L15.0974 14.036C14.8045 13.7431 14.3297 13.7431 14.0368 14.036C13.7439 14.3289 13.7439 14.8038 14.0368 15.0967L14.9207 15.9806ZM9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088ZM5.96356 15.0972C6.25646 14.8043 6.25646 14.3295 5.96356 14.0366C5.67067 13.7437 5.1958 13.7437 4.9029 14.0366L4.01902 14.9204C3.72613 15.2133 3.72613 15.6882 4.01902 15.9811C4.31191 16.274 4.78679 16.274 5.07968 15.9811L5.96356 15.0972ZM4.29224 10.0001C4.29224 10.4143 3.95645 10.7501 3.54224 10.7501H2.29224C1.87802 10.7501 1.54224 10.4143 1.54224 10.0001C1.54224 9.58592 1.87802 9.25013 2.29224 9.25013H3.54224C3.95645 9.25013 4.29224 9.58592 4.29224 10.0001ZM4.9029 5.9637C5.1958 6.25659 5.67067 6.25659 5.96356 5.9637C6.25646 5.6708 6.25646 5.19593 5.96356 4.90303L5.07968 4.01915C4.78679 3.72626 4.31191 3.72626 4.01902 4.01915C3.72613 4.31204 3.72613 4.78692 4.01902 5.07981L4.9029 5.9637Z"
                    fill=""
                />
            </svg>
            <svg
                class="fill-current dark:hidden"
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M17.4547 11.97L18.1799 12.1611C18.265 11.8383 18.1265 11.4982 17.8401 11.3266C17.5538 11.1551 17.1885 11.1934 16.944 11.4207L17.4547 11.97ZM8.0306 2.5459L8.57989 3.05657C8.80718 2.81209 8.84554 2.44682 8.67398 2.16046C8.50243 1.8741 8.16227 1.73559 7.83948 1.82066L8.0306 2.5459ZM12.9154 13.0035C9.64678 13.0035 6.99707 10.3538 6.99707 7.08524H5.49707C5.49707 11.1823 8.81835 14.5035 12.9154 14.5035V13.0035ZM16.944 11.4207C15.8869 12.4035 14.4721 13.0035 12.9154 13.0035V14.5035C14.8657 14.5035 16.6418 13.7499 17.9654 12.5193L16.944 11.4207ZM16.7295 11.7789C15.9437 14.7607 13.2277 16.9586 10.0003 16.9586V18.4586C13.9257 18.4586 17.2249 15.7853 18.1799 12.1611L16.7295 11.7789ZM10.0003 16.9586C6.15734 16.9586 3.04199 13.8433 3.04199 10.0003H1.54199C1.54199 14.6717 5.32892 18.4586 10.0003 18.4586V16.9586ZM3.04199 10.0003C3.04199 6.77289 5.23988 4.05695 8.22173 3.27114L7.83948 1.82066C4.21532 2.77574 1.54199 6.07486 1.54199 10.0003H3.04199ZM6.99707 7.08524C6.99707 5.52854 7.5971 4.11366 8.57989 3.05657L7.48132 2.03522C6.25073 3.35885 5.49707 5.13487 5.49707 7.08524H6.99707Z"
                    fill=""
                />
            </svg>
        </button>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script defer src="{{ asset('bundle.js') }}"></script>

    <script>
        // Set current date and year
        document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        document.getElementById('year').textContent = new Date().getFullYear();

        // Back to top button
        window.addEventListener('scroll', function() {
            var backToTop = document.querySelector('.back-to-top');
            if (window.scrollY > 300) {
                backToTop.style.display = 'block';
            } else {
                backToTop.style.display = 'none';
            }
        });
    </script>
</div>
</html>
