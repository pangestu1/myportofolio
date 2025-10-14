@extends('layouts.app')

@section('title', 'Personal Portfolio')

@push('styles')
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Inter', sans-serif;
            color: #0a192f;
            overflow-x: hidden;
        }

        #hero {
            width: 100%;
            background: linear-gradient(135deg, #0a192f 0%, #0f3a6e 100%);
            color: #e2e8f0;
            padding: 6rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            max-width: 64rem;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-container h1,
        .hero-container h2,
        .hero-container p {
            color: inherit;
        }

        .hero-container .social-link {
            color: #cbd5f5;
        }

        .hero-container .tech-badge {
            background-color: rgba(100, 255, 218, 0.18);
            border-color: rgba(100, 255, 218, 0.5);
            color: #e8fffe;
        }

        .hero-container .tech-badge:hover {
            transform: translateY(-3px);
            background-color: rgba(100, 255, 218, 0.3);
            box-shadow: 0 10px 22px rgba(100, 255, 218, 0.35);
        }

        .hero-container .social-link:hover {
            color: #64ffda;
        }

        .white-section {
            background-color: #ffffff;
            color: #0a192f;
        }

        .white-section .text-gray-400 {
            color: #475569;
        }

        .white-section .text-gray-300 {
            color: #334155;
        }

        .white-section h2,
        .white-section h3,
        .white-section h4,
        .white-section p,
        .white-section li,
        .white-section span {
            color: inherit;
        }

        .white-section .text-gray-400 {
            color: #475569;
        }

        .white-section .text-gray-300 {
            color: #334155;
        }

        .white-section .text-gray-200 {
            color: #1f2937;
        }

        .white-section .social-link {
            color: #475569;
        }

        .white-section .social-link:hover {
            color: #0f3a6e;
        }

        .tech-badge {
            background-color: #ffffff;
            border: 1px solid rgba(15, 58, 110, 0.16);
            color: #0a192f;
            box-shadow: 0 10px 20px rgba(15, 58, 110, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .tech-badge:hover {
            transform: translateY(-3px);
            border-color: rgba(15, 58, 110, 0.28);
            box-shadow: 0 16px 32px rgba(15, 58, 110, 0.18);
        }

        .project-card {
            border: 1px solid rgba(15, 58, 110, 0.18);
            background-color: #ffffff;
            color: #0a192f;
            box-shadow: 0 18px 35px rgba(15, 58, 110, 0.18);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            border-color: rgba(15, 58, 110, 0.4);
            box-shadow: 0 24px 45px rgba(15, 58, 110, 0.24);
        }

        .project-card h4,
        .project-card p,
        .project-card li {
            color: #0a192f;
        }

        .text-muted {
            color: #64748b;
        }

        .modal-content {
            background-color: #ffffff;
            color: #0a192f;
            box-shadow: 0 24px 45px rgba(15, 58, 110, 0.26);
        }

        .profile-img {
            border: 4px solid #64ffda;
            box-shadow: 0 0 20px rgba(100, 255, 218, 0.3);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .btn-contact {
            background: linear-gradient(90deg, #64ffda, #4fc3f7);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(100, 255, 218, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(100, 255, 218, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(100, 255, 218, 0);
            }
        }

        .btn-contact:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(100, 255, 218, 0.3);
        }


        .social-link {
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-5px) scale(1.1);
        }

        /* --- Perubahan Utama untuk Animasi Scroll --- */
        .fade-element {
            opacity: 0;
            /* Awalnya tersembunyi */
            transform: translateY(30px);
            /* Awalnya sedikit ke bawah */
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .glow {
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #64ffda;
            }

            to {
                text-shadow: 0 0 10px #fff, 0 0 15px #4fc3f7, 0 0 20px #4fc3f7;
            }
        }

        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background-color: rgba(100, 255, 218, 0.5);
            border-radius: 50%;
            animation: float-particle 15s infinite linear;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .progress-bar {
            background-color: #1e3a5f;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(90deg, #64ffda, #4fc3f7);
            height: 100%;
            width: 0;
            /* Start at 0 for animation */
            transition: width 1.5s ease-in-out;
        }

        .project-card {
            border: 1px solid rgba(15, 58, 110, 0.18);
            background-color: #ffffff;
            color: #0a192f;
            box-shadow: 0 18px 35px rgba(15, 58, 110, 0.18);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            border-color: rgba(15, 58, 110, 0.4);
            box-shadow: 0 24px 45px rgba(15, 58, 110, 0.24);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(10, 25, 47, 0.85);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            padding: 1.5rem;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background-color: rgba(10, 25, 47, 0.95);
            border: 1px solid rgba(100, 255, 218, 0.3);
            border-radius: 0.75rem;
            padding: 2rem;
            max-width: 32rem;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            color: #e2e8f0;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .modal-close:hover {
            color: #64ffda;
        }

        .modal-features li::marker {
            color: #64ffda;
        }

        .modal-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .modal-gallery img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 1px solid rgba(100, 255, 218, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .modal-gallery img:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.5);
        }

        .rotating-image {
            transition: opacity 0.6s ease;
        }

        .gallery-lightbox {
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 60;
            padding: 2rem;
        }

        .gallery-lightbox.active {
            display: flex;
        }

        .gallery-lightbox img {
            max-width: min(90vw, 1200px);
            max-height: 90vh;
            border-radius: 0.75rem;
            box-shadow: 0 25px 45px rgba(15, 23, 42, 0.6);
            object-fit: contain;
        }

        .section-padding {
            padding: 80px 0;
        }
    </style>
@endpush

@section('content')
    <!-- Background Particles -->
    <div class="bg-particles" id="particles"></div>

    <!-- Hero Section -->
    <section id="hero" class="min-h-screen flex items-center justify-center text-center fade-element px-6">
        <div class="hero-container">
            <!-- Profile Image -->
            <div class="mb-8 fade-in">
                <img src="{{ asset('assets/potoprofile.jpg') }}" alt="Profile"
                    class="w-40 h-40 rounded-full mx-auto profile-img object-cover">
            </div>

            <!-- Name -->
            <h1 class="text-4xl font-bold mb-2 tracking-wider fade-in">MOHAMAD AKBAR SUGIH PANGESTU</h1>

            <!-- Title -->
            <h2 class="text-xl text-cyan-300 mb-8 fade-in">Fullstack Developer & Mobile Engineer</h2>

            <!-- Description -->
            <p class="text-lg mb-8 max-w-2xl mx-auto leading-relaxed fade-in">
                Passionate about creating exceptional user experiences through clean code, innovative design, and
                cutting-edge technologies. Specializing in Laravel, Flutter, and modern web development.
            </p>

            <!-- Tech Stack -->
            <div class="flex flex-wrap justify-center gap-2 mb-10 fade-in">
                <span class="tech-badge px-3 py-1 rounded-full text-sm">Flutter</span>
                <span class="tech-badge px-3 py-1 rounded-full text-sm">Laravel</span>
                <span class="tech-badge px-3 py-1 rounded-full text-sm">Dart</span>
                <span class="tech-badge px-3 py-1 rounded-full text-sm">Rest API</span>
                <span class="tech-badge px-3 py-1 rounded-full text-sm">PHP</span>
                <span class="tech-badge px-3 py-1 rounded-full text-sm">MySQL</span>
            </div>

            <!-- Contact Button -->
            <a href="https://wa.me/6289681587936" target="_blank" rel="noopener noreferrer"
                class="btn-contact px-8 py-3 rounded-full font-semibold text-gray-900 fade-in inline-flex items-center justify-center">
                <i class="fas fa-envelope mr-2"></i> Contact Me
            </a>

            <!-- Social Links -->
            <div class="flex justify-center gap-4 mt-8 fade-in">
                <a href="https://github.com/pangestu10" class="text-gray-200 hover:text-cyan-400 transition-colors social-link">
                    <i class="fab fa-github text-2xl"></i>
                </a>
                <a href="https://www.instagram.com/pangeeeestu10/?next=%2F&hl=id" class="text-gray-200 hover:text-cyan-400 transition-colors social-link">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="about" class="section-padding fade-element white-section">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 fade-in">
                    <h2 class="text-4xl font-bold text-cyan-400 mb-2">About Me</h2>
                    <p class="text-muted mb-4">Fullstack Developer with a Focus on Frontend</p>
                    <h3 class="text-2xl font-semibold mb-4 text-slate-900">MOHAMAD AKBAR SUGIH PANGESTU</h3>
                    <p class="text-slate-700 leading-relaxed">
                        I am a Fullstack Developer with a primary focus on frontend development and mobile applications. My
                        expertise includes Laravel, Flutter, and various modern web technologies. I have successfully
                        completed several exciting projects, including News App (a news reading platform), ShopBar (an
                        online sales application), and Todo (a task management app).

                        My educational background includes graduation from Sanbercode, a training program under PT Santai
                        Berkualitas Syberindo (Sanbersy), which is officially registered with KEMENKUMHAM, as well as from
                        SMK Mitra Industri MM2100 Vocational School. I specialize in creating responsive and user-friendly
                        interfaces and smooth mobile experiences, while maintaining the ability to handle backend
                        requirements when needed.
                    </p>
                </div>
                <div class="lg:w-1/2 fade-in">
                    <div class="border border-cyan-500 rounded-lg p-6 bg-white shadow-2xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-code text-cyan-500 text-2xl mr-3"></i>
                            <h4 class="text-xl font-semibold text-slate-900">Introduction</h4>
                        </div>
                        <ul class="space-y-2 text-slate-600">
                            <li><i class="fas fa-check text-cyan-500 mr-2"></i> Specializing in Flutter & Laravel</li>
                            <li><i class="fas fa-check text-cyan-500 mr-2"></i> Skills in UI/UX Design Principles</li>
                            {{-- <li><i class="fas fa-check text-cyan-400 mr-2"></i> Career Journey in Software Engineering</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills & Technology Section -->
    <section id="skills" class="section-padding fade-element white-section">
        <div class="container mx-auto px-6 max-w-6xl">
            <h2 class="text-4xl font-bold text-center text-cyan-400 mb-12 fade-in">Skills & Technology</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Frontend & Mobile -->
                <div class="fade-in">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-200">Frontend & Mobile Expertise</h3>
                    <div class="space-y-4">
                        <div class="skill-item" data-percent="95">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Flutter</span>
                                <span class="text-cyan-400">95%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 95%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Dart</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">HTML & CSS</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Firebase</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">GetX</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="95">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Bootstrap</span>
                                <span class="text-cyan-400">95%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="95">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Git</span>
                                <span class="text-cyan-400">95%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="85">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">JavaScript</span>
                                <span class="text-cyan-400">85%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Backend & API -->
                <div class="fade-in">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-200">Backend & API Integration</h3>
                    <div class="space-y-4">
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Laravel</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">PHP</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Postman</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Laravel Breeze</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">MVC Model-View-Controller</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="90">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">Middleware</span>
                                <span class="text-cyan-400">90%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 90%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="88">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">MySQL</span>
                                <span class="text-cyan-400">88%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 88%;"></div>
                            </div>
                        </div>
                        <div class="skill-item" data-percent="80">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">REST API</span>
                                <span class="text-cyan-400">80%</span>
                            </div>
                            <div class="progress-bar h-3 rounded-full">
                                <div class="progress-fill rounded-full" style="width: 80%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section id="featured-projects" class="section-padding fade-element">
        <div class="container mx-auto px-6 max-w-6xl">
            <h2 class="text-4xl font-bold text-center text-400 mb-12 fade-in">Featured Frontend & Mobile Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- <div class="project-card rounded-lg p-6 fade-in">
                    <i class="fas fa-comments text-cyan-400 text-3xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Web Threads</h4>
                    <p class="text-gray-400">A dynamic social media site built with modern web technologies for real-time
                        interaction.</p>
                </div>
                <div class="project-card rounded-lg p-6 fade-in">
                    <i class="fas fa-gamepad text-cyan-400 text-3xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">Whatw</h4>
                    <p class="text-gray-400">An engaging mobile quiz game app designed to test knowledge across various
                        categories.</p>
                </div> --}}
                <div class="project-card rounded-lg p-6 fade-in">
                    <i class="fas fa-shopping-cart text-cyan-400 text-3xl mb-4"></i>
                    <h4 class="text-xl font-semibold mb-2">E-Commerce App</h4>
                    <p class="text-gray-400">A full-featured e-commerce mobile application with a seamless checkout
                        experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Frontend-First Approach Section -->
    <section id="approach" class="section-padding bg-white fade-element">
        <div class="container mx-auto px-6 max-w-4xl text-center shadow-2xl rounded-3xl py-16">
            <h2 class="text-4xl font-bold text-500 mb-6 fade-in">Frontend - First Development Approach</h2>
            <p class="text-lg text-slate-700 mb-8 fade-in">
                I prioritize the user interface and experience, building responsive and accessible designs that function
                flawlessly across all devices. My focus is on creating fast, interactive, and visually appealing
                applications.
            </p>
            <div class="flex flex-wrap justify-center gap-4 mb-12 fade-in">
                <span class="tech-badge px-4 py-2 rounded-full text-base">User Experience Focus</span>
                <span class="tech-badge px-4 py-2 rounded-full text-base">Mobile-First Design</span>
                <span class="tech-badge px-4 py-2 rounded-full text-base">Frontend Excellence</span>
            </div>
            <h3 class="text-3xl font-semibold text-slate-900 fade-in">My Projects</h3>
        </div>
    </section>

    <!-- Detailed Project Showcase Section -->
    <section id="detailed-projects" class="section-padding fade-element">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="project-card rounded-lg p-6 fade-in">
                    <img id="shopbarShowcaseImage" src="{{ asset('assets/shopbar/photo_6298407636956810248_y.jpg') }}" alt="ShopBar showcase"
                        class="w-full h-64 object-cover rounded-lg mb-4 rotating-image">
                    <h4 class="text-2xl font-semibold mb-3">ShopBar</h4>
                    <p class="text-gray-400 mb-4">A lightweight Point of Sale system for retail businesses.</p>
                    <h5 class="font-semibold text-400 mb-2">Key Features:</h5>
                    <ul class="text-gray-300 text-sm mb-4 space-y-1">
                        <li>- Product & Inventory Management</li>
                        <li>- Sales Reporting & Analytics</li>
                        <li>- Simple & Intuitive Interface</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="text-xs tech-badge px-2 py-1">Flutter</span>
                        <span class="text-xs tech-badge px-2 py-1">Firebase</span>
                        <span class="text-xs tech-badge px-2 py-1">GetX</span>
                    </div>
                    <button data-project="shopbar"
                        class="project-detail-trigger text-cyan-400 hover:underline flex items-center gap-1">
                        Click to view details <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                {{-- <!-- BeetKiosk -->
                <div class="project-card rounded-lg p-6 fade-in fade-element">
                    <img src="https://picsum.photos/seed/beetkiosk/300/600.jpg" alt="BeetKiosk"
                        class="w-full h-64 object-cover rounded-lg mb-4">
                    <h4 class="text-2xl font-semibold mb-3">NewsApp</h4>
                    <p class="text-gray-400 mb-4">A self-service ordering kiosk for restaurants and cafes.</p>
                    <h5 class="font-semibold text-400 mb-2">Key Features:</h5>
                    <ul class="text-gray-300 text-sm mb-4 space-y-1">
                        <li>- Category & Item Filtering</li>
                        <li>- Real-time Order Processing</li>
                        <li>- Customizable UI Themes</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="text-xs tech-badge px-2 py-1">React Native</span>
                        <span class="text-xs tech-badge px-2 py-1">Express.js</span>
                        <span class="text-xs tech-badge px-2 py-1">PostgreSQL</span>
                    </div>
                    <button data-project="newsapp"
                        class="project-detail-trigger text-cyan-400 hover:underline flex items-center gap-1">
                        Click to view details <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <!-- Backoffice -->
                <div class="project-card rounded-lg p-6 fade-in fade-element">
                    <img src="https://picsum.photos/seed/backoffice/300/600.jpg" alt="Backoffice"
                        class="w-full h-64 object-cover rounded-lg mb-4">
                    <h4 class="text-2xl font-semibold mb-3">ToDo</h4>
                    <p class="text-gray-400 mb-4">A comprehensive admin dashboard for business management.</p>
                    <h5 class="font-semibold text-400 mb-2">Key Features:</h5>
                    <ul class="text-gray-300 text-sm mb-4 space-y-1">
                        <li>- User & Role Management</li>
                        <li>- Data Analytics & Visualization</li>
                        <li>- System Configuration</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="text-xs tech-badge px-2 py-1">Laravel</span>
                        <span class="text-xs tech-badge px-2 py-1">Vue.js</span>
                        <span class="text-xs tech-badge px-2 py-1">API</span>
                    </div>
                    <button data-project="todo"
                        class="project-detail-trigger text-cyan-400 hover:underline flex items-center gap-1">
                        Click to view details <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section> --}}

    <div id="projectModal" class="modal-overlay">
        <div class="modal-content">
            <button id="closeProjectModal" class="modal-close" aria-label="Close project details">
                <i class="fas fa-times"></i>
            </button>
            <div id="projectModalBody"></div>
        </div>
    </div>

    <div id="galleryLightbox" class="gallery-lightbox" aria-hidden="true">
        <img id="galleryLightboxImage" src="" alt="Project gallery preview">
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const projectDetails = {
                shopbar: {
                    title: 'ShopBar - Point of Sale System',
                    overview: 'ShopBar provides an intuitive POS experience tailored for small to medium retail businesses with real-time inventory synchronization.',
                    features: ['Product & Inventory Management', 'Sales Reporting & Analytics', 'Simple & Intuitive Interface'],
                    techStack: ['Flutter', 'Node.js', 'MySQL'],
                    gallery: [
                        '{{ asset("assets/shopbar/photo_6298407636956810248_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810249_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810250_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810251_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810252_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810253_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810254_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810255_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810256_y.jpg") }}',
                        '{{ asset("assets/shopbar/photo_6298407636956810257_y.jpg") }}'
                    ]
                },
                newsapp: {
                    title: 'NewsApp - Personalized News Reader',
                    overview: 'NewsApp curates personalized headlines with offline support and category-based browsing for mobile-first audiences.',
                    features: ['Category & Item Filtering', 'Real-time Updates', 'Offline Reading Mode'],
                    techStack: ['React Native', 'Express.js', 'PostgreSQL']
                },
                todo: {
                    title: 'ToDo - Productivity Dashboard',
                    overview: 'ToDo centralizes task management, team collaboration, and analytics within a responsive, data-driven dashboard.',
                    features: ['User & Role Management', 'Data Analytics & Visualization', 'System Configuration'],
                    techStack: ['Laravel', 'Vue.js', 'REST API']
                }
            };

            const projectModal = document.getElementById('projectModal');
            const projectModalBody = document.getElementById('projectModalBody');
            const closeProjectModalButton = document.getElementById('closeProjectModal');
            const galleryLightbox = document.getElementById('galleryLightbox');
            const galleryLightboxImage = document.getElementById('galleryLightboxImage');

            function buildFeatureList(items = []) {
                return `
                    <ul class="modal-features list-disc list-inside space-y-1">
                        ${items.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                `;
            }

            function buildTechBadgeList(tech = []) {
                return `
                    <div class="flex flex-wrap gap-2 mt-3">
                        ${tech.map(item => `<span class="tech-badge px-2 py-1 text-xs">${item}</span>`).join('')}
                    </div>
                `;
            }

            const shopbarImages = projectDetails.shopbar.gallery || [];
            let currentShowcaseIndex = 0;

            function rotateShopbarImage() {
                if (!shopbarImages.length) return;
                const showcaseImage = document.getElementById('shopbarShowcaseImage');
                if (!showcaseImage) return;

                currentShowcaseIndex = (currentShowcaseIndex + 1) % shopbarImages.length;
                showcaseImage.style.opacity = 0;

                setTimeout(() => {
                    showcaseImage.src = shopbarImages[currentShowcaseIndex];
                    showcaseImage.style.opacity = 1;
                }, 300); // match transition duration /2 for smoother fade
            }

            if (shopbarImages.length) {
                setInterval(rotateShopbarImage, 10000);
            }

            function openProjectModal(projectKey) {
                const details = projectDetails[projectKey];
                if (!details) {
                    projectModalBody.innerHTML = `<p class="text-red-300">Details not available.</p>`;
                } else {
                    projectModalBody.innerHTML = `
                        <h3 class="text-2xl font-semibold text-cyan-400 mb-3">${details.title}</h3>
                        <p class="text-gray-300 mb-4">${details.overview}</p>
                        <h4 class="text-lg font-semibold text-cyan-300 mb-2">Key Features</h4>
                        ${buildFeatureList(details.features)}
                        <h4 class="text-lg font-semibold text-cyan-300 mt-4 mb-2">Tech Stack</h4>
                        ${buildTechBadgeList(details.techStack)}
                        ${details.gallery && details.gallery.length ? `
                            <h4 class="text-lg font-semibold text-cyan-300 mt-4 mb-2">Project Gallery</h4>
                            <div class="modal-gallery">
                                ${details.gallery.map((src, index) => `<button class="gallery-image-trigger" data-image="${src}" aria-label="View ${details.title} image ${index + 1}"><img src="${src}" alt="${details.title} preview ${index + 1}"></button>`).join('')}
                            </div>
                        ` : ''}
                    `;
                }

                projectModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeProjectModal() {
                projectModal.classList.remove('active');
                if (!galleryLightbox.classList.contains('active')) {
                    document.body.style.overflow = '';
                }
            }

            document.querySelectorAll('.project-detail-trigger').forEach(button => {
                button.addEventListener('click', () => {
                    const projectKey = button.dataset.project;
                    openProjectModal(projectKey);
                });
            });

            document.addEventListener('click', event => {
                const trigger = event.target.closest('.gallery-image-trigger');
                if (trigger) {
                    const imageSrc = trigger.dataset.image;
                    if (imageSrc) {
                        galleryLightboxImage.src = imageSrc;
                        galleryLightbox.classList.add('active');
                        galleryLightbox.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                    }
                }
            });

            closeProjectModalButton.addEventListener('click', closeProjectModal);

            projectModal.addEventListener('click', event => {
                if (event.target === projectModal) {
                    closeProjectModal();
                }
            });

            galleryLightbox.addEventListener('click', event => {
                if (event.target === galleryLightbox || event.target === galleryLightboxImage) {
                    galleryLightbox.classList.remove('active');
                    galleryLightbox.setAttribute('aria-hidden', 'true');
                    galleryLightboxImage.src = '';
                    document.body.style.overflow = '';
                }
            });

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    if (galleryLightbox.classList.contains('active')) {
                        galleryLightbox.classList.remove('active');
                        galleryLightbox.setAttribute('aria-hidden', 'true');
                        galleryLightboxImage.src = '';
                        document.body.style.overflow = '';
                    } else if (projectModal.classList.contains('active')) {
                        closeProjectModal();
                    }
                }
            });

            // Create floating particles
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 15}s`;
                particle.style.animationDuration = `${Math.random() * 10 + 15}s`;

                particlesContainer.appendChild(particle);
            }

            // --- Perubahan Utama untuk Animasi Scroll ---
            // Intersection Observer untuk Fade In / Fade Out
            const fadeElements = document.querySelectorAll('.fade-element');

            const observerOptions = {
                root: null, // Menggunakan viewport sebagai root
                rootMargin: '0px',
                threshold: [0, 0.1, 0.5, 1] // Memantau di berbagai titik visibilitas
            };

            const fadeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const element = entry.target;
                    const rect = entry.boundingClientRect;

                    if (entry.isIntersecting) {
                        // Elemen sedang masuk atau berada di dalam viewport
                        // Tampilkan elemen dengan fade-in
                        element.style.opacity = 1;
                        element.style.transform = 'translateY(0)';

                        // Animasi progress bar khusus untuk skill
                        if (element.classList.contains('skill-item')) {
                            const progressFill = element.querySelector('.progress-fill');
                            const percent = element.dataset.percent;
                            // Reset dan animasikan ulang untuk memastikan berjalan setiap kali terlihat
                            progressFill.style.width = '0%';
                            setTimeout(() => {
                                progressFill.style.width = percent + '%';
                            }, 200);
                        }
                    } else {
                        // Elemen di luar viewport
                        if (rect.top > 0) {
                            // Elemen ada di BAWAH viewport (belum terlihat)
                            // Set ke kondisi awal (tersembunyi di bawah)
                            element.style.opacity = 0;
                            element.style.transform = 'translateY(30px)';
                        } else {
                            // Elemen ada di ATAS viewport (sudah dilewati)
                            // Set ke kondisi akhir (tersembunyi di atas)
                            element.style.opacity = 0;
                            element.style.transform = 'translateY(-30px)';
                        }
                    }
                });
            }, observerOptions);

            // Mulai mengamati semua elemen dengan class 'fade-element'
            fadeElements.forEach(el => {
                fadeObserver.observe(el);
            });

            // Tambahkan class 'fade-element' ke semua elemen yang ingin dianimasikan
            // Ini dilakukan via JS untuk memisahkan logika dari markup HTML
            const sections = document.querySelectorAll('section > div, section > h2, section > p');
            sections.forEach(el => {
                // Hindari elemen di dalam hero section agar langsung muncul
                if (!el.closest('#hero')) {
                    el.classList.add('fade-element');
                }
            });

            // Terapkan ke elemen spesifik yang mungkin terlewat
            document.querySelectorAll('.project-card').forEach(el => el.classList.add('fade-element'));
            document.querySelectorAll('.skill-item').forEach(el => el.classList.add('fade-element'));

            // Amati kembali elemen-elemen yang baru ditambahi class
            document.querySelectorAll('.fade-element').forEach(el => {
                fadeObserver.observe(el);
            });

        });
    </script>
@endpush
