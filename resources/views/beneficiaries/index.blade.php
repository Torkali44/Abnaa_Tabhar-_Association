@extends('layouts.app')

@section('title', 'قائمة المستفيدين')

@section('content')
<div class="space-y-8 animate-fade-in pb-20">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 print:hidden">
        <div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">سجل الحالات 📂</h2>
            <p class="text-slate-500 font-bold">عرض وإدارة كافة المستفيدين المسجلين في النظام</p>
        </div>
        <div class="flex gap-4">
            <button onclick="exportToExcel('beneficiariesPrintTable', 'سجل_المستفيدين')" class="h-12 px-6 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all inline-flex items-center gap-2 shadow-lg shadow-blue-900/10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                تصدير Excel
            </button>
            <button onclick="window.print()" class="h-12 px-6 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition-all inline-flex items-center gap-2 border border-slate-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                طباعة
            </button>
            <a href="{{ route('beneficiaries.create') }}" class="btn-primary flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                إضافة حالة
            </a>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6 print:hidden">
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('beneficiaries.index') }}" 
               class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all {{ !request('family_status') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-100' : 'bg-white border border-slate-200 text-slate-600 hover:border-emerald-500' }}">
                الكل
            </a>
            @foreach(['أيتام', 'أرامل', 'مرضى', 'غارمين', 'ذوي احتياجات', 'أسر سفينة'] as $status)
            <a href="{{ route('beneficiaries.index', ['family_status' => $status]) }}" 
               class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all {{ request('family_status') == $status ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-100' : 'bg-white border border-slate-200 text-slate-600 hover:border-emerald-500' }}">
                {{ $status }}
            </a>
            @endforeach
        </div>
        
        <form action="{{ route('beneficiaries.index') }}" method="GET" class="relative group">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث باسم الحالة أو الرقم القومي..." 
                class="w-64 px-10 py-3 bg-white border-2 border-slate-100 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all font-bold text-sm">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 print:hidden">
        @forelse($beneficiaries as $beneficiary)
        <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all relative overflow-hidden flex flex-col justify-between">
            <div class="absolute top-4 left-4 bg-slate-50 px-3 py-1 rounded-lg text-[10px] font-black text-slate-400 group-hover:text-emerald-600 transition-colors">
                #{{ $beneficiary->serial_code }}
            </div>

            <div class="flex flex-col flex-1">
                <div class="mt-4 mb-6">
                    <h3 class="text-xl font-black text-slate-800 truncate mb-1">{{ $beneficiary->name }}</h3>
                    <p class="text-xs text-slate-400 font-bold flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ $beneficiary->phone }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="p-3 bg-slate-50 rounded-2xl text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">الاحتياج</p>
                        <p class="text-xs font-black
                            @if($beneficiary->need_level == 'عالي') text-rose-600
                            @elseif($beneficiary->need_level == 'متوسط') text-orange-600
                            @else text-emerald-600
                            @endif">
                            {{ $beneficiary->need_level }}
                        </p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-2xl text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">المعالين</p>
                        <p class="text-xs font-black text-slate-700">{{ $beneficiary->children ? count($beneficiary->children) : 0 }} أطفال</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 mt-auto">
                <a href="{{ route('beneficiaries.show', $beneficiary) }}" class="py-2.5 bg-emerald-50 text-emerald-700 rounded-xl font-black text-xs flex items-center justify-center gap-1 hover:bg-emerald-600 hover:text-white transition-all col-span-2">
                    عرض الملف
                </a>
                <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="py-2.5 bg-slate-50 text-slate-600 rounded-xl font-bold text-xs flex items-center justify-center gap-1 hover:bg-slate-200 transition-all">
                    تعديل
                </a>
                @if(auth()->user()->role == 'admin')
                <form action="{{ route('beneficiaries.destroy', $beneficiary) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستفيد؟ لا يمكن التراجع عن هذا الإجراء.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2.5 bg-rose-50 text-rose-600 rounded-xl font-bold text-xs flex items-center justify-center gap-1 hover:bg-rose-600 hover:text-white transition-all">
                        حذف
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">📂</div>
            <p class="text-slate-400 font-bold text-xl">لا توجد حالات مسجلة حالياً</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12 print:hidden">
        {{ $beneficiaries->links() }}
    </div>

    {{-- Print Only Table --}}
    <div class="hidden print:block">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black mb-2">سجل المستفيدين - جمعية أبناء طبهار</h1>
            <p class="text-slate-500 font-bold">تاريخ التقرير: {{ now()->format('Y-m-d') }}</p>
        </div>
        <table id="beneficiariesPrintTable">
            <thead>
                <tr>
                    <th>الكود</th>
                    <th>الاسم</th>
                    <th>الرقم القومي</th>
                    <th>رقم الهاتف</th>
                    <th>درجة الاحتياج</th>
                    <th>الحالة الاجتماعية</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->serial_code }}</td>
                    <td>{{ $beneficiary->name }}</td>
                    <td>{{ $beneficiary->national_id }}</td>
                    <td>{{ $beneficiary->phone }}</td>
                    <td>{{ $beneficiary->need_level }}</td>
                    <td>{{ $beneficiary->social_status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
