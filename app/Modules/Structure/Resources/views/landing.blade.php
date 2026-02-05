<!DOCTYPE html>
<html lang="ar" dir="rtl" data-scrapbook-source="https://44gu0fjxv9.landing-page.io/#services"
    data-scrapbook-create="20260205125908066" data-scrapbook-title="MT Egypt | شركة التوريدات العامة والاستثمار وتكنولوجيا المعلومات">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MT Egypt | شركة التوريدات العامة والاستثمار وتكنولوجيا المعلومات</title>
        <meta name="description"
            content="شركة رائدة في مجال التوريدات العامة والاستثمار وتكنولوجيا المعلومات في مصر. أكثر من 950 عملية توريد ناجحة للجهات الحكومية والخاصة منذ عام 2020.">
        <link rel="canonical" href="https://www.example.com/">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://www.example.com/">
        <meta property="og:title" content="شركة التوريدات العامة والاستثمار وتكنولوجيا المعلومات">
        <meta property="og:description"
            content="نقدم حلولاً متكاملة في التوريدات والاستثمار وتكنولوجيا المعلومات للقطاعين الحكومي والخاص.">
        <meta property="og:image" content="https://www.example.com/og-image.jpg">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://www.example.com/">
        <meta property="twitter:title" content="شركة التوريدات العامة والاستثمار وتكنولوجيا المعلومات">
        <meta property="twitter:description" content="شريك النجاح للقطاع الحكومي والخاص في مصر.">
        <meta property="twitter:image" content="https://www.example.com/twitter-image.jpg">

        <!-- Fonts -->
        <link href="{{ asset('assets/css/css2.css') }}" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="{{ asset('assets/js/3.4.17.js') }}"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Cairo', 'sans-serif'],
                        },
                        colors: {
                            primary: '#1e3a8a',
                            secondary: '#ca8a04',
                        }
                    }
                }
            };
        </script>

        <!-- Lucide Icons -->
        <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
    </head>
    <body class="font-sans text-gray-800 bg-gray-50 flex flex-col min-h-screen">

        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="#" class="text-2xl font-bold text-primary flex items-center gap-2">
                            <i data-lucide="package" class="w-8 h-8 text-secondary"></i>
                            <span>MT Egypt</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <nav class="hidden md:flex space-x-8 space-x-reverse">
                        <a href="#" class="text-gray-600 hover:text-primary font-medium transition">الرئيسية</a>
                        <a href="#services" class="text-gray-600 hover:text-primary font-medium transition">خدماتنا</a>
                        <a href="#about" class="text-gray-600 hover:text-primary font-medium transition">عن الشركة</a>
                        <a href="#contact" class="text-gray-600 hover:text-primary font-medium transition">تواصل معنا</a>
                    </nav>

                    <!-- CTA Button -->
                    <div class="hidden md:flex items-center">
                        <button onclick="openModal()"
                            class="bg-primary hover:bg-blue-800 text-white px-5 py-2.5 rounded-md font-semibold transition shadow-md cursor-pointer">
                            اطلب عرض سعر
                        </button>
                    </div>

                    <!-- Mobile menu button placeholder -->
                    <div class="md:hidden flex items-center">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <section id="hero" dir="rtl" class="relative overflow-hidden bg-white py-16 lg:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                        <div class="text-right">
                            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                                شريكك الاستراتيجي في <span class="text-blue-700">التوريدات والاستثمار</span>
                            </h1>
                            <p class="mt-6 text-lg leading-8 text-slate-600">
                                نقدم حلولاً متكاملة في مجالات التوريدات العامة، الاستثمار، وتكنولوجيا المعلومات. نعتز بخدمة
                                القطاعين الحكومي والخاص في مصر منذ عام 2020.
                            </p>
                            <div class="mt-8 flex flex-wrap gap-4">
                                <button onclick="openModal()"
                                    class="rounded-lg bg-blue-700 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 cursor-pointer">
                                    تواصل معنا الآن
                                </button>
                                <a href="#services"
                                    class="rounded-lg border border-slate-300 bg-white px-6 py-3 text-base font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                                    خدماتنا
                                </a>
                            </div>
                        </div>
                        <div class="relative lg:order-last">
                            <div class="relative overflow-hidden rounded-2xl shadow-xl">
                                <img
                                    src="{{ asset('assets/images/hero-business-meeting-d90bd3414b884a6dbc30afaa9a52b3c4.png') }}"
                                    alt="اجتماع عمل احترافي" width="1200" height="900"
                                    class="h-full w-full object-cover" loading="eager">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="stats" dir="rtl" class="bg-blue-900 py-12 sm:py-16">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-4xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            أرقام تتحدث عن إنجازاتنا
                        </h2>
                        <p class="mt-3 text-xl text-blue-200">
                            مسيرة حافلة بالنجاح والثقة المتبادلة مع شركائنا في النجاح.
                        </p>
                    </div>
                    <dl class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-3">
                        <div class="flex flex-col items-center rounded-xl bg-white/10 p-8 text-center backdrop-blur-sm">
                            <dt class="order-2 mt-2 text-lg font-medium leading-6 text-blue-200">عملية توريد ناجحة</dt>
                            <dd class="order-1 text-5xl font-extrabold tracking-tight text-white">+950</dd>
                        </div>
                        <div class="flex flex-col items-center rounded-xl bg-white/10 p-8 text-center backdrop-blur-sm">
                            <dt class="order-2 mt-2 text-lg font-medium leading-6 text-blue-200">سنة التأسيس</dt>
                            <dd class="order-1 text-5xl font-extrabold tracking-tight text-white">2020</dd>
                        </div>
                        <div class="flex flex-col items-center rounded-xl bg-white/10 p-8 text-center backdrop-blur-sm">
                            <dt class="order-2 mt-2 text-lg font-medium leading-6 text-blue-200">شريك حكومي وخاص</dt>
                            <dd class="order-1 text-5xl font-extrabold tracking-tight text-white">مصر</dd>
                        </div>
                    </dl>
                </div>
            </section>
            <section id="services" dir="rtl" class="bg-slate-50 py-16 sm:py-24">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">مجالات عملنا الرئيسية</h2>
                        <p class="mt-4 text-lg text-slate-600">
                            نقدم مجموعة متكاملة من الخدمات التي تلبي احتياجات السوق المصري بأعلى معايير الجودة.
                        </p>
                    </div>
                    <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-shadow hover:shadow-xl">
                            <div class="relative h-48">
                                <img src="{{ asset('assets/images/service-supplies-6e85b43264fc4796b56cbd4a7da56a03.png') }}"
                                    alt="التوريدات العامة" width="1200" height="800" class="h-full w-full object-cover"
                                    loading="lazy">
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-xl font-bold text-slate-900">التوريدات العامة</h3>
                                <p class="mt-3 flex-1 text-base text-slate-600">
                                    توريد كافة أنواع المنتجات والمستلزمات للجهات الحكومية والشركات الخاصة بكفاءة عالية والتزام
                                    بالمواعيد.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-shadow hover:shadow-xl">
                            <div class="relative h-48">
                                <img src="{{ asset('assets/images/service-investment-3a40eacbda9844c6bd7685cab1fffd69.png') }}"
                                    alt="الاستثمار" width="1200" height="800" class="h-full w-full object-cover" loading="lazy">
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-xl font-bold text-slate-900">الاستثمار</h3>
                                <p class="mt-3 flex-1 text-base text-slate-600">
                                    دراسة الفرص الاستثمارية وتقديم حلول مالية ذكية تساهم في نمو الأعمال وتحقيق العوائد
                                    المستدامة.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg transition-shadow hover:shadow-xl">
                            <div class="relative h-48">
                                <img src="{{ asset('assets/images/service-it-021ed80e44b54fbb8e023bf6fc1cabe1.png') }}"
                                    alt="تكنولوجيا المعلومات" width="1200" height="800" class="h-full w-full object-cover"
                                    loading="lazy">
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-xl font-bold text-slate-900">تكنولوجيا المعلومات</h3>
                                <p class="mt-3 flex-1 text-base text-slate-600">
                                    توفير أحدث الحلول التقنية والأنظمة المعلوماتية لدعم التحول الرقمي وتطوير البنية التحتية
                                    التكنولوجية.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="features" class="py-24 bg-gray-50" dir="rtl">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col lg:flex-row items-center gap-16">
                        <div class="lg:w-1/2">
                            <div class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-6">
                                لماذا تختارنا؟
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                شريك استراتيجي موثوق للقطاعين الحكومي والخاص
                            </h2>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                منذ تأسيسنا في عام 2020، استطعنا بناء سمعة قوية قائمة على الالتزام والجودة. نفخر بتنفيذ أكثر من
                                950 عملية توريد ناجحة، مما يجعلنا الخيار الأمثل لتلبية احتياجاتكم.
                            </p>

                            <div class="space-y-8">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-shield-check">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                                            <path d="m9 12 2 2 4-4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">الامتثال للمعايير المصرية</h3>
                                        <p class="text-gray-600 leading-relaxed">
                                            نلتزم تماماً بكافة اللوائح والقوانين المنظمة لعمليات التوريد الحكومية في مصر، لضمان
                                            سير العمليات بسلاسة ودون تعقيدات.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-zap">
                                            <path
                                                d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14H4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">سرعة وكفاءة التوريد</h3>
                                        <p class="text-gray-600 leading-relaxed">
                                            ندرك أهمية الوقت في المشاريع الكبرى، لذا نضمن توريد المنتجات التكنولوجية والعامة في
                                            المواعيد المحددة بدقة متناهية.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-briefcase">
                                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">تنوع وتكامل الخدمات</h3>
                                        <p class="text-gray-600 leading-relaxed">
                                            من حلول تكنولوجيا المعلومات إلى التوريدات العامة والاستثمار، نقدم محفظة خدمات شاملة
                                            تغطي كافة احتياجات مؤسستك.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:w-1/2">
                            <div class="relative">
                                <div class="absolute inset-0 bg-blue-600 rounded-2xl transform rotate-3 opacity-10"></div>
                                <img src="{{ asset('assets/images/feature-trust-02ef01c7480a4534b71d70ee2285e0fd.png') }}"
                                    alt="شراكة ناجحة وثقة متبادلة" width="800" height="600"
                                    class="relative w-full rounded-2xl shadow-xl object-cover" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="cta" class="py-20 bg-blue-900 relative overflow-hidden" dir="rtl">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                <div class="container mx-auto px-4 relative z-10 text-center">
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                        هل تبحث عن شريك توريد يمكنك الاعتماد عليه؟
                    </h2>
                    <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                        انضم إلى قائمة شركائنا الناجحين في القطاع الحكومي والخاص. دعنا نساعدك في تحقيق أهدافك من خلال حلول توريد
                        واستثمار مبتكرة.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <button onclick="openModal()"
                            class="w-full sm:w-auto px-8 py-4 bg-white text-blue-900 rounded-lg font-bold text-lg hover:bg-blue-50 transition-colors shadow-lg cursor-pointer">
                            تواصل معنا الآن
                        </button>
                        <a href="#services"
                            class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-bold text-lg hover:bg-white/10 transition-colors">
                            استكشف خدماتنا
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-12 pb-8">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                    <!-- Brand Column -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <i data-lucide="package" class="w-6 h-6 text-secondary"></i>
                            <span class="text-xl font-bold">MT Egypt</span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            شريكك الاستراتيجي في التوريدات العامة والاستثمار وتكنولوجيا المعلومات. نخدم القطاعين الحكومي والخاص منذ
                            عام 2020.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary">روابط سريعة</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">الرئيسية</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-white transition">من نحن</a></li>
                            <li><a href="#services" class="text-gray-400 hover:text-white transition">خدماتنا</a></li>
                            <li><a href="#contact" class="text-gray-400 hover:text-white transition">تواصل معنا</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary">مجالات العمل</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">التوريدات العامة</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">الاستثمار</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">تكنولوجيا المعلومات</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">المناقصات الحكومية</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-secondary">معلومات الاتصال</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-400">
                                <i data-lucide="map-pin" class="w-5 h-5 mt-1 flex-shrink-0"></i>
                                <span>الدقهلية، المنصورة، الفردوس</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <i data-lucide="phone" class="w-5 h-5 flex-shrink-0"></i>
                                <span dir="ltr">01555569194</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <i data-lucide="mail" class="w-5 h-5 flex-shrink-0"></i>
                                <span>mtegyptsuppliers@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center">
                    <p class="text-gray-500 text-sm">
                        © 2024 MT Egypt للتوريدات والاستثمار. جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Quote Modal -->
        <div id="quoteModal" class="relative z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-right shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-right w-full">
                                    <h3 class="text-xl font-semibold leading-6 text-gray-900 mb-4" id="modal-title">طلب عرض سعر</h3>
                                    <form id="quoteForm" onsubmit="event.preventDefault(); submitForm();">
                                        <div class="space-y-4">
                                            <div>
                                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">الاسم</label>
                                                <input type="text" name="name" id="name" required
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                                            </div>
                                            <div>
                                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">رقم الهاتف</label>
                                                <input type="tel" name="phone" id="phone" required
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">المنتجات المطلوبة</label>
                                                <div id="products-list" class="space-y-3">
                                                    <div class="flex gap-3">
                                                        <input type="text" name="product[]" placeholder="اسم المنتج" required
                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                                                        <input type="number" name="quantity[]" placeholder="الكمية" required
                                                            class="block w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                                                    </div>
                                                </div>
                                                <button type="button" onclick="addProduct()"
                                                    class="mt-3 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                                    <i data-lucide="plus" class="w-4 h-4 ml-1"></i> إضافة منتج آخر
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                            <button type="submit"
                                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">
                                                ارسال الطلب
                                            </button>
                                            <button type="button" onclick="closeModal()"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">
                                                إلغاء
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Initialize Lucide Icons & Modal Script -->
        <script>
            lucide.createIcons();

            function openModal() {
                document.getElementById('quoteModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('quoteModal').classList.add('hidden');
            }

            function addProduct() {
                const container = document.getElementById('products-list');
                const div = document.createElement('div');
                div.className = 'flex gap-3';
                div.innerHTML = `
                    <input type="text" name="product[]" placeholder="اسم المنتج" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                    <input type="number" name="quantity[]" placeholder="الكمية" required class="block w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 px-3">
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                `;
                container.appendChild(div);
                lucide.createIcons();
            }

            function submitForm() {
                alert('تم استلام طلبك بنجاح! سنتواصل معك قريباً.');
                closeModal();
                document.getElementById('quoteForm').reset();
            }
        </script>
    </body>
</html>