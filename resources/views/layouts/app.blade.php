<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'جمعية أبناء طبهار')</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Cairo', sans-serif; }
        @media print {
            .print\:hidden { display: none !important; }
            aside { display: none !important; }
            main { padding-right: 0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
            .print\:block { display: block !important; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: right; }
            th { background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; }
            body { background: white !important; }
            .animate-fade-in { animation: none !important; opacity: 1 !important; transform: none !important; }
            .glass-sidebar, .btn-primary, .nav-link, button, form { display: none !important; }
        }
    </style>
    <script>
        function exportToExcel(tableId, filename = '') {
            let table = document.getElementById(tableId);
            if (!table) return;
            
            let csv = [];
            let rows = table.querySelectorAll("tr");
            
            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length; j++) {
                    let data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, "").replace(/(\s\s+)/gm, " ");
                    data = data.replace(/"/g, '""');
                    row.push('"' + data + '"');
                }
                csv.push(row.join(","));
            }

            let csvString = "\uFEFF" + csv.join("\n"); 
            let blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
            let link = document.createElement("a");
            let url = URL.createObjectURL(blob);
            
            link.setAttribute("href", url);
            link.setAttribute("download", (filename || 'report') + '.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] text-slate-900 leading-relaxed overflow-x-hidden selection:bg-emerald-500/30 selection:text-emerald-900">
    <div class="flex min-h-screen">
        <aside class="w-80 glass-sidebar {{ request()->routeIs('home') ? 'hidden' : 'flex' }} flex-col shrink-0 print:hidden z-50 fixed h-full transition-all duration-300">
            <div class="p-8 pb-6">
                <div class="flex items-center gap-4 p-4 rounded-3xl bg-white/5 border border-white/5 backdrop-blur-sm">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 group cursor-pointer hover:scale-110 transition-transform">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white leading-tight tracking-tight">أبناء طبهار</h1>
                        <span class="text-[10px] text-emerald-400 font-black uppercase tracking-widest block mt-0.5">نظام الإدارة المتكامل</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 overflow-y-auto pb-6 space-y-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} animate-fade-right" style="animation-delay: 0.05s">
                    <div class="sidebar-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <span class="font-bold relative z-10">الرئيسية</span>
                </a>

                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} animate-fade-right" style="animation-delay: 0.1s">
                    <div class="sidebar-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <span class="font-bold relative z-10">لوحة التحكم</span>
                </a>

                <p class="section-label animate-fade-right" style="animation-delay: 0.15s">قواعد البيانات</p>
                
                <a href="{{ route('beneficiaries.index') }}" class="nav-link {{ request()->routeIs('beneficiaries.*') ? 'active' : '' }} animate-fade-right" style="animation-delay: 0.2s">
                    <div class="sidebar-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="font-bold relative z-10">سجل المستفيدين</span>
                </a>

                <a href="{{ route('supporters.index') }}" class="nav-link {{ request()->routeIs('supporters.*') ? 'active' : '' }} animate-fade-right" style="animation-delay: 0.25s">
                    <div class="sidebar-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold relative z-10">الداعمين والشركاء</span>
                </a>

                <p class="section-label animate-fade-right" style="animation-delay: 0.3s">الإدارة</p>

                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }} animate-fade-right" style="animation-delay: 0.35s">
                    <div class="sidebar-icon">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-bold relative z-10">شؤون الموظفين</span>
                </a>

                
            </nav>

            <div class="p-6 border-t border-white/5 bg-slate-900/60 backdrop-blur-md">
                <div class="flex items-center gap-3 mb-6 px-2 p-3 rounded-2xl bg-white/5 border border-white/5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 text-white flex items-center justify-center font-black shadow-lg">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-black text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-emerald-400 font-bold uppercase">{{ auth()->user()->role == 'admin' ? 'مدير النظام' : 'مستخدم' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 rounded-xl text-rose-400 font-bold border border-rose-500/20 hover:bg-rose-500/10 hover:border-rose-500/40 transition-all active:scale-95 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        خروج من النظام
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 min-h-screen {{ request()->routeIs('home') ? '!pr-0' : 'pr-80' }} transition-all duration-300">
            <div class="{{ request()->routeIs('home') ? '' : 'p-8 lg:p-12 max-w-[1600px] mx-auto' }} animate-fade-in">
                @if(session('success'))
                    <div class="mb-10 p-5 bg-emerald-50 border border-emerald-100 rounded-[2rem] flex items-center gap-4 animate-scale-in shadow-lg shadow-emerald-500/5 print:hidden">
                        <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-md">✔</div>
                        <p class="font-black text-emerald-800">{{ session('success') }}</p>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
