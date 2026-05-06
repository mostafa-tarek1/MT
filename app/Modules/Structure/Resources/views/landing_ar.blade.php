<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ø§Ù„Ù…Ø±ÙƒØ² Ø§Ù„ØªØ´ÙŠÙƒÙŠ Ù„Ø¥Ø¹Ø§Ø¯Ø© Ø§Ù„ØªØ£Ù‡ÙŠÙ„ | Ø®Ø¨ÙŠØ±Ùƒ Ø§Ù„Ø·Ø¨ÙŠ ÙÙŠ Ø§Ù„Ø±ÙŠØ§Ø¶</title>
    <meta name="description" content="Ù…Ø±ÙƒØ² Ø¥Ø¹Ø§Ø¯Ø© ØªØ£Ù‡ÙŠÙ„ Ù…ØªÙƒØ§Ù…Ù„ Ø¨Ø®Ø¨Ø±Ø§Øª Ø·Ø¨ÙŠØ© ØªØ´ÙŠÙƒÙŠØ© ØªØ²ÙŠØ¯ Ø¹Ù† 15 Ø³Ù†Ø©. Ù†Ù‚Ø¯Ù… Ø£ÙØ¶Ù„ Ø®Ø¯Ù…Ø§Øª Ø§Ù„Ø¹Ù„Ø§Ø¬ Ø§Ù„Ø·Ø¨ÙŠØ¹ÙŠ ÙˆØ§Ù„ØªØ£Ù‡ÙŠÙ„ ÙÙŠ Ø§Ù„Ø±ÙŠØ§Ø¶.">
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
            <div class="nav-logo">
                <img src="{{ asset('landing/logo.png') }}" alt="Ø§Ù„Ù…Ø±ÙƒØ² Ø§Ù„ØªØ´ÙŠÙƒÙŠ Ù„Ø¥Ø¹Ø§Ø¯Ø© Ø§Ù„ØªØ£Ù‡ÙŠÙ„">
            </div>

            <nav class="nav-links">
                <a href="#" class="nav-link">Ø®Ø¯Ù…Ø§ØªÙ†Ø§ Ø§Ù„Ø¹Ù„Ø§Ø¬ÙŠØ©</a>
                <a href="#" class="nav-link">Ø§Ù„Ø·Ø§Ù‚Ù… Ø§Ù„Ø·Ø¨ÙŠ</a>
                <a href="#" class="nav-link">ÙØ±ÙˆØ¹Ù†Ø§</a>
                <a href="#" class="nav-link">Ø§Ù„Ù…ÙŠØ¯ÙŠØ§</a>
                <a href="#" class="nav-link">Ø­ÙˆÙ„ Ø§Ù„Ù…Ø±ÙƒØ²</a>
                <a href="#" class="nav-link">Ø§ØªØµÙ„ Ø¨Ù†Ø§</a>
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="nav-link" style="font-weight: 400;">EN</a>
            </nav>

            <div class="nav-actions">
                <button class="btn btn-primary">Ø§Ø­Ø¬Ø² Ù…ÙˆØ¹Ø¯ Ø§Ù„Ø§Ù†</button>
                <button class="btn btn-outline">ØªØ­Ø¯Ø« Ù…Ø¹Ù†Ø§</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container hero">
        <div class="hero-content">
            <h1 class="section-title">Ù…Ø±ÙƒØ² Ø¥Ø¹Ø§Ø¯Ø© ØªØ£Ù‡ÙŠÙ„ Ø¨Ø®Ø¨Ø±Ø§Øª<br>Ø·Ø¨ÙŠØ© ØªØ´ÙŠÙƒÙŠØ©</h1>
            <p class="section-desc">Ø§ÙØ¶Ù„ Ø®Ø¯Ù…Ø§Øª Ø¥Ø¹Ø§Ø¯Ø© ØªØ£Ù‡ÙŠÙ„ Ø·Ø¨ÙŠ Ø¨Ø£ÙŠØ¯ÙŠ ÙØ±ÙŠÙ‚ Ø¹Ø§Ù„Ù…ÙŠ Ù„Ù…Ø³Ø§Ø¹Ø¯ØªÙƒ Ø¹Ù„Ù‰ Ø§Ù„Ø´ÙØ§Ø¡ Ø§Ù„ØªØ§Ù… Ø¨Ø§Ø³Ø±Ø¹ ÙˆÙ‚Øª ÙˆØ¨Ø±ÙØ§Ù‡ÙŠØ© ØªØ§Ù…Ø©</p>
            <div style="display: flex; gap: 24px;">
                <button class="btn btn-primary">Ø§Ø­Ø¬Ø² Ù…ÙˆØ¹Ø¯ Ø§Ù„Ø§Ù† <i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline">ØªØ­Ø¯Ø« Ù…Ø¹Ù†Ø§ Ù„Ù„Ø¥Ø¬Ø§Ø¨Ø© Ø¹Ù„Ù‰ Ø§Ø³ØªÙØ³Ø§Ø±Ø§ØªÙƒ</button>
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
                <p>Ø³Ù†Ø© Ø®Ø¨Ø±Ø©</p>
            </div>
            <div class="stat-item">
                <h3>3.900<span>+</span></h3>
                <p>Ù…Ø±ÙŠØ¶ Ù„Ø¹Ø§Ù… 2025</p>
            </div>
            <div class="stat-item">
                <h3>70<span>+</span></h3>
                <p>Ø§Ù„ÙØ±ÙŠÙ‚ Ø§Ù„Ø·Ø¨ÙŠ</p>
            </div>
            <div class="stat-item">
                <h3>99<span>%</span></h3>
                <p>Ù†Ø³Ø¨Ø© Ø§Ù„Ø´ÙØ§Ø¡</p>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section class="container" style="padding: 100px 0; text-align: center;">
        <h2 class="section-title">Ø´Ø§Ù‡Ø¯ Ø±Ø­Ù„Ø© Ø¹Ù„Ø§Ø¬Ùƒ</h2>
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
                    <h2 class="section-title">Ø®Ø¯Ù…Ø§Øª Ø¥Ø¹Ø§Ø¯Ø© ØªØ£Ù‡ÙŠÙ„<br>Ù„Ø¬Ù…ÙŠØ¹ Ø§Ù„Ø§Ø¹Ù…Ø§Ø±</h2>
                </div>
                <button class="btn btn-primary" style="margin-bottom: 40px;">Ø§Ø­Ø¬Ø² Ù…ÙˆØ¹Ø¯ Ø§Ù„Ø§Ù†</button>
            </div>

            <div class="services-grid">
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>Ø®Ø¯Ù…Ø§Øª ØªØ£Ù‡ÙŠÙ„ Ø§Ù„Ø¨Ø§Ù„ØºÙŠÙ†</h3>
                    <p>Ù‡Ù†Ø§Ùƒ Ø­Ù‚ÙŠÙ‚Ø© Ù…Ø«Ø¨ØªØ© Ù…Ù†Ø° Ø²Ù…Ù† Ø·ÙˆÙŠÙ„ ÙˆÙ‡ÙŠ Ø£Ù† Ø§Ù„Ù…Ø­ØªÙˆÙ‰ Ø§Ù„Ù…Ù‚Ø±ÙˆØ¡ Ù„ØµÙØ­Ø© Ù…Ø§ Ø³ÙŠÙ„Ù‡ÙŠ Ø§Ù„Ù‚Ø§Ø±Ø¦ Ø¹Ù† Ø§Ù„ØªØ±ÙƒÙŠØ².</p>
                    <a href="#" class="more-btn">Ø¹Ø±Ø¶ Ø§Ù„Ù…Ø²ÙŠØ¯ <i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>Ø®Ø¯Ù…Ø§Øª ØªØ£Ù‡ÙŠÙ„ Ø§Ù„Ø§Ø·ÙØ§Ù„</h3>
                    <p>Ù‡Ù†Ø§Ùƒ Ø­Ù‚ÙŠÙ‚Ø© Ù…Ø«Ø¨ØªØ© Ù…Ù†Ø° Ø²Ù…Ù† Ø·ÙˆÙŠÙ„ ÙˆÙ‡ÙŠ Ø£Ù† Ø§Ù„Ù…Ø­ØªÙˆÙ‰ Ø§Ù„Ù…Ù‚Ø±ÙˆØ¡ Ù„ØµÙØ­Ø© Ù…Ø§ Ø³ÙŠÙ„Ù‡ÙŠ Ø§Ù„Ù‚Ø§Ø±Ø¦ Ø¹Ù† Ø§Ù„ØªØ±ÙƒÙŠØ².</p>
                    <a href="#" class="more-btn">Ø¹Ø±Ø¶ Ø§Ù„Ù…Ø²ÙŠØ¯ <i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="service-card service-full" style="background-image: url('https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?q=80&w=2070&auto=format&fit=crop');">
                    <div style="max-width: 500px;">
                        <h3>Ù…Ø±ÙƒØ² Ø·Ø¨ÙŠ Ù…ØªÙƒØ§Ù…Ù„ Ù„Ù„Ø³ÙŠØ¯Ø§Øª Ø¨Ø·Ø§Ù‚Ù… Ù†Ø³Ø§Ø¦ÙŠ</h3>
                        <p>Ù‡Ù†Ø§Ùƒ Ø­Ù‚ÙŠÙ‚Ø© Ù…Ø«Ø¨ØªØ© Ù…Ù†Ø° Ø²Ù…Ù† Ø·ÙˆÙŠÙ„ ÙˆÙ‡ÙŠ Ø£Ù† Ø§Ù„Ù…Ø­ØªÙˆÙ‰ Ø§Ù„Ù…Ù‚Ø±ÙˆØ¡ Ù„ØµÙØ­Ø© Ù…Ø§ Ø³ÙŠÙ„Ù‡ÙŠ Ø§Ù„Ù‚Ø§Ø±Ø¦ Ø¹Ù† Ø§Ù„ØªØ±ÙƒÙŠØ².</p>
                        <a href="#" class="more-btn">Ø¹Ø±Ø¶ Ø§Ù„Ù…Ø²ÙŠØ¯ <i class="fas fa-chevron-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branches Section -->
    <section style="background: var(--bg-lavender); padding: 100px 0;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-size: 36px; margin-bottom: 15px;">ÙØ±ÙˆØ¹Ù†Ø§ Ø¯Ø§Ø®Ù„ Ù…Ø¯ÙŠÙ†Ø© Ø§Ù„Ø±ÙŠØ§Ø¶</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                <div style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">Ø§Ù„Ù…Ø±ÙƒØ² Ø§Ù„ØªØ´ÙŠÙƒÙŠ Ù„Ù„Ø³ÙŠØ¯Ø§Øª</h3>
                    <p style="color: var(--text-muted);">Prince Nasser Bin Farhan St, Ø­ÙŠ Ø§Ù„Ù…Ù„Ùƒ Ø³Ù„Ù…Ø§Ù†ØŒ Ø§Ù„Ø±ÙŠØ§Ø¶</p>
                </div>
                <div style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">Ø§Ù„Ù…Ø±ÙƒØ² Ø§Ù„ØªØ´ÙŠÙƒÙŠ Ù„Ù„Ø±Ø¬Ø§Ù„</h3>
                    <p style="color: var(--text-muted);">Ø·Ø±ÙŠÙ‚ Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ø¹Ø²ÙŠØ² Ø§Ù„ÙØ±Ø¹ÙŠØŒ Ø§Ù„ÙŠØ§Ø³Ù…ÙŠÙ†ØŒ Ø§Ù„Ø±ÙŠØ§Ø¶</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="nav-logo" style="margin-bottom: 30px;">
                <img src="{{ asset('landing/logo.png') }}" alt="Logo">
            </div>
            <p>Copyright Â© 2026 | All Rights Reserved</p>
        </div>
    </footer>

    <script src="{{ asset('landing/script.js') }}"></script>
</body>
</html>


