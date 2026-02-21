<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الجمعية الخيرية - نمدّ يد العون لمن يحتاج</title>
    <meta name="description" content="نظام إلكتروني متكامل لإدارة أعمال الجمعية الخيرية، يهدف إلى تنظيم بيانات المستفيدين والداعمين وإدارة المساعدات بطريقة احترافية.">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --background: 140 20% 97%;
            --foreground: 160 30% 10%;
            --card: 0 0% 100%;
            --card-foreground: 160 30% 10%;
            --primary: 160 60% 30%;
            --primary-foreground: 0 0% 100%;
            --secondary: 42 80% 55%;
            --secondary-foreground: 0 0% 100%;
            --muted: 140 15% 93%;
            --muted-foreground: 160 10% 45%;
            --accent: 160 40% 92%;
            --accent-foreground: 160 60% 20%;
            --border: 140 15% 88%;
            --radius: 0.75rem;
            --gradient-hero: linear-gradient(135deg, hsl(160, 60%, 30%,.3) 0%, hsl(160, 40%, 14%) 100%);
            --shadow-card: 0 4px 24px -4px hsl(160 30% 20% / 0.08);
            --shadow-elevated: 0 12px 40px -8px hsl(160 30% 20% / 0.15);
        }
        body {
            font-family: 'Cairo', sans-serif;
            background: hsl(var(--background));
            color: hsl(var(--foreground));
            -webkit-font-smoothing: antialiased;
            direction: rtl;
        }
        /* Hero Section */
        .hero {
            position: relative;
            min-height: 85vh;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
        }
        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: var(--gradient-hero);
            opacity: 0.8;
        }
        /* Nav */
        .nav {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 3rem;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .nav-icon {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            background: hsl(var(--secondary));
        }
        .nav-icon svg {
            width: 22px;
            height: 22px;
            color: hsl(var(--secondary-foreground));
        }
        .nav-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: hsl(var(--primary-foreground));
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius);
            font-family: 'Cairo', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-outline {
            border: 1px solid hsl(var(--primary-foreground) / 0.3);
            background: hsl(var(--primary-foreground) / 0.1);
            color: hsl(var(--primary-foreground));
            backdrop-filter: blur(8px);
        }
        .btn-outline:hover {
            background: hsl(var(--primary-foreground) / 0.2);
        }
        .btn-secondary {
            border: none;
            background: hsl(var(--secondary));
            color: hsl(var(--secondary-foreground));
            font-weight: 700;
            font-size: 1rem;
            padding: 0.75rem 2rem;
        }
        .btn-secondary:hover {
            opacity: 0.9;
        }
        .btn-lg {
            padding: 0.75rem 2rem;
            font-size: 1rem;
        }
        /* Hero Content */
        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            min-height: 70vh;
            align-items: center;
            padding: 0 3rem;
        }
        .hero-text {
            max-width: 42rem;
        }
        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.15;
            color: hsl(var(--primary-foreground));
            margin-bottom: 1.5rem;
        }
        .hero-text h1 span {
            color: hsl(var(--secondary));
        }
        .hero-text p {
            font-size: 1.25rem;
            line-height: 1.8;
            color: hsl(var(--primary-foreground) / 0.8);
            margin-bottom: 2rem;
        }
        .hero-buttons {
            display: flex;
            gap: 1rem;
        }
        /* Stats */
        .stats-section {
            position: relative;
            z-index: 10;
            margin-top: -4rem;
            padding: 0 3rem;
        }
        .stats-grid {
            max-width: 64rem;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
        .stat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            border-radius: var(--radius);
            padding: 1.5rem;
            text-align: center;
            background: hsl(var(--card) / 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid hsl(var(--border) / 0.5);
            box-shadow: var(--shadow-card);
            transition: all 0.3s;
        }
        .stat-card:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-elevated);
        }
        .stat-card svg {
            width: 28px;
            height: 28px;
            color: hsl(var(--primary));
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 900;
            color: hsl(var(--foreground));
        }
        .stat-label {
            font-size: 0.875rem;
            color: hsl(var(--muted-foreground));
        }
        /* About */
        .about-section {
            padding: 5rem 3rem;
        }
        .about-inner {
            max-width: 56rem;
            margin: 0 auto;
            text-align: center;
        }
        .about-inner h2 {
            font-size: 2rem;
            font-weight: 700;
            color: hsl(var(--foreground));
            margin-bottom: 1.5rem;
        }
        .about-inner h2 span {
            color: hsl(var(--primary));
        }
        .about-inner > p {
            font-size: 1.125rem;
            line-height: 1.8;
            color: hsl(var(--muted-foreground));
            margin-bottom: 3rem;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .feature-card {
            border-radius: var(--radius);
            padding: 1.5rem;
            text-align: center;
            background: hsl(var(--card) / 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid hsl(var(--border) / 0.5);
            box-shadow: var(--shadow-card);
        }
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: hsl(var(--foreground));
            margin-bottom: 0.75rem;
        }
        .feature-card p {
            font-size: 0.875rem;
            color: hsl(var(--muted-foreground));
        }
        /* Footer */
        .footer {
            background: var(--gradient-hero);
            padding: 2rem;
            text-align: center;
        }
        .footer p {
            font-size: 0.875rem;
            color: hsl(var(--primary-foreground) / 0.6);
        }
        /* Responsive */
        @media (max-width: 768px) {
            .nav { padding: 1.5rem; }
            .hero-content { padding: 0 1.5rem; }
            .hero-text h1 { font-size: 2.25rem; }
            .hero-text p { font-size: 1rem; }
            .stats-section { padding: 0 1.5rem; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .about-section { padding: 3rem 1.5rem; }
            .features-grid { grid-template-columns: 1fr; }
        }
        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
        }
        .animate-delay-1 { animation-delay: 0.2s; opacity: 0; }
        .animate-delay-2 { animation-delay: 0.4s; opacity: 0; }
        .animate-delay-3 { animation-delay: 0.6s; opacity: 0; }
        .animate-delay-4 { animation-delay: 0.7s; opacity: 0; }
        .animate-delay-5 { animation-delay: 0.8s; opacity: 0; }
        .animate-delay-6 { animation-delay: 0.9s; opacity: 0; }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-bg">
                <img src="{{ public/build/assets/images/hero-cover.jpg }}" alt="صورة غلاف الجمعية الخيرية">
                <div class="hero-overlay"></div>
            </div>
            <!-- Nav -->
            <nav class="nav">
                <div class="nav-brand">
                    <div class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 15 6 6"/><path d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z"/></svg>
                    </div>
                    <span class="nav-title">الجمعية الخيرية</span>
                </div>
                <a href="{{ route('logout') }}" class="btn btn-outline">
                   تسجيل الخروج
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                </a>
            </nav>
            <!-- Hero Content -->
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="animate-fade-in-up">
                        نمدّ يد العون
                        <br>
                        <span>لمن يحتاج</span>
                    </h1>
                    <p class="animate-fade-in-up animate-delay-1">
                          نظام إلكتروني متكامل لإدارة أعمال الجمعية الخيرية، يهدف إلى تنظيم بيانات المستفيدين
                           والداعمين وإدارة المساعدات بطريقة احترافية.
                    </p>
                    <div class="hero-buttons animate-fade-in-up animate-delay-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">ابدأ الآن</a>
                        <a href="{{ route('beneficiaries') }}" class="btn btn-outline btn-lg">المستفيدون</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Stats -->
        <section class="stats-section">
            
            <div class="stats-grid">
                <div class="stat-card animate-fade-in-up animate-delay-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="stat-value">1,200+</span>
                    <span class="stat-label">مستفيد</span>
                </div>
                <div class="stat-card animate-fade-in-up animate-delay-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    <span class="stat-value">350+</span>
                    <span class="stat-label">داعم</span>
                </div>
                <div class="stat-card animate-fade-in-up animate-delay-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 15 6 6"/><path d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z"/></svg>
                    <span class="stat-value">5,000+</span>
                    <span class="stat-label">مساعدة</span>
                </div>
                <div class="stat-card animate-fade-in-up animate-delay-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    <span class="stat-value">45+</span>
                    <span class="stat-label">مشروع</span>
                </div>
            </div>
        </section>
        <!-- About -->
        <section class="about-section">
            <div class="about-inner">
                <h2>عن <span>الجمعية</span></h2>
                <p>
                    تسعى الجمعية الخيرية إلى تقديم المساعدات للمحتاجين وتنظيم العمل الخيري
                    بأعلى معايير الجودة والشفافية. نعمل على تحويل العمل الإداري من النظام
                    الورقي إلى نظام رقمي متكامل يساهم في تنظيم وحفظ البيانات بشكل آمن.
                </p>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>تنظيم البيانات</h3>
                        <p>حفظ وتنظيم بيانات المستفيدين والداعمين بشكل آمن ومنظم</p>
                    </div>
                    <div class="feature-card">
                        <h3>متابعة المساعدات</h3>
                        <p>توثيق وتتبع جميع المساعدات المقدمة بدقة وشفافية</p>
                    </div>
                    <div class="feature-card">
                        <h3>تقارير شاملة</h3>
                        <p>إنشاء تقارير تفصيلية قابلة للطباعة والمشاركة</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="footer">
            <p>© {{ date('Y') }} الجمعية الخيرية - جميع الحقوق محفوظة</p>
        </footer>
    </div>
</body>
</html>