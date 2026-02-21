@extends('layouts.app')

@section('title', 'شؤون الموظفين')

@section('content')
<div class="space-y-8 pb-20">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 print:hidden">
        <div>
            <h2 class="text-3xl font-bold tracking-tight">شؤون الموظفين</h2>
            <p class="text-gray-600">متابعة أداء فريق العمل وإحصائيات الحالات المسجلة</p>
        </div>
        <div class="flex gap-4">
            <button onclick="exportToExcel('employeesPrintTable', 'سجل_الموظفين')" class="h-12 px-6 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all inline-flex items-center gap-2 shadow-lg shadow-blue-900/10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                تصدير Excel
            </button>
            <button onclick="window.print()" class="h-12 px-6 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition-all inline-flex items-center gap-2 border border-slate-200">
                <svg class="h-5 w-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                طباعة
            </button>
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('employees.create') }}" class="h-12 px-6 rounded-xl bg-[#065F46] text-white font-bold hover:bg-[#059669] transition-all inline-flex items-center gap-2 shadow-lg shadow-emerald-900/10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة موظف
            </a>
            @endif
        </div>
    </div>

    <div class="flex justify-end gap-3 mb-6 print:hidden">
        <form action="{{ route('employees.index') }}" method="GET" class="relative group">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث باسم الموظف أو الوظيفة..." 
                class="w-64 px-10 py-3 bg-white border-2 border-slate-100 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all font-bold text-sm">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <div class="bg-white/70 backdrop-blur-xl rounded-[2.5rem] border border-slate-100 shadow-2xl overflow-hidden print:hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <svg class="h-6 w-6 text-[#065F46]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                سجل العاملين الفعلي
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="pr-8 py-4 text-right text-xs font-black text-slate-500 uppercase">الموظف</th>
                        <th class="px-4 py-4 text-right text-xs font-black text-slate-500 uppercase">الوظيفة</th>
                        <th class="px-4 py-4 text-right text-xs font-black text-slate-500 uppercase">الراتب الشهري</th>
                        <th class="px-4 py-4 text-right text-xs font-black text-slate-500 uppercase">الغيابات</th>
                        <th class="px-4 py-4 text-right text-xs font-black text-slate-500 uppercase">التأخرات</th>
                        <th class="px-4 py-4 text-right text-xs font-black text-slate-500 uppercase">الإجازات</th>
                        <th class="pl-8 py-4 text-left text-xs font-black text-slate-500 uppercase">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($employees as $employee)
                    <tr class="h-20 hover:bg-emerald-50/20 transition-colors group">
                        <td class="pr-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold">
                                    {{ substr($employee->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">{{ $employee->name }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $employee->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 font-bold text-slate-600">{{ $employee->job_type }}</td>
                        <td class="px-4 font-mono font-bold text-slate-500">{{ number_format($employee->monthly_salary) }} ج.م</td>
                        <td class="px-4 font-bold text-red-600">{{ is_array($employee->absences) ? count($employee->absences) : 0 }} يوم</td>
                        <td class="px-4 font-bold text-yellow-600">{{ is_array($employee->late_records) ? count($employee->late_records) : 0 }} مرة</td>
                        <td class="px-4 font-bold text-blue-600">{{ is_array($employee->vacations) ? count($employee->vacations) : 0 }} يوم</td>
                        <td class="pl-8 text-left">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('employees.edit', $employee) }}" class="h-9 w-9 flex items-center justify-center text-[#065F46] hover:bg-slate-100 rounded-lg">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @if(auth()->user()->role == 'admin')
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الموظف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-9 w-9 flex items-center justify-center text-rose-500 hover:bg-rose-50 rounded-lg">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>

                    </tr>
                    
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-20">
                            <p class="text-gray-500 font-bold">لا يوجد موظفين مسجلين</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 print:hidden">
        {{ $employees->links() }}
    </div>

    {{-- Print Only Table --}}
    <div class="hidden print:block">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black mb-2">سجل الموظفين - جمعية أبناء طبهار</h1>
            <p class="text-slate-500 font-bold">تاريخ التقرير: {{ now()->format('Y-m-d') }}</p>
        </div>
        <table id="employeesPrintTable">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الوظيفة</th>
                    <th>رقم الهاتف</th>
                    <th>الراتب الشهري</th>
                    <th>الغيابات</th>
                    <th>التأخرات</th>
                    <th>الإجازات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->job_type }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ number_format($employee->monthly_salary) }} ج.م</td>
                    <td>{{ is_array($employee->absences) ? count($employee->absences) : 0 }}</td>
                    <td>{{ is_array($employee->late_records) ? count($employee->late_records) : 0 }}</td>
                    <td>{{ is_array($employee->vacations) ? count($employee->vacations) : 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
