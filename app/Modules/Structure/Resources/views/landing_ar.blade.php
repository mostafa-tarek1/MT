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
        <div class="container navbar-shell" style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
            <div class="nav-logo">
                <img src="{{ asset('landing/logo.png') }}" alt="المركز التشيكي لإعادة التأهيل">
            </div>
            
            <nav class="nav-links">
                <a href="#" class="nav-link">خدماتنا العلاجية</a>
                <a href="#medical-team" class="nav-link">الطاقم الطبي</a>
                <a href="#" class="nav-link">فروعنا</a>
                <a href="#" class="nav-link">الميديا</a>
                <a href="#" class="nav-link">حول المركز</a>
                <a href="#footer-contact" class="nav-link">اتصل بنا</a>
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
            <div class="hero-actions" style="display: flex; gap: 24px;">
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
        <div class="container stats-container" style="display: flex; justify-content: space-around; width: 100%;">
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
    <section class="container journey-section" style="padding: 100px 0; text-align: center;">
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
    <section class="branches-section" style="background: var(--bg-lavender); padding: 100px 0;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 style="font-size: 36px; margin-bottom: 15px;">فروعنا داخل مدينة الرياض</h2>
            </div>
            
            <div class="branches-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                <div class="branch-card" style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div class="branch-thumb" style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">المركز التشيكي للسيدات</h3>
                    <p style="color: var(--text-muted);">Prince Nasser Bin Farhan St, حي الملك سلمان، الرياض</p>
                </div>
                <div class="branch-card" style="background: var(--bg-light); border-radius: 30px; padding: 40px; text-align: right;">
                    <div class="branch-thumb" style="width: 120px; height: 105px; background: var(--accent); margin: 0 0 30px auto; border-radius: 15px; background-image: url('https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=400'); background-size: cover; background-position: center;"></div>
                    <h3 style="font-size: 36px; margin-bottom: 15px;">المركز التشيكي للرجال</h3>
                    <p style="color: var(--text-muted);">طريق الملك عبدالعزيز الفرعي، الياسمين، الرياض</p>
                </div>
            </div>
        </div>
    </section>

    <section id="medical-team" class="team-section">
        <div class="container">
            <div class="team-header">
                <h2 class="section-title">قابل طاقمنا الطبي</h2>
                <p class="section-desc">نخبة من الأطباء والأخصائيين بخبرة عملية واسعة، يعملون على بناء خطة علاجية دقيقة لكل حالة لتحقيق أفضل نتائج التأهيل.</p>
            </div>

            <div class="team-slider-wrap">
                <button class="team-nav team-nav-prev" type="button" data-doctors-prev aria-label="السابق">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="team-track" id="doctorsTrack">
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/5327580/pexels-photo-5327580.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. أحمد العتيبي" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. أحمد العتيبي</h3>
                        <p>استشاري العلاج الطبيعي العصبي وتأهيل ما بعد الجلطات.</p>
                    </article>
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. سارة القحطاني" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. سارة القحطاني</h3>
                        <p>أخصائية علاج طبيعي لصحة المرأة وتأهيل ما بعد الولادة.</p>
                    </article>
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/6129048/pexels-photo-6129048.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. محمد الشهري" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. محمد الشهري</h3>
                        <p>أخصائي تأهيل رياضي وإصابات الملاعب واستعادة الأداء.</p>
                    </article>
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/5726708/pexels-photo-5726708.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. نورة العنزي" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. نورة العنزي</h3>
                        <p>أخصائية العلاج الوظيفي والتأهيل الحركي لكبار السن.</p>
                    </article>
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/5452201/pexels-photo-5452201.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. خالد الحربي" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. خالد الحربي</h3>
                        <p>استشاري التأهيل الروبوتي واضطرابات المشي والتوازن.</p>
                    </article>
                    <article class="doctor-card">
                        <img src="https://images.pexels.com/photos/7089401/pexels-photo-7089401.jpeg?auto=compress&cs=tinysrgb&w=800" alt="د. ريم المطيري" onerror="this.onerror=null;this.src='{{ asset('landing/logo.png') }}';">
                        <h3>د. ريم المطيري</h3>
                        <p>أخصائية تأهيل الأطفال والتدخل المبكر للحالات النمائية.</p>
                    </article>
                </div>

                <button class="team-nav team-nav-next" type="button" data-doctors-next aria-label="التالي">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <footer class="footer footer-expanded" id="footer-contact">
        <div class="partners-strip">
            <div class="container">
                <h3>شركاؤنا مع شركات التأمين</h3>
                <div class="partners-logos">
                    <span>Google</span>
                    <span>facebook</span>
                    <span>YouTube</span>
                    <span>Pinterest</span>
                    <span>twitch</span>
                    <span>webflow</span>
                </div>
                <div class="partners-dots">
                    <span class="is-active"></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="footer-main-top">
                <div class="footer-brand-block">
                    <div class="footer-brand-logo">
                        <img src="{{ asset('landing/logo.png') }}" alt="المركز التشيكي لإعادة التأهيل">
                    </div>
                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة.</p>
                    <div class="footer-social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-contact-block">
                    <ul>
                        <li><span class="icon-box"><i class="fas fa-phone"></i></span> رقم الهاتف: 920002737+</li>
                        <li><span class="icon-box"><i class="fas fa-envelope"></i></span> callcenter@cz-center.com</li>
                        <li><span class="icon-box"><i class="fas fa-map-marker-alt"></i></span> الرياض - حي الياسمين - طريق الملك عبدالعزيز شمال تقاطع أنس بن مالك بالقرب من سوق التميمي.</li>
                    </ul>
                </div>
            </div>

            <div class="footer-links-area">
                <div class="footer-links-group">
                    <h4>حول المركز</h4>
                    <ul>
                        <li><a href="#">تعرف علينا</a></li>
                        <li><a href="#">الأجهزة المستخدمة</a></li>
                        <li><a href="#">الطاقم الطبي</a></li>
                        <li><a href="#">قصص نجاح ملهمة</a></li>
                        <li><a href="#">الأخبار والفعاليات</a></li>
                        <li><a href="#">اتصل بنا</a></li>
                    </ul>
                </div>

                <div class="footer-links-group">
                    <h4>خدماتنا</h4>
                    <div class="footer-links-columns">
                        <ul>
                            <li><a href="#">العلاج المغناطيسي</a></li>
                            <li><a href="#">العلاج الفيزيائي</a></li>
                            <li><a href="#">العلاج المهني</a></li>
                            <li><a href="#">العلاج في المسبح</a></li>
                            <li><a href="#">علاج الروبوت الأوتوماتيكي</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">العلاج بالأعشاب</a></li>
                            <li><a href="#">العلاج بالضغط</a></li>
                            <li><a href="#">العلاج النفسي</a></li>
                            <li><a href="#">العلاج بالألوان</a></li>
                            <li><a href="#">العلاج بالطاقة</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">العلاج بالأغذية</a></li>
                            <li><a href="#">العلاج باليوغا</a></li>
                            <li><a href="#">العلاج بالتحفيز الكهربائي</a></li>
                            <li><a href="#">العلاج بالصوت</a></li>
                            <li><a href="#">العلاج بالحركة</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <p>Copyright &copy; 2026 | All Rights Reserved | Terms and Conditions | Privacy Policy</p>
            </div>
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
