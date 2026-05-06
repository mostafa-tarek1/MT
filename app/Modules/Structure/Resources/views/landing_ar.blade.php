<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المركز التشيكي لإعادة التأهيل | خبيرك الطبي في الرياض</title>
    <meta name="description" content="مركز إعادة تأهيل متكامل بخبرات طبية تشيكية تزيد عن 15 سنة. نقدم أفضل خدمات العلاج الطبيعي والتأهيل في الرياض.">
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
            <div class="nav-logo">
                <img src="{{ asset('landing/logo.png') }}" alt="المركز التشيكي لإعادة التأهيل">
            </div>
            
            <nav class="nav-links">
                <a href="#" class="nav-link">خدماتنا العلاجية</a>
                <a href="#" class="nav-link">الطاقم الطبي</a>
                <a href="#" class="nav-link">فروعنا</a>
                <a href="#" class="nav-link">الميديا</a>
                <a href="#" class="nav-link">حول المركز</a>
                <a href="#" class="nav-link">اتصل بنا</a>
                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="nav-link" style="font-weight: 400;">EN</a>
            </nav>

            <div class="nav-actions">
                <button class="btn btn-primary">احجز موعد الان</button>
                <button class="btn btn-outline">تحدث معنا</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container hero">
        <div class="hero-content">
            <h1 class="section-title">مركز إعادة تأهيل بخبرات<br>طبية تشيكية</h1>
            <p class="section-desc">افضل خدمات إعادة تأهيل طبي بأيدي فريق عالمي لمساعدتك على الشفاء التام باسرع وقت وبرفاهية تامة</p>
            <div style="display: flex; gap: 24px;">
                <button class="btn btn-primary">احجز موعد الان <i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline">تحدث معنا للإجابة على استفساراتك</button>
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
                <p>سنة خبرة</p>
            </div>
            <div class="stat-item">
                <h3>3.900<span>+</span></h3>
                <p>مريض لعام 2025</p>
            </div>
            <div class="stat-item">
                <h3>70<span>+</span></h3>
                <p>الفريق الطبي</p>
            </div>
            <div class="stat-item">
                <h3>99<span>%</span></h3>
                <p>نسبة الشفاء</p>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section class="container" style="padding: 100px 0; text-align: center;">
        <h2 class="section-title">شاهد رحلة علاجك</h2>
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
                    <h2 class="section-title">خدمات إعادة تأهيل<br>لجميع الاعمار</h2>
                </div>
                <button class="btn btn-primary" style="margin-bottom: 40px;">احجز موعد الان</button>
            </div>
            
            <div class="services-grid">
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>خدمات تأهيل البالغين</h3>
                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز.</p>
                    <a href="#" class="more-btn">عرض المزيد <i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="service-card" style="background-image: url('https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=2070&auto=format&fit=crop');">
                    <h3>خدمات تأهيل الاطفال</h3>
                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز.</p>
                    <a href="#" class="more-btn">عرض المزيد <i class="fas fa-chevron-left"></i></a>
                </div>
                <div class="service-card service-full" style="background-image: url('https://images.unsplash.com/photo-1581594693702-fbdc51b2763b?q=80&w=2070&auto=format&fit=crop');">
                    <div style="max-width: 500px;">
                        <h3>مركز طبي متكامل للسيدات بطاقم نسائي</h3>
                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز.</p>
                        <a href="#" class="more-btn">عرض المزيد <i class="fas fa-chevron-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branches Section -->
    <section style="background: var(--bg-lavender); padding: 100px 0;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-size: 36px; margin-bottom: 15px;">فروعنا داخل مدينة الرياض</h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                <div style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">المركز التشيكي للسيدات</h3>
                    <p style="color: var(--text-muted);">Prince Nasser Bin Farhan St, حي الملك سلمان، الرياض</p>
                </div>
                <div style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">المركز التشيكي للرجال</h3>
                    <p style="color: var(--text-muted);">طريق الملك عبدالعزيز الفرعي، الياسمين، الرياض</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" id="footer-contact">
        <div class="container">
            <div class="nav-logo" style="margin-bottom: 30px;">
                <img src="{{ asset('landing/logo.png') }}" alt="Logo">
            </div>

            <div class="footer-contact-grid">
                <div>
                    <h3>معلومات التواصل</h3>
                    <p>الهاتف: 920002737</p>
                    <p>واتساب: 0533110066</p>
                    <p>البريد الإلكتروني: infocz-center.com</p>
                    <p>الموقع الإلكتروني: www.cz-center.com</p>
                </div>
                <div>
                    <h3>العنوان</h3>
                    <p>الرياض - حي الياسمين</p>
                    <p>طريق الملك عبدالعزيز</p>
                    <p>قريب من سوق التميمي</p>
                </div>
            </div>

            <p>Copyright &copy; 2026 | All Rights Reserved</p>
        </div>
    </footer>

    <div id="temporaryNoticeModal" class="notice-modal" aria-hidden="true">
        <div class="notice-modal__overlay" data-close-notice></div>
        <div class="notice-modal__card" role="dialog" aria-modal="true" aria-labelledby="noticeModalTitle">
            <button class="notice-modal__close" type="button" aria-label="إغلاق" data-close-notice>&times;</button>
            <h2 id="noticeModalTitle">تنويه</h2>
            <p>هذه نسخة مؤقتة وغير نهائية من الموقع، تم إتاحتها بشكل استثنائي خلال وقت محدود.</p>
            <p>النسخة الحالية لا تعكس الشكل النهائي أو مستوى الجودة المخطط له، حيث لا يزال العمل جاريًا على النسخة الكاملة التي سيتم إطلاقها قريبًا.</p>
            <p>مع تحياتنا، فريق تطوير شركة الرياض.</p>
            <button class="btn btn-primary notice-modal__action" type="button" data-close-notice>تم</button>
        </div>
    </div>

    <script src="{{ asset('landing/script.js') }}"></script>
</body>
</html>
