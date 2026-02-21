@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="space-y-8 animate-fade-in pb-20">
    <div class="print:hidden">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">
                مرحباً بك، <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-500">{{ auth()->user()->name }}</span> 👋
            </h2>
            <p class="text-slate-500 text-lg font-bold opacity-80">نظام الإدارة المتكامل لجمعية أبناء طبهار</p>
        </div>
        <div class="flex gap-4">
            <button onclick="window.print()" class="px-6 py-3 rounded-2xl bg-white border-2 border-slate-200 text-slate-700 font-bold hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center gap-2 shadow-sm group">
                <svg class="h-5 w-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                تقرير سريع
            </button>
            <a href="{{ route('beneficiaries.create') }}" class="btn-primary flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                إضافة حالة
            </a>
            <a href="{{ route('beneficiaries.index') }}" class="px-6 py-3 rounded-2xl bg-purple-600 text-white font-bold hover:bg-purple-700 transition-all flex items-center gap-2 shadow-lg shadow-purple-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                صرف مساعدة
            </a>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        <div class="glass-effect bg-white rounded-[2rem] p-8 border border-emerald-100 shadow-xl shadow-emerald-500/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300 animate-fade-up" style="animation-delay: 0.1s">
            <div class="relative z-10">
                <p class="text-slate-500 font-bold text-sm mb-2 uppercase tracking-wider">إجمالي المستفيدين</p>
                <h3 class="text-5xl font-black text-emerald-600 tracking-tight group-hover:scale-105 transition-transform origin-right">{{ number_format($stats['beneficiaries']) }}</h3>
                <div class="mt-4 flex items-center gap-2 text-emerald-700 font-bold text-xs bg-emerald-50 px-3 py-1.5 rounded-xl w-fit">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>محدث الآن</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors"></div>
        </div>

        <div class="glass-effect bg-white rounded-[2rem] p-8 border border-blue-100 shadow-xl shadow-blue-500/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-up" style="animation-delay: 0.2s">
            <div class="relative z-10">
                <p class="text-slate-500 font-bold text-sm mb-2 uppercase tracking-wider">إجمالي التبرعات (داخل)</p>
                <h3 class="text-4xl font-black text-blue-600 tracking-tight group-hover:scale-105 transition-transform origin-right">{{ number_format($stats['income']) }} <small class="text-sm">ج.م</small></h3>
                <div class="mt-4 flex items-center gap-2 text-blue-700 font-bold text-xs bg-blue-50 px-3 py-1.5 rounded-xl w-fit">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>إجمالي الإيرادات</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-colors"></div>
        </div>

        <div class="glass-effect bg-white rounded-[2rem] p-8 border border-purple-100 shadow-xl shadow-purple-500/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-300 animate-fade-up" style="animation-delay: 0.3s">
            <div class="relative z-10">
                <p class="text-slate-500 font-bold text-sm mb-2 uppercase tracking-wider">إجمالي المصروفات (خارج)</p>
                <h3 class="text-4xl font-black text-rose-600 tracking-tight group-hover:scale-105 transition-transform origin-right">{{ number_format($stats['donations']) }} <small class="text-sm">ج.م</small></h3>
                <div class="mt-4 flex items-center gap-2 text-rose-700 font-bold text-xs bg-rose-50 px-3 py-1.5 rounded-xl w-fit">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V4M7 14H2v-1M7 9a3 3 0 116 0A3 3 0 0113 9M21 21l-6-6"></path></svg>
                    <span>مساعدات منصرفة</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition-colors"></div>
        </div>

        <div class="glass-effect bg-white rounded-[2rem] p-8 border border-amber-100 shadow-xl shadow-amber-500/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-300 animate-fade-up" style="animation-delay: 0.4s">
            <div class="relative z-10">
                <p class="text-slate-500 font-bold text-sm mb-2 uppercase tracking-wider">الرصيد المتبقي (صافي)</p>
                <h3 class="text-4xl font-black text-amber-600 tracking-tight group-hover:scale-105 transition-transform origin-right">{{ number_format($stats['balance']) }} <small class="text-sm">ج.م</small></h3>
                <div class="mt-4 flex items-center gap-2 text-amber-700 font-bold text-xs bg-amber-50 px-3 py-1.5 rounded-xl w-fit">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span>نقدية الجمعية الآن</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition-colors"></div>
        </div>

        <div class="glass-effect bg-white rounded-[2rem] p-8 border border-orange-100 shadow-xl shadow-orange-500/5 relative overflow-hidden group hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-300 animate-fade-up" style="animation-delay: 0.5s">
            <div class="relative z-10">
                <p class="text-slate-500 font-bold text-sm mb-2 uppercase tracking-wider">فريق العمل</p>
                <h3 class="text-5xl font-black text-orange-600 tracking-tight group-hover:scale-105 transition-transform origin-right">{{ number_format($stats['employees']) }}</h3>
                <div class="mt-4 flex items-center gap-2 text-orange-700 font-bold text-xs bg-orange-50 px-3 py-1.5 rounded-xl w-fit">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span>موظف نشط</span>
                </div>
            </div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-orange-500/5 rounded-full blur-2xl group-hover:bg-orange-500/10 transition-colors"></div>
        </div>
    </div>
        <br>
    <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6 animate-fade-up" style="animation-delay: 0.5s">
            <div class="glass-effect bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-2xl shadow-slate-200/50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-black text-slate-800 flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-lg">⚡</span>
                        نشاط الجمعية مؤخراً
                    </h3>
                </div>
                <div class="space-y-6">
                    @forelse($recent_beneficiaries as $beneficiary)
                    <div class="flex gap-6 items-start group">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform shadow-sm text-2xl">👤</div>
                        <div class="flex-1 border-b border-slate-100 pb-6 group-hover:border-slate-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <h4 class="font-black text-lg text-slate-800 group-hover:text-emerald-700 transition-colors">تسجيل مستفيد جديد: {{ $beneficiary->name }}</h4>
                                <span class="text-xs font-bold text-slate-400">{{ $beneficiary->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-500 text-sm mt-1 font-medium italic">تم إصدار الرقم التسلسلي: {{ $beneficiary->serial_code }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-center py-10 font-bold">لا يوجد نشاط مسجل مؤخراً</p>
                    @endforelse

                    @foreach($recent_donations as $donation)
                    <div class="flex gap-6 items-start group">
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform shadow-sm text-2xl">💰</div>
                        <div class="flex-1 border-b border-slate-100 pb-6 group-hover:border-slate-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <h4 class="font-black text-lg text-slate-800 group-hover:text-blue-700 transition-colors">صرف مساعدة مالية</h4>
                                <span class="text-xs font-bold text-slate-400">{{ $donation->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-500 text-sm mt-1 font-medium italic">تم صرف مبلغ {{ number_format($donation->amount) }} ج.م لصالح {{ $donation->beneficiary->name ?? 'مستفيد' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6 animate-fade-up" style="animation-delay: 0.6s">
            <div class="glass-effect bg-gradient-to-br from-white to-emerald-50/50 rounded-[2.5rem] p-10 border border-emerald-100 shadow-2xl shadow-emerald-100/50">
                <h3 class="text-2xl font-black text-slate-800 mb-6">إحصائيات الإنجاز 📊</h3>
                <div class="space-y-8">
                    <div>
                        <div class="flex justify-between mb-3">
                            <span class="font-bold text-slate-600 text-sm">تغطية الحالات المسجلة</span>
                            <span class="font-black text-emerald-600">{{ $stats['achievement_rate'] }}%</span>
                        </div>
                        <div class="h-4 bg-slate-100 rounded-full overflow-hidden p-[2px]">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-400 rounded-full relative" style="width: {{ $stats['achievement_rate'] }}%">
                                <div class="absolute right-0 top-0 bottom-0 w-full bg-white/20 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-3">
                            <span class="font-bold text-slate-600 text-sm">استجابة الحالات الحرجة (عالي)</span>
                            <span class="font-black text-rose-600">{{ $stats['high_need_rate'] }}%</span>
                        </div>
                        <div class="h-4 bg-slate-100 rounded-full overflow-hidden p-[2px]">
                            <div class="h-full bg-gradient-to-r from-rose-500 to-rose-400 rounded-full relative" style="width: {{ $stats['high_need_rate'] }}%">
                                <div class="absolute right-0 top-0 bottom-0 w-full bg-white/20 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-3">
                            <span class="font-bold text-slate-600 text-sm">استغلال الموارد المالية</span>
                            <span class="font-black text-blue-600">{{ $stats['fund_usage'] }}%</span>
                        </div>
                        <div class="h-4 bg-slate-100 rounded-full overflow-hidden p-[2px]">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-400 rounded-full relative" style="width: {{ $stats['fund_usage'] }}%">
                                <div class="absolute right-0 top-0 bottom-0 w-full bg-white/20 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-effect bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl">
                <h4 class="font-black text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-sm">🚀</span>
                    إجراءات سريعة
                </h4>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('beneficiaries.create') }}" class="p-4 rounded-2xl bg-emerald-50 hover:bg-emerald-100 transition-colors text-center border border-emerald-100 group">
                        <span class="block text-2xl mb-1 group-hover:scale-110 transition-transform">➕</span>
                        <span class="text-xs font-black text-emerald-700">إضافة حالة</span>
                    </a>
                    <a href="{{ route('supporters.index') }}" class="p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-colors text-center border border-blue-100 group">
                        <span class="block text-2xl mb-1 group-hover:scale-110 transition-transform">🤝</span>
                        <span class="text-xs font-black text-blue-700">الداعمين</span>
                    </a>
                    <a href="{{ route('employees.index') }}" class="p-4 rounded-2xl bg-purple-50 hover:bg-purple-100 transition-colors text-center border border-purple-100 group">
                        <span class="block text-2xl mb-1 group-hover:scale-110 transition-transform">👔</span>
                        <span class="text-xs font-black text-purple-700">الموظفين</span>
                    </a>
                    <button onclick="window.print()" class="p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors text-center border border-slate-100 group">
                        <span class="block text-2xl mb-1 group-hover:scale-110 transition-transform">📊</span>
                        <span class="text-xs font-black text-slate-700">طباعة</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- Print Only Report --}}
    <div class="hidden print:block">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black mb-2">تقرير ملخص الأداء - جمعية أبناء طبهار</h1>
            <p class="text-slate-500 font-bold text-lg">تاريخ التقرير: {{ now()->format('Y-m-d') }}</p>
        </div>

        <table class="w-full mb-12 border-collapse border-2 border-slate-300">
            <thead>
                <tr class="bg-slate-100">
                    <th class="p-4 border border-slate-300 text-right text-lg">نوع التقرير / الإحصائية</th>
                    <th class="p-4 border border-slate-300 text-right text-lg">القيمة المستخرجة</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-slate-50"><td colspan="2" class="p-2 border border-slate-300 font-black text-center text-slate-500 uppercase">📊 الخلاصة الرقمية</td></tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">إجمالي الحالات المستفيدة المسجلة</td>
                    <td class="p-4 border border-slate-300 font-black text-slate-800 text-xl">{{ number_format($stats['beneficiaries']) }} حالة</td>
                </tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">إجمالي فريق العمل والمتطوعين</td>
                    <td class="p-4 border border-slate-300 font-black text-slate-800 text-xl">{{ number_format($stats['employees']) }} موظف</td>
                </tr>
                
                <tr class="bg-slate-50"><td colspan="2" class="p-2 border border-slate-300 font-black text-center text-slate-500 uppercase">💰 الموقف المالي الحالي</td></tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">إجمالي الإيرادات والتبرعات (داخل)</td>
                    <td class="p-4 border border-slate-300 font-black text-emerald-600 text-xl">{{ number_format($stats['income']) }} ج.م</td>
                </tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">إجمالي مساعدات ومصروفات (خارج)</td>
                    <td class="p-4 border border-slate-300 font-black text-rose-600 text-xl">{{ number_format($stats['donations']) }} ج.م</td>
                </tr>
                <tr class="bg-blue-50/50">
                    <td class="p-4 border border-slate-300 font-black text-blue-800">صافي رصيد الجمعية (الرصيد الحالي)</td>
                    <td class="p-4 border border-slate-300 font-black text-blue-700 text-2xl font-mono">{{ number_format($stats['balance']) }} ج.م</td>
                </tr>

                <tr class="bg-slate-50"><td colspan="2" class="p-2 border border-slate-300 font-black text-center text-slate-500 uppercase">🎯 مؤشرات الأداء والإنجاز</td></tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">نسبة تغطية المساعدات للحالات المسجلة</td>
                    <td class="p-4 border border-slate-300 font-black text-emerald-600 text-xl">{{ $stats['achievement_rate'] }}%</td>
                </tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">نسبة الاستجابة الفورية للحالات الحرجة</td>
                    <td class="p-4 border border-slate-300 font-black text-rose-600 text-xl">{{ $stats['high_need_rate'] }}%</td>
                </tr>
                <tr>
                    <td class="p-4 border border-slate-300 font-bold">كفاءة استغلال الموارد المالية</td>
                    <td class="p-4 border border-slate-300 font-black text-blue-600 text-xl">{{ $stats['fund_usage'] }}%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
