@extends('layouts.app')

@section('title', 'Personal Portfolio')

@push('styles')
<style>
    body {
        background-color: #0a192f;
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
    }
    
    .profile-img {
        border: 4px solid #64ffda;
        box-shadow: 0 0 20px rgba(100, 255, 218, 0.3);
        animation: float 6s ease-in-out infinite;
        transform-origin: center;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    .btn-contact {
        background: linear-gradient(90deg, #64ffda, #4fc3f7);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(100, 255, 218, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(100, 255, 218, 0); }
        100% { box-shadow: 0 0 0 0 rgba(100, 255, 218, 0); }
    }
    
    .btn-contact:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(100, 255, 218, 0.3);
    }
    
    .tech-badge {
        background-color: rgba(100, 255, 218, 0.1);
        border: 1px solid rgba(100, 255, 218, 0.3);
        transition: all 0.3s ease;
    }
    
    .tech-badge:hover {
        transform: translateY(-3px);
        background-color: rgba(100, 255, 218, 0.2);
        box-shadow: 0 5px 15px rgba(100, 255, 218, 0.2);
    }
    
    .social-link {
        transition: all 0.3s ease;
    }
    
    .social-link:hover {
        transform: translateY(-5px) scale(1.1);
    }
    
    .fade-in {
        opacity: 0;
        animation: fadeIn 1s ease-in-out forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .typing-effect {
        overflow: hidden;
        border-right: 2px solid #64ffda;
        white-space: nowrap;
        animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
    }
    
    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }
    
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: #64ffda; }
    }
    
    .stagger-animation > * {
        opacity: 0;
        animation: fadeIn 0.5s ease-in-out forwards;
    }
    
    .stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
    .stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
    .stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
    .stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
    .stagger-animation > *:nth-child(5) { animation-delay: 0.5s; }
    .stagger-animation > *:nth-child(6) { animation-delay: 0.6s; }
    
    .glow {
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #64ffda; }
        to { text-shadow: 0 0 10px #fff, 0 0 15px #4fc3f7, 0 0 20px #4fc3f7; }
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
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
    }
</style>
@endpush

@section('content')
<!-- Background Particles -->
<div class="bg-particles" id="particles"></div>

<!-- Profile Image -->
<div class="mb-8 fade-in" style="animation-delay: 0.2s;">
    <img src="{{ asset('assets/potoprofile.jpg') }}" alt="Profile" class="w-40 h-40 rounded-full mx-auto profile-img object-cover">
</div>

<!-- Name -->
<h1 class="text-3xl font-bold mb-2 tracking-wider">MOHAMAD AKBAR SUGIH PANGESTU</h1>

<!-- Title -->
<h2 class="text-xl text-cyan-400 mb-8 fade-in typing-effect" style="animation-delay: 0.6s;">Fullstack Developer & Mobile Engineer</h2>

<!-- Description -->
<p class="text-lg mb-8 max-w-2xl mx-auto leading-relaxed fade-in" style="animation-delay: 0.8s;">
    Passionate about creating exceptional user experiences through clean code, innovative design, and cutting-edge technologies. Specializing in Laravel, Flutter, and modern web development.
</p>

<!-- Tech Stack -->
<div class="flex flex-wrap justify-center gap-2 mb-10 stagger-animation">
    <span class="tech-badge px-3 py-1 rounded-full text-sm">Flutter</span>
    <span class="tech-badge px-3 py-1 rounded-full text-sm">Laravel</span>
    <span class="tech-badge px-3 py-1 rounded-full text-sm">Dart</span>
    <span class="tech-badge px-3 py-1 rounded-full text-sm">Rest API</span>
    <span class="tech-badge px-3 py-1 rounded-full text-sm">PHP</span>
    <span class="tech-badge px-3 py-1 rounded-full text-sm">MySQL</span>
</div>

<!-- Contact Button -->
<button class="btn-contact px-8 py-3 rounded-full font-semibold text-gray-900 fade-in" style="animation-delay: 1.2s;">
    <i class="fas fa-envelope mr-2"></i> Contact Me
</button>

<!-- Social Links -->
<div class="flex justify-center gap-4 mt-8 fade-in" style="animation-delay: 1.4s;">
    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors social-link">
        <i class="fab fa-github text-2xl"></i>
    </a>
    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors social-link">
        <i class="fab fa-linkedin text-2xl"></i>
    </a>
    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors social-link">
        <i class="fab fa-twitter text-2xl"></i>
    </a>
    <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors social-link">
        <i class="fab fa-instagram text-2xl"></i>
    </a>
</div>
@endsection

@push('scripts')
<script>
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Create floating particles
    document.addEventListener('DOMContentLoaded', function() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 20;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random size between 5px and 15px
            const size = Math.random() * 10 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random position
            particle.style.left = `${Math.random() * 100}%`;
            
            // Random animation delay and duration
            particle.style.animationDelay = `${Math.random() * 15}s`;
            particle.style.animationDuration = `${Math.random() * 10 + 15}s`;
            
            particlesContainer.appendChild(particle);
        }
        
        // Add interaction to contact button
        const contactBtn = document.querySelector('.btn-contact');
        contactBtn.addEventListener('click', function() {
            // Create ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('absolute', 'bg-white', 'opacity-30', 'rounded-full');
            ripple.style.width = ripple.style.height = '40px';
            ripple.style.left = '50%';
            ripple.style.top = '50%';
            ripple.style.transform = 'translate(-50%, -50%) scale(0)';
            ripple.style.animation = 'ripple 0.6s ease-out';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: translate(-50%, -50%) scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endpush