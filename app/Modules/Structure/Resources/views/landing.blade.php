<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HR Plus - نظام إدارة الموارد البشرية</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>

<body>
  <div class="main-container">

    <!-- Hero Section with Background -->
    <div class="hero-section">
      <!-- Header / Navbar -->
      <header class="header">
        <div class="container">
          <div class="header-container">
            <!-- Logo -->
            <div class="logo">
              <img src="{{ asset('assets/images/logo.svg') }}" alt="HR Plus Logo" />
            </div>
            <!-- Navigation Menu -->
            <nav class="nav-wrapper">
              <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menu">
                ☰
              </button>
              <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="#about">{{ $header['nav_item1_text'] ?? 'عن التطبيق' }}</a></li>
                <li class="nav-item"><a href="#features">{{ $header['nav_item2_text'] ?? 'المميزات' }}</a></li>
                <li class="nav-item">
                  <a href="#testimonials">{{ $header['nav_item3_text'] ?? 'آراء العملاء' }}</a>
                </li>
                <li class="nav-item"><a href="#contact">{{ $header['nav_item4_text'] ?? 'تواصل معنا' }}</a></li>
              </ul>
            </nav>
            <!-- Button: جرب التطبيق مجانا -->
            <button class="btn-primary btn-try-app">
              <span>{{ $header['button_text'] ?? 'جرب التطبيق مجانا' }}</span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10.5999 12.71C10.5062 12.617 10.4318 12.5064 10.381 12.3846C10.3302 12.2627 10.3041 12.132 10.3041 12C10.3041 11.868 10.3302 11.7373 10.381 11.6154C10.4318 11.4936 10.5062 11.383 10.5999 11.29L15.1899 6.71001C15.2836 6.61704 15.358 6.50644 15.4088 6.38458C15.4596 6.26272 15.4857 6.13202 15.4857 6.00001C15.4857 5.86799 15.4596 5.73729 15.4088 5.61543C15.358 5.49357 15.2836 5.38297 15.1899 5.29001C15.0025 5.10376 14.7491 4.99921 14.4849 4.99921C14.2207 4.99921 13.9673 5.10376 13.7799 5.29001L9.18989 9.88001C8.62809 10.4425 8.31253 11.205 8.31253 12C8.31253 12.795 8.62809 13.5575 9.18989 14.12L13.7799 18.71C13.9662 18.8948 14.2176 18.9989 14.4799 19C14.6115 19.0008 14.742 18.9755 14.8638 18.9258C14.9856 18.876 15.0965 18.8027 15.1899 18.71C15.2836 18.617 15.358 18.5064 15.4088 18.3846C15.4596 18.2627 15.4857 18.132 15.4857 18C15.4857 17.868 15.4596 17.7373 15.4088 17.6154C15.358 17.4936 15.2836 17.383 15.1899 17.29L10.5999 12.71Z"
                  fill="white" />
              </svg>
            </button>
          </div>
        </div>
      </header>

      <!-- Hero Content -->
      <div class="hero-content">
        <h1 class="hero-title">
          <span class="primary-text">{{ $hero['title_primary'] ?? 'تحكّم كامل في إدارة الموارد البشرية مع' }}
          </span>
          <span class="accent-text">{{ $hero['title_accent'] ?? 'HR Plus' }}</span>
        </h1>
        <p class="hero-subtitle">
          {{ $hero['subtitle'] ?? 'نظام ذكي لمتابعة الحضور والانصراف، إدارة الإجازات، الرواتب، والمزيد في مكان واحد.' }}
        </p>
        <a href="{{ $hero['button_link'] ?? '#' }}" class="btn-primary btn-primary-lg"
          style="text-decoration: none; display: inline-block;">
          <span>{{ $hero['button_text'] ?? 'جــربه الآن مجـــانا' }}</span>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10.5999 12.71C10.5062 12.617 10.4318 12.5064 10.381 12.3846C10.3302 12.2627 10.3041 12.132 10.3041 12C10.3041 11.868 10.3302 11.7373 10.381 11.6154C10.4318 11.4936 10.5062 11.383 10.5999 11.29L15.1899 6.71001C15.2836 6.61704 15.358 6.50644 15.4088 6.38458C15.4596 6.26272 15.4857 6.13202 15.4857 6.00001C15.4857 5.86799 15.4596 5.73729 15.4088 5.61543C15.358 5.49357 15.2836 5.38297 15.1899 5.29001C15.0025 5.10376 14.7491 4.99921 14.4849 4.99921C14.2207 4.99921 13.9673 5.10376 13.7799 5.29001L9.18989 9.88001C8.62809 10.4425 8.31253 11.205 8.31253 12C8.31253 12.795 8.62809 13.5575 9.18989 14.12L13.7799 18.71C13.9662 18.8948 14.2176 18.9989 14.4799 19C14.6115 19.0008 14.742 18.9755 14.8638 18.9258C14.9856 18.876 15.0965 18.8027 15.1899 18.71C15.2836 18.617 15.358 18.5064 15.4088 18.3846C15.4596 18.2627 15.4857 18.132 15.4857 18C15.4857 17.868 15.4596 17.7373 15.4088 17.6154C15.358 17.4936 15.2836 17.383 15.1899 17.29L10.5999 12.71Z"
              fill="white" />
          </svg>
        </a>
        <img src="{{ $hero['icon1'] ?? asset('assets/images/heroicon1.svg') }}" alt="Hero Icon" class="hero-icon-1" />
        <img src="{{ $hero['icon2'] ?? asset('assets/images/heroicon2.svg') }}" alt="Hero Icon" class="hero-icon-2" />
        <img src="{{ $hero['icon3'] ?? asset('assets/images/heroicon3.svg') }}" alt="Hero Icon" class="hero-icon-3" />
        <img src="{{ $hero['icon4'] ?? asset('assets/images/heroicon4.svg') }}" alt="Hero Icon" class="hero-icon-4" />
      </div>

      <!-- Hero Image Circle -->

      <!-- Client Logos -->
      <div class="client-logos">
        <div class="owl-carousel client-logos-carousel">
          @foreach ($hero['client_logos'] ?? [] as $logo)
            <div class="item">
              <img src="{{ $logo['icon'] }}" alt="{{ $logo['alt'] ?? 'Client Logo' }}" class="client-logo" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="hero-image-container">
      <img src="{{ asset('assets/images/mobiles.svg') }}" alt="HR Plus" class="hero-img-1" />

      <!-- Features Section with Absolute Layout -->
      <section id="features" class="features-section-grid">
        <div class="features-absolute-container">
          @foreach ($features['features'] ?? [] as $item)
            <div class="feature-card-absolute feature-card-{{ $loop->iteration }}">
              <div class="feature-card-content">
                <img src="{{ $item['icon'] ?? asset('assets/images/feature.svg') }}" alt="Feature"
                  class="feature-card-icon" />
                <div class="feature-card-text">{{ $item['title'] ?? '' }}</div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    </div>
    <!-- Who Is This For Section -->
    <section class="section who-section-wrapper">
      <div class="container">
        <div class="who-section">
          <div class="who-content" style="height: 406px;">
            <h2 class="section-title who-title">{{ $whoIsThisFor['title'] ?? 'لمن هذا النظام؟' }}</h2>
            <div class="who-items">
              @foreach($whoIsThisFor['items'] ?? [] as $item)
                <div class="who-item">
                  <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M19.5434 3.27108C19.9604 3.27153 20.3773 3.27126 20.7943 3.27082C25.1182 3.26685 25.1182 3.26685 26.6259 3.45705C26.7058 3.46704 26.7858 3.47703 26.8681 3.48732C29.1677 3.79624 29.1677 3.79624 29.7928 4.5862C30.0783 5.04697 30.0622 5.57007 30 6.09377C29.876 6.59865 29.581 6.83262 29.1501 7.09932C28.5448 7.42144 27.8867 7.27588 27.2509 7.11916C26.7129 6.98899 26.184 6.90996 25.6323 6.86594C25.5514 6.8594 25.4705 6.85287 25.3871 6.84613C24.4171 6.77428 23.4477 6.77429 22.4756 6.77614C22.276 6.77604 22.0765 6.77588 21.877 6.77569C21.4621 6.77546 21.0471 6.77577 20.6322 6.77652C20.1583 6.77737 19.6843 6.7771 19.2103 6.77624C18.747 6.77543 18.2836 6.77553 17.8203 6.77599C17.6265 6.77609 17.4326 6.77597 17.2388 6.7756C14.164 6.77102 11.4189 6.95413 9.12106 9.19436C6.82698 11.5186 6.77006 14.4795 6.77609 17.5733C6.77598 17.769 6.77583 17.9647 6.77564 18.1604C6.77541 18.5672 6.77573 18.974 6.77647 19.3807C6.77736 19.8962 6.77685 20.4117 6.77591 20.9272C6.77534 21.3304 6.77553 21.7335 6.77593 22.1366C6.77604 22.3265 6.77591 22.5163 6.77554 22.7061C6.77084 25.7998 6.9399 28.5666 9.1943 30.8789C11.5066 33.1612 14.4459 33.2298 17.5244 33.2239C17.7239 33.224 17.9234 33.2242 18.1229 33.2243C18.5379 33.2246 18.9528 33.2243 19.3677 33.2235C19.8417 33.2227 20.3156 33.2229 20.7896 33.2238C21.2529 33.2246 21.7163 33.2245 22.1797 33.2241C22.3735 33.224 22.5673 33.2241 22.7611 33.2244C25.836 33.229 28.581 33.0459 30.8789 30.8057C33.0723 28.5835 33.2264 25.7847 33.2245 22.8102C33.2245 22.5424 33.2255 22.2746 33.2268 22.0068C33.2304 21.2472 33.2323 20.4876 33.2328 19.728C33.2332 19.2592 33.2351 18.7904 33.2379 18.3216C33.2387 18.1445 33.2389 17.9673 33.2385 17.7901C33.2379 17.5434 33.2393 17.2968 33.241 17.0502C33.2401 16.942 33.2401 16.942 33.2391 16.8316C33.2461 16.2784 33.3809 15.8632 33.7527 15.4471C33.805 15.4043 33.8572 15.3615 33.9111 15.3174C33.9636 15.2732 34.016 15.229 34.0701 15.1834C34.4883 14.8872 35.0598 14.952 35.5468 15C35.9507 15.1486 36.2596 15.415 36.4843 15.7813C36.6855 16.2577 36.7525 16.6865 36.7466 17.2002C36.7467 17.268 36.7469 17.3358 36.747 17.4057C36.7473 17.6284 36.7458 17.8511 36.7444 18.0737C36.7441 18.231 36.744 18.3882 36.7439 18.5454C36.7435 18.8751 36.7424 19.2047 36.7407 19.5344C36.7385 19.951 36.7376 20.3676 36.7373 20.7843C36.7305 27.7267 36.7305 27.7267 35.4687 30.3125C35.4319 30.3885 35.395 30.4644 35.357 30.5426C34.9152 31.3988 34.3307 32.1756 33.6725 32.8763C33.5106 33.0482 33.5106 33.0482 33.356 33.2483C33.1266 33.5322 32.8591 33.7528 32.5781 33.9844C32.468 34.0755 32.468 34.0755 32.3556 34.1684C31.7174 34.6838 31.0401 35.0921 30.3125 35.4688C30.1845 35.5352 30.1845 35.5352 30.054 35.603C27.1527 37.0229 23.6314 36.7324 20.4942 36.729C20.0827 36.7285 19.6712 36.7288 19.2596 36.7292C14.864 36.7333 14.864 36.7333 13.3691 36.543C13.2891 36.5329 13.2091 36.5229 13.1267 36.5125C11.9044 36.3477 10.7943 36.0089 9.68747 35.4688C9.61153 35.4319 9.5356 35.3951 9.45736 35.3571C8.59794 34.9136 7.82176 34.3263 7.11697 33.6673C6.94547 33.5042 6.94547 33.5042 6.71383 33.3301C4.43966 31.2979 3.50883 28.2545 3.33306 25.3133C3.25567 23.7121 3.26932 22.1083 3.27103 20.5056C3.27148 20.0846 3.27121 19.6637 3.27076 19.2427C3.26443 12.2836 3.26443 12.2836 4.53122 9.68752C4.56808 9.61159 4.60493 9.53565 4.64291 9.45742C5.97532 6.87539 8.40828 4.79335 11.1723 3.89969C13.8581 3.09675 16.7725 3.2681 19.5434 3.27108Z"
                      fill="#3736AE" />
                    <path
                      d="M35.5469 7.49995C35.9929 7.65987 36.2971 7.97678 36.5625 8.35932C36.8337 8.95341 36.7447 9.45207 36.528 10.0396C36.1901 10.58 35.6035 10.8668 35.0635 11.1718C33.0317 12.3473 31.1834 13.81 29.4531 15.3906C29.3397 15.4931 29.3397 15.4931 29.2239 15.5978C28.5593 16.2002 27.9086 16.8141 27.3251 17.4969C27.1722 17.6739 27.0139 17.8454 26.8555 18.0175C26.4568 18.4595 26.0926 18.9254 25.7295 19.3966C25.6345 19.519 25.5377 19.6401 25.4407 19.761C24.2024 21.3213 23.1775 23.0391 22.2415 24.793C22.0422 25.1656 21.8401 25.5361 21.6278 25.9014C21.5921 25.9629 21.5564 26.0244 21.5196 26.0878C21.2939 26.4108 20.998 26.5944 20.625 26.7187C20.4773 26.732 20.329 26.7395 20.1807 26.7431C20.0642 26.7475 20.0642 26.7475 19.9454 26.752C19.2512 26.6624 18.8202 26.2087 18.3498 25.7327C18.2815 25.6648 18.2132 25.597 18.1429 25.527C17.957 25.342 17.7719 25.1562 17.587 24.9701C17.3929 24.7749 17.1979 24.5804 17.0031 24.3859C16.6762 24.0592 16.35 23.732 16.0242 23.4043C15.648 23.0261 15.2709 22.6489 14.8933 22.2721C14.5291 21.9088 14.1655 21.5447 13.8023 21.1804C13.6481 21.0258 13.4937 20.8714 13.3391 20.7171C13.1232 20.5016 12.9082 20.2852 12.6934 20.0687C12.6295 20.0051 12.5655 19.9415 12.4997 19.876C12.0311 19.4013 11.7612 19.0033 11.7145 18.327C11.7247 17.8433 11.8759 17.4752 12.2021 17.1191C12.5775 16.78 12.9646 16.636 13.4668 16.6015C14.4721 16.6656 15.1175 17.4909 15.7739 18.1631C15.8844 18.2747 15.9951 18.3863 16.1058 18.4977C16.3953 18.7896 16.6836 19.0826 16.9717 19.3758C17.4347 19.8468 17.8992 20.3163 18.3641 20.7855C18.5262 20.9496 18.6878 21.1142 18.8494 21.2789C18.9479 21.3787 19.0465 21.4786 19.1451 21.5784C19.19 21.6246 19.235 21.6707 19.2813 21.7182C19.3877 21.8256 19.4982 21.9288 19.6094 22.0312C19.6609 22.0312 19.7125 22.0312 19.7656 22.0312C19.8073 21.9546 19.849 21.8779 19.892 21.799C20.3082 21.0417 20.758 20.3194 21.25 19.6093C21.2862 19.5569 21.3223 19.5044 21.3596 19.4504C22.3777 17.9766 23.4737 16.5849 24.679 15.26C24.785 15.1429 24.8901 15.025 24.9939 14.906C25.3972 14.4464 25.8234 14.012 26.2549 13.5791C26.3139 13.5196 26.373 13.4602 26.4338 13.399C26.8027 13.0311 27.1831 12.683 27.5781 12.3437C27.6685 12.2639 27.7587 12.1839 27.8488 12.1038C28.5661 11.4708 29.3097 10.8819 30.0781 10.3124C30.1357 10.2697 30.1932 10.227 30.2525 10.183C34.0726 7.35754 34.0726 7.35754 35.5469 7.49995Z"
                      fill="#3736AE" />
                  </svg>
                  <div class="who-item-text">{{ $item['text'] ?? '' }}</div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="who-image" style="width: 564px; height: 406px; content-fit: contain;">
            <img src="{{ $whoIsThisFor['image'] ?? asset('assets/images/whySystem.svg') }}" alt="Who is this for" />
          </div>
        </div>
      </div>
    </section>
    <!-- Flexible System Section -->
    <section id="about" class="section flexible-system-section">
      <div class="container">
        <h2 class="section-title">{{ $flexibleSystem['title'] ?? 'نظام مرن يلبي إحتياجات الموارد البشريه' }}</h2>
        <div class="flexible-cards-grid">
          @foreach ($flexibleSystem['cards'] ?? [] as $index => $card)
            <div class="flexible-card">
              <div class="flexible-card-icon">
                @if(!empty($card['image']))
                  <img src="{{ $card['image'] }}" alt="{{ $card['title'] ?? '' }}"
                    style="width: 80px; height: 80px; object-fit: contain;">
                @else
                  <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="80" height="80" fill="#3736AE" />
                  </svg>
                @endif
              </div>
              <h3 class="flexible-card-title">{{ $card['title'] ?? '' }}</h3>
              <p class="flexible-card-text">
                {!! $card['text'] ?? '' !!}
              </p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section testimonials-section" dir="ltr">
      <div class="container">
        <div class="testimonials-header">
          <h2 class="section-title">{{ $customerReviews['main_title'] ?? 'آراء العملاء الذين وثقو بنا' }}</h2>
          <svg width="364" height="23" viewBox="0 0 364 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M2.00043 20.5169C128.796 -6.72285 255.5 -1.4831 362 20.5168" stroke="#3736AE"
              stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        @if(!empty($customerReviews['reviews']) && is_array($customerReviews['reviews']) && count($customerReviews['reviews']) > 0)
          <div class="testimonials-slider-wrapper">
            <div class="testimonials-slider-container">
              <div class="testimonials-slider-track" id="testimonialsSliderTrack">
                @foreach($customerReviews['reviews'] as $review)
                  <div dir="rtl" class="testimonial-card slide">
                    <p class="testimonial-text">
                      {!! $review['text'] ?? '' !!}
                    </p>
                    <div class="testimonial-author">
                      <img class="author-avatar" src="{{ $review['image'] ?? 'https://placehold.co/36x36' }}"
                        alt="{{ $review['name'] ?? '' }}" />
                      <div class="author-info">
                        <div class="author-name">{{ $review['name'] ?? '' }}</div>
                        <div class="author-role">{{ $review['job'] ?? '' }}</div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="testimonials-slider-controls">
              <button class="testimonials-slider-btn testimonials-slider-btn-prev" style="display: none"
                id="testimonialsPrevBtn" aria-label="السابق">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </button>
              <div class="testimonial-dots" id="testimonialsDots"></div>
              <button class="testimonials-slider-btn testimonials-slider-btn-next" style="display: none"
                id="testimonialsNextBtn" aria-label="التالي">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </button>
            </div>
          </div>
        @endif
      </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section-wrapper">
      <div class="container">
        <div class="cta-section">
          <div class="cta-content">
            <h2 class="cta-title">
              {{ $cta['title'] ?? 'ابدأ باستخدام HR Plus اليوم وقم بإدارة شركتك وموظفينك بسهولة' }}
            </h2>
            <button class="btn-white">
              <span>{{ $cta['button_text'] ?? 'جرب التطبيق' }}</span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M10.5999 12.7101C10.5062 12.6171 10.4318 12.5065 10.381 12.3846C10.3303 12.2628 10.3041 12.1321 10.3041 12.0001C10.3041 11.868 10.3303 11.7373 10.381 11.6155C10.4318 11.4936 10.5062 11.383 10.5999 11.2901L15.1899 6.71006C15.2836 6.6171 15.358 6.5065 15.4088 6.38464C15.4596 6.26278 15.4857 6.13207 15.4857 6.00006C15.4857 5.86805 15.4596 5.73734 15.4088 5.61548C15.358 5.49362 15.2836 5.38302 15.1899 5.29006C15.0026 5.10381 14.7491 4.99927 14.4849 4.99927C14.2207 4.99927 13.9673 5.10381 13.7799 5.29006L9.18992 9.88006C8.62812 10.4426 8.31256 11.2051 8.31256 12.0001C8.31256 12.7951 8.62812 13.5576 9.18992 14.1201L13.7799 18.7101C13.9662 18.8948 14.2176 18.999 14.4799 19.0001C14.6115 19.0008 14.742 18.9756 14.8638 18.9258C14.9857 18.8761 15.0965 18.8027 15.1899 18.7101C15.2836 18.6171 15.358 18.5065 15.4088 18.3846C15.4596 18.2628 15.4857 18.1321 15.4857 18.0001C15.4857 17.868 15.4596 17.7373 15.4088 17.6155C15.358 17.4936 15.2836 17.383 15.1899 17.2901L10.5999 12.7101Z"
                  fill="#3736AE" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact-section-wrapper">
      <div class="container">
        <div class="contact-section">
          <div class="contact-form">
            <div class="form-header">
              <h2 class="form-title">{{ $contact['form_title'] ?? 'تواصل معنا الان' }}</h2>
              @if(!empty($contact['form_subtitle']))
                <p class="form-subtitle">
                  {!! $contact['form_subtitle'] !!}
                </p>
              @endif
            </div>
            <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
              @csrf
              <div class="form-group">
                <input type="text" name="name" class="form-input" placeholder="الاسم" required />
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-input" placeholder="البريد الالكتروني" required />
              </div>
              <div class="form-group">
                <input type="text" name="phone" class="form-input" placeholder="رقم الجوال" required />
              </div>
              <div class="form-group">
                <textarea name="message" class="form-textarea" placeholder="الرسالة" required></textarea>
              </div>
              <button type="submit" class="btn-primary btn-submit">
                <span>ارســــال</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M10.5999 12.7098C10.5061 12.6169 10.4317 12.5063 10.381 12.3844C10.3302 12.2625 10.3041 12.1318 10.3041 11.9998C10.3041 11.8678 10.3302 11.7371 10.381 11.6152C10.4317 11.4934 10.5061 11.3828 10.5999 11.2898L15.1899 6.70982C15.2836 6.61685 15.358 6.50625 15.4088 6.38439C15.4595 6.26253 15.4857 6.13183 15.4857 5.99982C15.4857 5.8678 15.4595 5.7371 15.4088 5.61524C15.358 5.49338 15.2836 5.38278 15.1899 5.28982C15.0025 5.10356 14.749 4.99902 14.4849 4.99902C14.2207 4.99902 13.9672 5.10356 13.7799 5.28982L9.18986 9.87982C8.62806 10.4423 8.3125 11.2048 8.3125 11.9998C8.3125 12.7948 8.62806 13.5573 9.18986 14.1198L13.7799 18.7098C13.9661 18.8946 14.2175 18.9987 14.4799 18.9998C14.6115 19.0006 14.7419 18.9754 14.8638 18.9256C14.9856 18.8758 15.0964 18.8025 15.1899 18.7098C15.2836 18.6169 15.358 18.5063 15.4088 18.3844C15.4595 18.2625 15.4857 18.1318 15.4857 17.9998C15.4857 17.8678 15.4595 17.7371 15.4088 17.6152C15.358 17.4934 15.2836 17.3828 15.1899 17.2898L10.5999 12.7098Z"
                    fill="white" />
                </svg>
              </button>
            </form>
          </div>

          <div class="contact-info">
            <div class="contact-info-inner">
              <div class="contact-header">
                <h2 class="contact-title">{{ $contact['info_title'] ?? 'معلومات التواصل' }}</h2>
                @if(!empty($contact['info_description']))
                  <p class="contact-description">
                    {!! $contact['info_description'] !!}
                  </p>
                @endif
              </div>
              <div class="contact-items">
                @if(!empty($contact['phone']))
                  <div class="contact-item">
                    <svg width="62" height="62" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="62" height="62" rx="31" fill="white" fill-opacity="0.2" />
                      <g clip-path="url(#clip0_1467_298)">
                        <path
                          d="M39.6571 33.8582C39.0794 33.3084 38.3121 33.0023 37.5147 33.0036C36.7172 33.0049 35.9509 33.3135 35.3751 33.8652L33.4691 35.4712C31.9132 34.8271 30.4999 33.882 29.3103 32.6902C28.1207 31.4983 27.1783 30.0833 26.5371 28.5262L28.1371 26.6262C28.6884 26.0503 28.9966 25.2841 28.9977 24.4869C28.9988 23.6897 28.6928 22.9226 28.1431 22.3452C28.1431 22.3452 26.2921 19.9422 26.2611 19.9112C25.6906 19.3364 24.9168 19.0093 24.107 19.0007C23.2973 18.9921 22.5166 19.3027 21.9341 19.8652L20.7841 20.8652C13.0641 29.0732 32.9841 49.0032 41.1841 41.1652L42.0961 40.1152C42.675 39.5342 43 38.7474 43 37.9272C43 37.107 42.675 36.3202 42.0961 35.7392C42.0641 35.7102 39.6571 33.8582 39.6571 33.8582ZM41.5651 31.5752C46.5561 24.2292 37.7651 15.4522 30.4271 20.4392C30.2096 20.591 30.0614 20.823 30.0149 21.0842C29.9685 21.3453 30.0277 21.6142 30.1796 21.8317C30.3314 22.0492 30.5634 22.1974 30.8246 22.2438C31.0857 22.2903 31.3546 22.231 31.5721 22.0792C37.0441 18.3212 43.6821 24.9622 39.9251 30.4312C39.8468 30.5387 39.7907 30.6608 39.7601 30.7903C39.7296 30.9198 39.7252 31.0541 39.7472 31.1853C39.7692 31.3165 39.8171 31.442 39.8882 31.5544C39.9593 31.6669 40.0522 31.764 40.1613 31.8401C40.2704 31.9162 40.3936 31.9698 40.5237 31.9977C40.6538 32.0256 40.7881 32.0273 40.9188 32.0026C41.0496 31.9779 41.1741 31.9274 41.285 31.854C41.396 31.7806 41.4912 31.6858 41.5651 31.5752V31.5752ZM37.7071 29.7102C37.8945 29.5227 37.9999 29.2684 37.9999 29.0032C37.9999 28.738 37.8945 28.4837 37.7071 28.2962L36.0001 26.5892V24.0002C36.0001 23.735 35.8947 23.4806 35.7072 23.2931C35.5197 23.1056 35.2653 23.0002 35.0001 23.0002C34.7349 23.0002 34.4805 23.1056 34.293 23.2931C34.1054 23.4806 34.0001 23.735 34.0001 24.0002V27.0002C34.0001 27.2654 34.1055 27.5197 34.2931 27.7072L36.2931 29.7072C36.4806 29.8947 36.7349 30 37.0001 30C37.2652 30 37.5196 29.8947 37.7071 29.7072V29.7102Z"
                          fill="white" />
                      </g>
                      <defs>
                        <clipPath id="clip0_1467_298">
                          <rect width="24" height="24" fill="white" transform="translate(19 19)" />
                        </clipPath>
                      </defs>
                    </svg>
                    <div class="contact-item-content">
                      <div class="contact-label">{{ $contact['phone_label'] ?? 'رقم الجوال' }}</div>
                      <div class="contact-value">{{ $contact['phone'] ?? '+966 1234 1234 123' }}</div>
                    </div>
                  </div>
                @endif
                @if(!empty($contact['email']))
                  <div class="contact-item">
                    <svg width="62" height="62" viewBox="0 0 62 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="62" height="62" rx="31" fill="white" fill-opacity="0.2" />
                      <g clip-path="url(#clip0_1467_307)">
                        <path
                          d="M33.746 25.285C33.9355 25.0995 34.1909 24.9969 34.4561 24.9997C34.7213 25.0025 34.9745 25.1105 35.16 25.3L37 27.181V20C37 19.7348 37.1054 19.4804 37.2929 19.2929C37.4804 19.1054 37.7348 19 38 19C38.2652 19 38.5196 19.1054 38.7071 19.2929C38.8946 19.4804 39 19.7348 39 20V27.181L40.84 25.3C41.0257 25.1104 41.279 25.0023 41.5444 24.9994C41.8098 24.9966 42.0654 25.0993 42.255 25.285C42.4446 25.4707 42.5527 25.724 42.5556 25.9894C42.5584 26.2548 42.4557 26.5104 42.27 26.7L39.755 29.27C39.2932 29.734 38.6666 29.9964 38.012 30C38.0058 30.0015 37.9992 30.0015 37.993 30C37.6697 30.0001 37.3496 29.9364 37.051 29.8125C36.7524 29.6886 36.4812 29.5069 36.253 29.278L33.73 26.7C33.6381 26.6061 33.5655 26.495 33.5166 26.373C33.4676 26.251 33.4432 26.1206 33.4447 25.9892C33.4462 25.8578 33.4735 25.7279 33.5253 25.6071C33.577 25.4863 33.652 25.3768 33.746 25.285V25.285ZM31 34.422C31.7955 34.4229 32.5588 34.1078 33.122 33.546L35.463 31.205C35.2396 31.0528 35.0304 30.8808 34.838 30.691L32.3 28.1C31.7436 27.5313 31.4359 26.765 31.4446 25.9695C31.4532 25.174 31.7774 24.4145 32.346 23.858C32.82 23.394 33.792 22.543 34.42 22H24C23.1432 22.0023 22.3015 22.2254 21.556 22.6477C20.8106 23.07 20.1865 23.6773 19.744 24.411L28.878 33.546C29.4412 34.1078 30.2045 34.4229 31 34.422ZM41.185 30.668C40.7179 31.1489 40.146 31.5153 39.5138 31.7386C38.8817 31.9619 38.2065 32.0359 37.541 31.955L34.536 34.96C33.5972 35.896 32.3257 36.4216 31 36.4216C29.6743 36.4216 28.4028 35.896 27.464 34.96L19.046 26.542C19.032 26.7 19 26.843 19 27V38C19.0016 39.3256 19.5289 40.5964 20.4662 41.5338C21.4036 42.4711 22.6744 42.9984 24 43H38C39.3256 42.9984 40.5964 42.4711 41.5338 41.5338C42.4711 40.5964 42.9984 39.3256 43 38V28.812L41.185 30.668Z"
                          fill="white" />
                      </g>
                      <defs>
                        <clipPath id="clip0_1467_307">
                          <rect width="24" height="24" fill="white" transform="translate(19 19)" />
                        </clipPath>
                      </defs>
                    </svg>
                    <div class="contact-item-content">
                      <div class="contact-label">{{ $contact['email_label'] ?? 'البريد الإلكتروني' }}</div>
                      <div class="contact-value">{{ $contact['email'] ?? 'domainname@gmail.com' }}</div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;">
          <!-- Left: Rights text -->
          <div style="flex:1 1 320px;visibility:visible;animation-name:fadeInRight;">
            <p style="margin:0;">
              جميع الحقوق محفوظة لدى
              <span style="font-weight:700;"> HR System </span>
              2025
            </p>
          </div>
          <!-- Right: Logo + Links -->
          <div style="flex:1 1 320px;visibility:visible;animation-name:fadeInLeft;">
            <div style="height:36px;">
              <div style="display:flex;justify-content:flex-start;align-items:center;flex-direction:row-reverse;">
                <a target="_blank" href="https://elryad.com/ar/" title="Web Design" style="color:#000;">
                  <svg height="90" width="102" style="transform:rotateY(180deg) scale(0.35);float:left;width:77px;">
                    <line x1="0" y1="0" x2="90" y2="0" style="stroke:#f00;stroke-width:35;"></line>
                    <line x1="100" y1="0" x2="0" y2="10" style="stroke:#f00;stroke-width:20;transform:rotate(40deg);">
                    </line>
                    <line x1="10" y1="95" x2="50" y2="45" style="stroke:#f00;stroke-width:20;"></line>
                  </svg>
                </a>
                <div style="float:right;text-align:left;position:relative;left:-15px;">
                  <a target="_blank" href="https://elryad.com/ar/" title="Web Design"
                    style="color:#000;text-decoration:none;">
                    <p style="text-transform:uppercase;font-size:20px;line-height:0.7;margin:0;font-weight:700;">
                      elryad
                    </p>
                  </a>
                  <span style="font-size:12px;color:#000;">
                    <a target="_blank" href="https://elryad.com/ar/" title="تصميم مواقع"
                      style="font-size:12px;color:inherit;text-decoration:none;">
                      تصميم مواقع
                    </a>
                    /
                    <a target="_blank" href="https://elryad.com/ar/saudi-hosting/" title="استضافة مواقع"
                      style="font-size:12px;color:inherit;text-decoration:none;">
                      استضافة مواقع
                    </a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </footer>
  </div>

  <!-- jQuery (required for Owl Carousel) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Owl Carousel JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
</body>

</html>