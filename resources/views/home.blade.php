@extends('layouts.app')

@section('title', 'الرئيسية - جمعية أبناء طبهار')

@section('content')
<style>
    /* Premium Look & Feel Enhancements */
    :root {
        --primary-gold: #fbbf24;
        --primary-emerald: #059669;
        --soft-emerald: #ecfdf5;
        --text-slate: #1e293b;
        --text-muted: #64748b;
    }

    /* Hero Section */
    .hero-container {
        position: relative;
        overflow: hidden;
        min-height: 85vh;
        background: #111827;
        margin-bottom: 3rem;
        border-radius: 0;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.65;
        transform: scale(1.05);
        filter: brightness(0.8);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(6, 78, 59, 0.4) 0%, rgba(17, 24, 39, 0.85) 100%);
        z-index: 1;
    }

    .hero-content-inner {
        position: relative;
        z-index: 10;
        padding: 5rem 6%;
        color: white;
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 2rem;
        text-shadow: 0 4px 15px rgba(0,0,0,0.4);
    }

    .hero-title span {
        color: var(--primary-gold);
        position: relative;
    }

    .hero-description {
        font-size: 1.5rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.95);
        max-width: 700px;
        margin-bottom: 3rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 2.5rem;
        border-radius: 1.25rem;
        font-weight: 800;
        font-size: 1.125rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    .btn-hero-primary {
        background: var(--primary-gold);
        color: #1a2e26;
        box-shadow: 0 10px 25px -5px rgba(251, 191, 36, 0.4);
    }

    .btn-hero-primary:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 35px -8px rgba(251, 191, 36, 0.5);
    }

    .btn-hero-outline {
        border: 2px solid rgba(255, 255, 255, 0.4);
        color: white;
        backdrop-filter: blur(15px);
    }

    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: white;
        transform: translateY(-5px);
    }

    /* Stats Section */
    .stats-outer {
        padding: 0 6%;
        margin-top: -6rem;
        position: relative;
        z-index: 20;
    }

    .stats-grid-custom {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .stat-card-custom {
        background: white;
        padding: 3rem 2rem;
        border-radius: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.1);
        border: 1px solid rgba(241, 245, 249, 1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card-custom:hover {
        transform: translateY(-15px);
        box-shadow: 0 40px 70px -15px rgba(5, 150, 105, 0.2);
        border-color: #dcfce7;
    }

    .stat-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 2rem;
        background: #f0fdf4;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--primary-emerald);
        transition: all 0.4s;
    }

    .stat-card-custom:hover .stat-icon-wrapper {
        background: var(--primary-emerald);
        color: white;
        transform: rotate(15deg) scale(1.1);
    }

    .stat-value-custom {
        font-size: 2.75rem;
        font-weight: 950;
        color: var(--text-slate);
        letter-spacing: -1.5px;
    }

    .stat-label-custom {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-muted);
        margin-top: 0.5rem;
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 5rem;
        padding-top: 4rem;
    }

    .section-tag {
        display: inline-block;
        padding: 0.75rem 2rem;
        background: #ecfdf5;
        color: #059669;
        border-radius: 2rem;
        font-weight: 900;
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        border: 1px solid rgba(5, 150, 105, 0.1);
    }

    .section-header h2 {
        font-size: 3.5rem;
        font-weight: 950;
        color: var(--text-slate);
    }

    .section-header h2 span {
        color: var(--primary-emerald);
        background: linear-gradient(120deg, #10b981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Vision & Mission - Fixed with equal spacing */
    .vm-container {
        padding: 0 6% 6rem;
        padding-bottom: 5px;
    }

    .vision-mission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem; /* Fixed equal spacing */
        max-width: 1300px;
        margin: 0 auto;
    }

    .vm-card {
        padding: 4.5rem;
        border-radius: 4rem;
        background: white;
        border: 1px solid #f1f5f9;
        box-shadow: 0 30px 60px -15px rgba(0,0,0,0.06);
        transition: all 0.5s;
        position: relative;
        overflow: hidden;
    }

    .vm-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 45px 80px -20px rgba(0,0,0,0.12);
        background-color: #f8fafc;
    }

    .vm-card h3 {
        font-size: 2.75rem;
        font-weight: 950;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .vm-description {
        font-size: 1.25rem;
        line-height: 2;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* Activities */
    .activities-outer {
        background: #f8fafc;
        padding: .5rem 5%;
        border-radius: 6rem;
        margin: 2rem 1rem;
        
    }

    .activities-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
    }

    .activity-card {
        background: white;
        border-radius: 3rem;
        padding: 4rem 2.5rem;
        text-align: center;
        transition: all 0.4s;
        border: 1px solid #f1f5f9;
        box-shadow: 0 15px 35px -10px rgba(0,0,0,0.04);
    }

    .activity-card:hover {
        transform: scale(1.05);
        box-shadow: 0 40px 60px -20px rgba(0,0,0,0.1);
    }

    .activity-icon {
        width: 100px;
        height: 100px;
        border-radius: 2.5rem;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 2.5rem;
        transition: all 0.4s;
    }

    .activity-card:hover .activity-icon {
        background: var(--primary-emerald);
        color: white;
        transform: translateY(-10px);
    }

    /* Principles Section */
    .principles-container {
        padding: 0 8% 10rem;
    }

    .principles-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .principle-card {
        background: white;
        padding: 4rem 2.5rem 3.5rem;
        border-radius: 3rem;
        text-align: center;
        border: 1px solid #f1f5f9;
        transition: all 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .principle-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 5px;
        border-radius: 0 0 6px 6px;
        transition: opacity 0.4s;
        opacity: 0;
    }

    .principle-card:nth-child(1)::after { background: linear-gradient(90deg, #059669, #10b981); }
    .principle-card:nth-child(2)::after { background: linear-gradient(90deg, #2563eb, #60a5fa); }
    .principle-card:nth-child(3)::after { background: linear-gradient(90deg, #9333ea, #c084fc); }
    .principle-card:nth-child(4)::after { background: linear-gradient(90deg, #ea580c, #fb923c); }

    .principle-card:hover {
        transform: translateY(-14px);
        box-shadow: 0 35px 60px -15px rgba(0,0,0,0.1);
        border-color: #e2e8f0;
    }

    .principle-card:hover::after { opacity: 1; }

    .principle-icon {
        width: 90px;
        height: 90px;
        border-radius: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.75rem;
        margin: 0 auto 2rem;
        transition: all 0.4s;
    }

    .principle-card:nth-child(1) .principle-icon { background: #f0fdf4; }
    .principle-card:nth-child(2) .principle-icon { background: #eff6ff; }
    .principle-card:nth-child(3) .principle-icon { background: #faf5ff; }
    .principle-card:nth-child(4) .principle-icon { background: #fff7ed; }

    .principle-card:hover .principle-icon {
        transform: scale(1.12) rotate(8deg);
    }

    .principle-card h4 {
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--text-slate);
        margin-bottom: 1rem;
    }

    .principle-card p {
        color: var(--text-muted);
        line-height: 1.7;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Footer - Redesigned & Professional */
    .main-footer {
        background: #0f172a;
        color: white;
        padding: 7rem 6% 3rem;
        position: relative;
        overflow: hidden;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 4rem;
        position: relative;
        z-index: 10;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 5rem;
        margin-bottom: 3rem;
    }

    .footer-brand h4 {
        font-size: 2rem;
        font-weight: 900;
        margin: 1.5rem 0;
        color: white;
    }

    .footer-brand p {
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.8;
        font-size: 1.1rem;
        max-width: 350px;
    }

    .footer-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        color: var(--primary-gold);
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 1.25rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 600;
        font-size: 1.05rem;
    }

    .footer-links a:hover {
        color: white;
        padding-right: 0.5rem;
    }

    .social-icons-footer {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.4s;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-icon:hover {
        background: var(--primary-emerald);
        border-color: var(--primary-emerald);
        transform: translateY(-5px);
    }

    .copyright-area {
        text-align: center;
        color: rgba(255, 255, 255, 0.4);
        font-weight: 700;
        font-size: 1rem;
    }

    @media (max-width: 1024px) {
        .footer-content { grid-template-columns: 1fr 1fr; }
        .hero-title { font-size: 3.25rem; }
        .vision-mission-grid { grid-template-columns: 1fr; }
        .stats-grid-custom { grid-template-columns: repeat(2, 1fr); }
        .activities-grid { grid-template-columns: 1fr 1fr; }
    }
</style>

<div class="animate-fade-in">
    <!-- Hero Section -->
    <div class="hero-container">
        <div class="hero-bg">
            <img src="{{ asset('build/assets/hero-cover-CRUrHG2d.jpg') }}" alt="صورة غلاف الجمعية الخيرية">
            <div class="hero-overlay"></div>
        </div>
        
        <!-- Top Nav -->
        <nav class="relative z-20 flex items-center justify-between p-8 px-[6%]">
            <div class="flex items-center ">
                <div class="w-16 h-16 rounded-[1.5rem] p-2.5 flex items-center justify-center shadow-2xl transition-transform hover:rotate-6 hover:scale-110" style="width: 130px;height: auto;">
                    <img src="{{ asset('logo.png') }}" alt="شعار جمعية أبناء طبهار" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-black text-white leading-tight drop-shadow-lg">جمعية أبناء طبهار</span>
                    <span class="text-sm font-bold text-amber-400 uppercase tracking-widest px-1" style="color: #FFD700;">الرؤية والعمل الخيري</span>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-10 py-4 rounded-[1.25rem] bg-white/10 text-white font-black border-2 border-white/20 backdrop-blur-xl hover:bg-rose-600 hover:border-rose-600 transition-all active:scale-95 flex items-center gap-3 group shadow-2xl">
                    <span>خروج من النظام</span>
                    <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </div>
        </nav>

        <div class="hero-content-inner">
            <h1 class="hero-title animate-fade-right">
                نمدّ يد العون
                <br>
                <span>لمن يحتاج</span>
            </h1>
            <p class="hero-description animate-fade-right" style="animation-delay: 0.2s">
                نظام إلكتروني متقدم لإدارة الأعمال الخيرية في قرية طبهار، المصمم بكفاءة لضمان وصول الدعم لمن يستحق .
            </p>
            <div class="flex flex-wrap gap-5 animate-fade-right" style="animation-delay: 0.4s">
                <a href="{{ route('dashboard') }}" class="btn-hero btn-hero-primary" style="margin-left:10px">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    لوحة التحكم العامة
                </a>
                <a href="{{ route('beneficiaries.index') }}" class="btn-hero btn-hero-outline">
                    قاعدة بيانات المستفيدين
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-outer">
        <div class="stats-grid-custom">
            <div class="stat-card-custom animate-fade-up" style="animation-delay: 0.5s">
                <div class="stat-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <span class="stat-value-custom">{{ number_format($stats['beneficiaries']) }}+</span>
                <span class="stat-label-custom">حالات مسجلة</span>
            </div>

            <div class="stat-card-custom animate-fade-up" style="animation-delay: 0.6s">
                <div class="stat-icon-wrapper" style="background: #eff6ff; color: #2563eb;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </div>
                <span class="stat-value-custom">{{ number_format($stats['supporters']) }}</span>
                <span class="stat-label-custom">شركاء العطاء</span>
            </div>

            <div class="stat-card-custom animate-fade-up" style="animation-delay: 0.7s">
                <div class="stat-icon-wrapper" style="background: #fdf2f8; color: #db2777;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <span class="stat-value-custom">{{ number_format($stats['donations_count']) }}</span>
                <span class="stat-label-custom">تدخلات إنسانية</span>
            </div>

            <div class="stat-card-custom animate-fade-up" style="animation-delay: 0.8s">
                <div class="stat-icon-wrapper" style="background: #fff7ed; color: #ea580c;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <span class="stat-value-custom">{{ number_format($stats['projects_count'] ?: 45) }}</span>
                <span class="stat-label-custom">نطاقات خدمية</span>
            </div>
        </div>
    </div>

    <!-- About Section - Who We Are -->
    <section class="mt-40 mb-20 px-[6%]">
        <div class="section-header">
            <span class="section-tag">من نحن</span>
            <h2>قصة <span>العطاء والمجهود</span></h2>
            <p class="text-slate-500 max-w-4xl mx-auto mt-8 text-2xl leading-relaxed font-medium">
                جمعية أبناء طبهار هي كيان مجتمعي رائد، تأسس بقلب واحد يجمع أهل القرية، لتقديم نموذج مشرف للعمل الخيري المؤسسي المتطور الذي يخدم الإنسان ويصون كرامته.
            </p>
        </div>

        <div class="vm-container">
            <div class="vision-mission-grid">
                <div class="vm-card animate-fade-right" style="animation-delay: 0.4s">
                    <h3 class="text-emerald-700">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-emerald-50 flex items-center justify-center text-emerald-600 text-3xl">🎯</div>
                        رؤيتنا
                    </h3>
                    <p class="vm-description">
                        تتلخص رؤيتنا في خلق مجتمع متماسك وقوي، حيث يتمكن كل فرد تحت مظلة "أبناء طبهار" من الحصول على الدعم الذي يضمن له حياة كريمة، مستندين إلى أفضل التقنيات في إدارة المكاتب الخيرية.
                    </p>
                </div>
                <div class="vm-card animate-fade-left" style="animation-delay: 0.4s">
                    <h3 class="text-blue-700">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-blue-50 flex items-center justify-center text-blue-600 text-3xl">💎</div>
                        رسالتنا
                    </h3>
                    <p class="vm-description">
                        نحن ملتزمون بتقديم الدعم الكامل للأسر المستحقة، من خلال تنفيذ برامج مستدامة تشمل المساعدات العينية، التعليم، الرعاية الصحية، وتيسير سبل الحياة الكريمة لكل محتاج في قريتنا.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <section class="activities-outer">
        <div class="section-header">
            <span class="section-tag">ماذا نقدم؟</span>
            <h2>خدماتنا <span>وتدخلاتنا</span></h2>
        </div>

        <div class="activities-grid">
            <div class="activity-card">
                <div class="activity-icon">👶</div>
                <h4>كفالة الأيتام</h4>
                <p class="font-bold">رعاية شاملة تضمن مستقبلًا مشرقًا لأطفالنا</p>
            </div>
            <div class="activity-card">
                <div class="activity-icon">🍲</div>
                <h4>بنك الطعام</h4>
                <p class="font-bold">سلال غذائية ووجبات يومية تجسد معاني التكافل</p>
            </div>
            <div class="activity-card">
                <div class="activity-icon">👗</div>
                <h4>تجهيز العرائس</h4>
                <p class="font-bold">إعانة وتيسير الزواج للفتيات المقبلات عليه</p>
            </div>
            <div class="activity-card">
                <div class="activity-icon">🏥</div>
                <h4>الدعم الصحي</h4>
                <p class="font-bold">توفير الأدوية والعلاجات للحالات المرضية الحرجة</p>
            </div>
            <div class="activity-card">
                <div class="activity-icon">🧥</div>
                <h4>بنك الكساء</h4>
                <p class="font-bold">كسوة تليق بكرامة أهلنا في مختلف المواسم</p>
            </div>
            <div class="activity-card">
                <div class="activity-icon">📚</div>
                <h4>الدعم التعليمي</h4>
                <p class="font-bold">مساندة الطلاب في مسيرتهم العلمية وبناء كوادرنا</p>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="principles-container">
        <div class="section-header">
            <span class="section-tag">مبادئنا</span>
            <h2>قيم <span>العمل لدينا</span></h2>
        </div>

        <div class="principles-grid">
            <div class="principle-card">
                <div class="principle-icon">⚖️</div>
                <h4>العدالة</h4>
                <p>توزيع المساعدات بناءً على درجات الاحتياج الموثقة رقميًا.</p>
            </div>
            <div class="principle-card">
                <div class="principle-icon">🔐</div>
                <h4>الأمانة</h4>
                <p>نحن أمناء على تبرعاتكم ونضمن وصول كل قرش لمكانه الصحيح.</p>
            </div>
            <div class="principle-card">
                <div class="principle-icon">🛡️</div>
                <h4>الكرامة</h4>
                <p>التعامل مع المستفيد بكل احترام وخصوصية هي أولويتنا القصوى.</p>
            </div>
            <div class="principle-card">
                <div class="principle-icon">📈</div>
                <h4>التطوير</h4>
                <p>استخدام أحدث الأدوات التقنية لضمان دقة التنفيذ والتقارير.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="w-20 h-20 rounded-2xl p-3 flex items-center justify-center shadow-xl" style="width:14rem">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-contain" style="width:14rem; height:8rem">
                </div>
                <h4>جمعية أبناء طبهار</h4>
                <p>نظام ذكي متكامل لإدارة الأعمال الخيرية والاجتماعية في قرية طبهار، يهدف إلى ترسيخ قيم التكافل الاجتماعي.</p>
                <div class="social-icons-footer">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">t</a>
                    <a href="#" class="social-icon">i</a>
                    <a href="#" class="social-icon">w</a>
                </div>
            </div>

            <div>
                <h5 class="footer-title">روابط سريعة</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
                    <li><a href="{{ route('beneficiaries.index') }}">سجل المستفيدين</a></li>
                    <li><a href="{{ route('supporters.index') }}">الداعمين</a></li>
                </ul>
            </div>

            <div>
                <h5 class="footer-title">خدماتنا</h5>
                <ul class="footer-links">
                    <li><a href="#">كفالات الأيتام</a></li>
                    <li><a href="#">المساعدات الغذائية</a></li>
                    <li><a href="#">الدعم الطبي</a></li>
                    <li><a href="#">تيسير الزواج</a></li>
                </ul>
            </div>

            <div>
                <h5 class="footer-title">تواصل معنا</h5>
                <ul class="footer-links">
                    <li class="text-slate-400">📍 طبهار، الفيوم</li>
                    <li class="text-slate-400">📧 info@tabhar.org</li>
                    <li class="text-slate-400">📞 0123456789</li>
                    <li class="mt-4"><a href="#" class="px-5 py-2.5 bg-emerald-600 rounded-xl text-white inline-block">تواصل عبر واتساب</a></li>
                </ul>
            </div>
        </div>

        <div class="copyright-area">
            <p>© {{ date('Y') }} جمعية أبناء طبهار الخيرية - جميع الحقوق محفوظة</p>
            <p class="mt-2 text-[12px] opacity-30">تم التطوير لدعم العمل الخيري الرقمي</p>
        </div>
        
        <!-- Subtle backround shapes -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-600/5 rounded-full blur-[100px] -z-0"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/5 rounded-full blur-[100px] -z-0"></div>
    </footer>
</div>
@endsection