<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Czech Rehabilitation Center | Your Medical Expert in Riyadh</title>
    <meta name="description" content="Integrated rehabilitation center with Czech medical expertise for over 15 years. Providing the best physical therapy and rehab in Riyadh.">
    <link rel="stylesheet" href="{{ asset('landing/style-en.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
            <div class="nav-logo">
                <img src="{{ asset('landing/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">

            </div>

            <nav class="nav-links">
                <a href="#" class="nav-link">Our Services</a>
                <a href="#" class="nav-link">Medical Team</a>
                <a href="#" class="nav-link">Our Branches</a>
                <a href="#" class="nav-link">Media</a>
                <a href="#" class="nav-link">About Center</a>
                <a href="#" class="nav-link">Contact Us</a>
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="nav-link" style="font-weight: 400;">AR</a>
            </nav>

            <div class="nav-actions">
                <button class="btn btn-primary">Book Now</button>
                <button class="btn btn-outline">Talk to Us</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container hero">
        <div class="hero-content">
            <h1 class="section-title">Rehabilitation Center with<br>Czech Medical Expertise</h1>
            <p class="section-desc">Best medical rehabilitation services by a global team to help you fully recover as quickly as possible with complete luxury.</p>
            <div style="display: flex; gap: 24px;">
                <button class="btn btn-primary">Book Now <i class="fas fa-chevron-right"></i></button>
                <button class="btn btn-outline">Talk to us for inquiries</button>
            </div>
        </div>
        <div class="hero-image-container">
            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2053&auto=format&fit=crop" alt="Medical Center">
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar">
        <div class="container" style="display: flex; justify-content: space-around; width: 100%;">
            <div class="stat-item">
                <h3>15<span>+</span></h3>
                <p>Years of Experience</p>
            </div>
            <div class="stat-item">
                <h3>3,900<span>+</span></h3>
                <p>Patients in 2025</p>
            </div>
            <div class="stat-item">
                <h3>70<span>+</span></h3>
                <p>Medical Team</p>
            </div>
            <div class="stat-item">
                <h3>99<span>%</span></h3>
                <p>Healing Rate</p>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section class="container" style="padding: 100px 0; text-align: center;">
        <h2 class="section-title">Watch Your Journey</h2>
        <div id="video-container"
             style="width: 100%; height: 600px; background: var(--bg-purple); border-radius: 20px; position: relative; overflow: hidden; cursor: pointer;"
             onclick="this.querySelector('#video-overlay').style.display='none'; this.querySelector('#main-video').style.display='block'; this.querySelector('#main-video').play();">

            <div id="video-overlay" style="width: 100%; height: 100%; position: absolute; z-index: 2;">
                <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=2070&auto=format&fit=crop" alt="Video Placeholder" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <div id="play-button" style="width: 96px; height: 96px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-play" style="font-size: 30px; color: var(--primary);"></i>
                    </div>
                </div>
            </div>
            <video id="main-video" style="width: 100%; height: 100%; object-fit: cover; display: none;" controls playsinline preload="metadata">
                <source src="https://mtarek.azq1.com/czech/videos/About_Home_Care.mov" type="video/mp4">
            </video>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="services-header">
                <div>
                    <h2 class="section-title">Rehabilitation Services<br>for All Ages</h2>
                </div>
                <button class="btn btn-primary" style="margin-bottom: 40px;">Book Now</button>
            </div>

            <div class="services-grid">
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>Adult Rehabilitation</h3>
                    <p>It is a long-established fact that a reader will be distracted by the readable content.</p>
                    <a href="#" class="more-btn">Read More <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>Pediatric Rehabilitation</h3>
                    <p>It is a long-established fact that a reader will be distracted by the readable content.</p>
                    <a href="#" class="more-btn">Read More <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card service-full" style="background-image: url('https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?q=80&w=2070&auto=format&fit=crop');">
                    <div style="max-width: 500px;">
                        <h3>Integrated Women's Medical Center</h3>
                        <p>It is a long-established fact that a reader will be distracted by the readable content.</p>
                        <a href="#" class="more-btn">Read More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="nav-logo" style="margin-bottom: 30px;">
                <img src="{{ asset('landing/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
                <!-- <img src="logo.png" alt="Logo" > -->
            </div>
            <p>Copyright Â© 2026 | All Rights Reserved</p>
        </div>
    </footer>

    <script src="{{ asset('landing/script.js') }}"></script>
</body>
</html>


