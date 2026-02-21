@extends('layouts.app')

@section('title', 'تفاصيل المستفيد')

@section('content')
<div class="space-y-8 animate-fade-in pb-20">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-3xl bg-emerald-600 text-white flex items-center justify-center text-4xl shadow-2xl">
                {{ substr($beneficiary->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-4xl font-black text-slate-800 mb-1">{{ $beneficiary->name }}</h2>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-black">#{{ $beneficiary->serial_code }}</span>
                    <span class="px-3 py-1 
                        @if($beneficiary->need_level == 'عالي') bg-red-100 text-red-700
                        @elseif($beneficiary->need_level == 'متوسط') bg-yellow-100 text-yellow-700
                        @else bg-green-100 text-green-700
                        @endif 
                        rounded-lg text-xs font-black">احتياج {{ $beneficiary->need_level }}</span>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="px-6 py-3 bg-white border-2 border-slate-200 rounded-2xl font-black text-slate-700 hover:bg-slate-50 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                تحديث البيانات
            </a>
            <button onclick="window.print()" class="px-6 py-3 bg-slate-800 text-white rounded-2xl font-black hover:bg-slate-900 transition-all flex items-center gap-2 shadow-xl shadow-slate-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                بدء الطباعة
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-full h-2 bg-emerald-500"></div>
                <h3 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">📋</span>
                    المعلومات الشخصية
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">الرقم القومي</p>
                        <p class="text-lg font-black text-slate-700 font-mono">{{ $beneficiary->national_id }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">رقم الهاتف</p>
                        <p class="text-lg font-black text-slate-700">{{ $beneficiary->phone }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">الحالة الاجتماعية</p>
                        <p class="text-lg font-black text-slate-700">{{ $beneficiary->social_status }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">الدخل الشهري</p>
                        <p class="text-lg font-black text-emerald-600">{{ number_format($beneficiary->monthly_income) }} ج.م</p>
                    </div>
                    <div class="col-span-full space-y-1">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">العنوان بالتفصيل</p>
                        <p class="text-lg font-black text-slate-700 leading-relaxed">{{ $beneficiary->address ?? 'غير مسجل' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-full h-2 bg-blue-500"></div>
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">👶</span>
                        سجل الأطفال والمعالين
                    </h3>
                    <span class="px-4 py-1.5 bg-blue-50 text-blue-700 rounded-full text-xs font-black">
                        إجمالي: {{ count($beneficiary->children ?? []) }}
                    </span>
                </div>
                
                @if($beneficiary->children && count($beneficiary->children) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($beneficiary->children as $child)
                        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between group hover:border-blue-200 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-xl">
                                    {{ (isset($child['gender']) && $child['gender'] == 'ذكر') ? '👦' : '👧' }}
                                </div>
                                <div>
                                    <p class="font-black text-slate-700">{{ $child['name'] }}</p>
                                    <p class="text-xs text-slate-400 font-bold">العمر: {{ $child['age'] }} عام</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-10 text-center border-2 border-dashed border-slate-100 rounded-[2rem]">
                        <p class="text-slate-400 font-bold">لا يوجد أطفال مسجلين لهذه الحالة</p>
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-full h-2 bg-amber-500"></div>
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">💰</span>
                        سجل المساعدات المنصرفة
                    </h3>
                    <button onclick="exportToExcel('donationsPrintTable', 'سجل_مساعدات_{{ $beneficiary->name }}')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold">تصدير Excel</button>
                </div>

                <div class="overflow-x-auto">
                    <table id="donationsPrintTable" class="w-full">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-right text-xs font-black text-slate-500">التاريخ</th>
                                <th class="px-4 py-3 text-right text-xs font-black text-slate-500">المبلغ</th>
                                <th class="px-4 py-3 text-right text-xs font-black text-slate-500">النوع</th>
                                <th class="px-4 py-3 text-right text-xs font-black text-slate-500">ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @php $donations = \App\Models\Donation::where('beneficiary_id', $beneficiary->id)->latest()->get(); @endphp
                            @forelse($donations as $donation)
                            <tr>
                                <td class="px-4 py-3 text-sm font-bold text-slate-700">{{ $donation->date }}</td>
                                <td class="px-4 py-3 text-sm font-black text-emerald-600">{{ number_format($donation->amount) }} ج.م</td>
                                <td class="px-4 py-3 text-sm font-bold text-slate-500">{{ $donation->category }}</td>
                                <td class="px-4 py-3 text-sm text-slate-400">{{ $donation->notes ?? '---' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-400 font-bold">لا توجد عمليات صرف مسجلة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/20 rounded-full blur-3xl"></div>
                <h3 class="text-lg font-black mb-6 flex items-center gap-2">ملخص الحالة ✨</h3>
                <div class="space-y-6">
                    <div class="p-5 bg-white/5 rounded-2xl border border-white/10">
                        <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-1">نوع الحالة</p>
                        <p class="text-lg font-black">{{ $beneficiary->family_status[0] ?? 'غير محدد' }}</p>
                    </div>
                    <div class="p-5 bg-white/5 rounded-2xl border border-white/10 text-rose-300">
                        <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-1">الاحتياج الأساسي</p>
                        <p class="text-lg font-black">{{ $beneficiary->needs[0] ?? 'دعم مادي' }}</p>
                    </div>
                    <div class="p-5 bg-emerald-500 text-white rounded-2xl shadow-xl shadow-emerald-500/20">
                        <p class="text-[10px] font-black text-white/70 uppercase tracking-widest mb-1">تاريخ التسجيل</p>
                        <p class="text-lg font-black">{{ $beneficiary->created_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-full h-1 bg-gradient-to-l from-emerald-500 to-blue-500"></div>
                <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                    <span class="text-xl">⚡</span> إجراءات سريعة
                </h3>
                <div class="grid gap-3">
                    <button onclick="openModal('disburseModal')" class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-500 text-white hover:bg-emerald-600 transition-all group text-right w-full shadow-lg shadow-emerald-500/20">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">💰</div>
                        <div>
                            <span class="block font-black text-sm">صرف مساعدة</span>
                            <span class="text-[10px] text-white/70 font-bold">تسجيل دعم مالي جديد</span>
                        </div>
                    </button>
                    <button onclick="printIDCard()" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 transition-all group text-right w-full">
                        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-600 shadow-sm group-hover:scale-110 transition-transform">🖨️</div>
                        <div>
                            <span class="block font-black text-slate-700 text-sm">طباعة البطاقة</span>
                            <span class="text-[10px] text-slate-400 font-bold">استخراج بطاقة تعريفية</span>
                        </div>
                    </button>
                    {{-- More buttons if needed --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Beneficiary ID Card (Print Only Content) --}}
<div id="idCard" class="hidden">
    <div style="width: 400px; height: 250px; border: 4px solid #065F46; border-radius: 20px; padding: 20px; font-family: sans-serif; direction: rtl; position: relative; background: #FFF;">
        <div style="text-align: center; border-bottom: 2px solid #065F46; padding-bottom: 10px; margin-bottom: 15px;">
            <h2 style="margin: 0; color: #065F46; font-size: 18px;">جمعية أبناء طبهار لتنمية المجتمع</h2>
            <p style="margin: 0; font-size: 12px; font-weight: bold; color: #333;">بطاقة تعريف مستفيد</p>
        </div>
        <div style="display: flex; gap: 20px; align-items: start;">
            <div style="flex: 1;">
                <p style="margin: 0 0 5px 0; font-size: 11px; color: #666; font-weight: bold;">الاسم الكامل:</p>
                <p style="margin: 0 0 15px 0; font-size: 18px; font-weight: 900; color: #000;">{{ $beneficiary->name }}</p>
                
                <p style="margin: 0 0 5px 0; font-size: 11px; color: #666; font-weight: bold;">الرقم القومي:</p>
                <p style="margin: 0; font-family: monospace; font-size: 16px; font-weight: bold; letter-spacing: 1px;">{{ $beneficiary->national_id }}</p>
            </div>
            <div style="width: 80px; text-align: center;">
                <div style="width: 80px; height: 80px; border: 2px solid #EEE; background: #F9F9F9; border-radius: 12px; display: flex; align-items: center; justify-center; font-size: 40px; margin-bottom: 10px;">👤</div>
                <div style="background: #065F46; color: #FFF; border-radius: 8px; padding: 4px; font-weight: 900; font-size: 12px;">#{{ $beneficiary->serial_code }}</div>
            </div>
        </div>
        <div style="position: absolute; bottom: 15px; left: 20px; right: 20px; display: flex; justify-content: space-between; border-top: 1px solid #EEE; padding-top: 10px;">
            <span style="font-size: 10px; font-weight: bold; color: #666;">كود الحالة: {{ $beneficiary->serial_code }}</span>
            <span style="font-size: 10px; font-weight: bold; color: #666;">تاريخ التسجيل: {{ $beneficiary->created_at->format('Y/m/d') }}</span>
        </div>
    </div>
</div>

{{-- Disburse Aid Modal --}}
<div id="modalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div id="disburseModal" class="bg-white rounded-[2.5rem] p-10 max-w-xl w-full shadow-2xl relative animate-scale-in hidden">
        <h3 class="text-3xl font-black text-gray-800 mb-6">صرف مساعدة مالية 💰</h3>
        <form action="{{ route('donations.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="beneficiary_id" value="{{ $beneficiary->id }}">
            <div>
                <label class="font-bold text-gray-700 mb-2 block">المبلغ (ج.م)</label>
                <input type="number" name="amount" required class="input-field" placeholder="0.00">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-bold text-gray-700 mb-2 block">نوع المساعدة</label>
                    <select name="category" class="input-field">
                        <option value="شهرية">شهرية</option>
                        <option value="علاج">علاج</option>
                        <option value="موسمية">موسمية</option>
                        <option value="كفالة">كفالة</option>
                    </select>
                </div>
                <div>
                    <label class="font-bold text-gray-700 mb-2 block">التاريخ</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="input-field">
                </div>
            </div>
            <div>
                <label class="font-bold text-gray-700 mb-2 block">ملاحظات إضافية</label>
                <textarea name="notes" rows="2" class="input-field" placeholder="أي تفاصيل أخرى..."></textarea>
            </div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold border-2 border-gray-200 rounded-2xl">إلغاء</button>
                <button type="submit" class="flex-1 btn-primary">تأكيد الصرف</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openModal(id) {
    document.getElementById('modalOverlay').classList.remove('hidden');
    document.getElementById('modalOverlay').classList.add('flex');
    document.getElementById(id).classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modalOverlay').classList.add('hidden');
    document.getElementById('disburseModal').classList.add('hidden');
}

function printIDCard() {
    const cardContent = document.getElementById('idCard').innerHTML;
    const printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>بطاقة المستفيد</title>');
    printWindow.document.write('<style>body { margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; background: #F5F5F5; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(cardContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}
</script>
@endpush
@endsection
