@extends('layouts.app')

@section('title', 'إضافة مستفيد جديد')

@section('content')
<div class="space-y-8 pb-20 animate-fade-in">
    <div>
        <a href="{{ route('beneficiaries.index') }}" class="text-emerald-600 hover:text-emerald-700 font-bold inline-flex items-center mb-4 transition-colors">
            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            العودة للقائمة
        </a>
        
        <h2 class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent mb-2">
            تسجيل حالة مستفيدة جديدة ✨
        </h2>
        <p class="text-gray-600 text-lg font-bold">نظام الأرشفة الرقمي لجمعية أبناء طبهار</p>
    </div>

    @if ($errors->any())
    <div class="bg-rose-50 border-2 border-rose-200 p-6 rounded-[2rem] animate-shake">
        <h3 class="text-rose-800 font-black mb-2 flex items-center gap-2">
            ⚠️ يوجد أخطاء في البيانات:
        </h3>
        <ul class="list-disc list-inside text-rose-600 font-bold text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('beneficiaries.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <div class="glass-effect rounded-[2.5rem] p-10 border border-emerald-100 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-emerald-500 to-emerald-600"></div>
            
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow-lg">👤</div>
                <h3 class="text-2xl font-black text-gray-800">بيانات الهوية والاتصال</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">الاسم الرباعي الكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="اكتب الاسم كما في البطاقة">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">كود المتسلسل</label>
                    <input type="text" name="serial_code" value="{{ old('serial_code') }}" class="input-field" placeholder="الكود الورقي">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">الرقم القومي</label>
                    <input type="text" name="national_id" value="{{ old('national_id') }}" maxlength="14" required class="input-field font-mono" placeholder="١٤ رقم قومي">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">رقم الهاتف</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="input-field" placeholder="01XXXXXXXXX">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">النوع</label>
                    <select name="gender" required class="input-field">
                        <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                        <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="input-field">
                </div>
                <div class="space-y-2 col-span-full">
                    <label class="font-black text-gray-700 block px-2">العنوان بالتفصيل</label>
                    <textarea name="address" rows="2" class="input-field" placeholder="العنوان...">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="glass-effect rounded-[2.5rem] p-8 border border-emerald-100 shadow-xl relative overflow-hidden">
                <h3 class="text-lg font-black text-emerald-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-sm">📁</span>
                    حالة الأسرة
                </h3>
                <div class="space-y-3">
                    @php $statuses = ['أيتام', 'أرامل', 'مطلقات', 'غارمين', 'مرضى', 'معدمة', 'فقيرة', 'ذوي احتياجات', 'أسر سفينة']; @endphp
                    @foreach($statuses as $status)
                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-200">
                        <input type="checkbox" name="family_status[]" value="{{ $status }}" {{ is_array(old('family_status')) && in_array($status, old('family_status')) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded">
                        <span class="font-bold text-slate-700 text-xs">{{ $status }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="glass-effect rounded-[2.5rem] p-8 border border-blue-100 shadow-xl relative overflow-hidden">
                <h3 class="text-lg font-black text-blue-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-sm">🎁</span>
                    احتياج الحالة
                </h3>
                <div class="space-y-3">
                    @php $needs = ['علاج', 'احتياجات الحالة', 'ملابس', 'أغذية', 'كفالة أيتام', 'غارمين', 'تجهيز عرائس', 'عام']; @endphp
                    @foreach($needs as $need)
                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-blue-50 transition-all border border-transparent hover:border-blue-200">
                        <input type="checkbox" name="needs[]" value="{{ $need }}" {{ is_array(old('needs')) && in_array($need, old('needs')) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
                        <span class="font-bold text-slate-700 text-xs">{{ $need }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="glass-effect rounded-[2.5rem] p-8 border border-purple-100 shadow-xl relative overflow-hidden">
                <h3 class="text-lg font-black text-purple-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-sm">🤝</span>
                    الجهة الداعمة
                </h3>
                <div class="space-y-3">
                    @php $entities = ['بنك الطعام', 'بنك الكساء', 'كفالة أيتام', 'أفراد', 'تكافل وكرامة', 'رسالة', 'الأورمان', 'عام']; @endphp
                    @foreach($entities as $entity)
                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-purple-50 transition-all border border-transparent hover:border-purple-200">
                        <input type="checkbox" name="supporting_entity[]" value="{{ $entity }}" {{ is_array(old('supporting_entity')) && in_array($entity, old('supporting_entity')) ? 'checked' : '' }} class="w-4 h-4 text-purple-600 rounded">
                        <span class="font-bold text-slate-700 text-xs">{{ $entity }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="glass-effect rounded-[2.5rem] p-8 border border-rose-100 shadow-xl relative overflow-hidden">
                <h3 class="text-lg font-black text-rose-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center text-sm">📎</span>
                    المرفقات المسلمة
                </h3>
                <div class="space-y-3">
                    @php $attachments = ['صورة الهوية', 'شهادات ميلاد', 'قسيمة زواج', 'قسيمة طلاق', 'شهادة وفاة', 'جواز سفر', 'أخرى']; @endphp
                    @foreach($attachments as $attach)
                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-rose-50 transition-all border border-transparent hover:border-rose-200">
                        <input type="checkbox" name="attachments[]" value="{{ $attach }}" {{ is_array(old('attachments')) && in_array($attach, old('attachments')) ? 'checked' : '' }} class="w-4 h-4 text-rose-600 rounded">
                        <span class="font-bold text-slate-700 text-xs">{{ $attach }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="glass-effect rounded-[2.5rem] p-10 border border-slate-100 shadow-2xl">
            <h3 class="text-2xl font-black text-gray-800 mb-8 border-b pb-4">تفاصيل الأسرة والأطفال 👨‍👩‍👧‍👦</h3>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                    <div class="space-y-2">
                        <label class="font-black text-xs text-slate-500 uppercase px-2">الحالة الاجتماعية</label>
                        <select name="social_status" class="input-field">
                            <option value="متزوج">متزوج / متزوجة</option>
                            <option value="أرمل">أرمل / أرملة</option>
                            <option value="مطلق">مطلق / مطلقة</option>
                            <option value="أعزب">أعزب / عزباء</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-xs text-slate-500 uppercase px-2">اسم الزوج/ة</label>
                        <input type="text" name="spouse_name" value="{{ old('spouse_name') }}" class="input-field" placeholder="في حالة الوفاة يترك فارغاً">
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-xs text-emerald-600 uppercase px-2">الدخل الشهري (ج.م)</label>
                        <input type="number" name="monthly_income" value="{{ old('monthly_income', 0) }}" class="input-field border-emerald-100 bg-emerald-50/20 font-black">
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-xs text-rose-600 uppercase px-2">درجة الاحتياج</label>
                        <select name="need_level" class="input-field border-rose-100 bg-rose-50/20 font-black">
                            <option value="عالي">احتياج عالي 🔴</option>
                            <option value="متوسط">احتياج متوسط 🟡</option>
                            <option value="عادي">احتياج عادي 🟢</option>
                        </select>
                    </div>
                </div>

                <label class="flex items-center gap-4 p-6 bg-slate-900 text-white rounded-[2rem] cursor-pointer hover:bg-slate-800 transition-all shadow-xl">
                    <input type="checkbox" name="has_children" value="1" id="hasChildrenCheckbox" {{ old('has_children') ? 'checked' : '' }} class="w-6 h-6 text-emerald-500 rounded-lg" onchange="toggleChildrenSection()">
                    <div>
                        <span class="font-black text-lg">هل يوجد أطفال أو أفراد تعولهم الحالة؟</span>
                        <p class="text-xs text-slate-400 font-bold">سيفتح ذلك سجل الإضافة التفصيلي للأطفال (الاسم، السن، النوع)</p>
                    </div>
                </label>

                <div id="childrenSection" class="{{ old('has_children') ? '' : 'hidden' }} space-y-4 pt-4">
                    <div id="childrenContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    <button type="button" onclick="addChild()" class="w-full py-4 border-2 border-dashed border-emerald-200 rounded-2xl text-emerald-600 font-black hover:bg-emerald-50 transition-all">+ إضافة ابن / فرد معال</button>
                </div>
            </div>
        </div>

        <div class="flex justify-center md:justify-end gap-4">
            <a href="{{ route('beneficiaries.index') }}" class="px-10 py-4 font-black text-slate-400 hover:text-slate-600">إلغاء</a>
            <button type="submit" class="btn-primary min-w-[320px] py-5">حفظ البيانات وإصدار الملف الرقمي ✨</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let childCount = 0;
function toggleChildrenSection() {
    const isChecked = document.getElementById('hasChildrenCheckbox').checked;
    document.getElementById('childrenSection').classList.toggle('hidden', !isChecked);
}
function addChild() {
    childCount++;
    const container = document.getElementById('childrenContainer');
    const div = document.createElement('div');
    div.className = 'p-6 bg-white rounded-3xl border border-slate-100 shadow-sm relative animate-scale-in';
    div.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-4 left-4 text-rose-500 font-black">حذف</button>
        <div class="space-y-4 pt-4">
            <input type="text" name="children[${childCount}][name]" class="input-field" placeholder="اسم الطفل" required>
            <div class="flex gap-4">
                <input type="number" name="children[${childCount}][age]" class="input-field" placeholder="السن" required>
                <select name="children[${childCount}][gender]" class="input-field">
                    <option value="ذكر">ذكر</option><option value="أنثى">أنثى</option>
                </select>
            </div>
        </div>`;
    container.appendChild(div);
}
</script>
@endpush
@endsection
