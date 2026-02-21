@extends('layouts.app')

@section('title', 'تعديل بيانات المستفيد')

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
            تعديل بيانات: {{ $beneficiary->name }} ✨
        </h2>
        <p class="text-gray-600 text-lg">قم بتحديث البيانات المطلوبة بالأسفل</p>
    </div>

    <form action="{{ route('beneficiaries.update', $beneficiary) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="glass-effect rounded-3xl p-10 border border-emerald-100 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-emerald-500 to-emerald-600"></div>
            
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg">
                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-800">البيانات الأساسية</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="font-bold text-gray-700 flex items-center gap-2">الاسم الرباعي</label>
                    <input type="text" name="name" value="{{ old('name', $beneficiary->name) }}" required class="input-field">
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700 flex items-center gap-2">الرقم القومي</label>
                    <input type="text" name="national_id" value="{{ old('national_id', $beneficiary->national_id) }}" maxlength="14" required class="input-field font-mono">
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700 flex items-center gap-2">رقم الهاتف</label>
                    <input type="text" name="phone" value="{{ old('phone', $beneficiary->phone) }}" required class="input-field">
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700 flex items-center gap-2">النوع</label>
                    <select name="gender" required class="input-field">
                        <option value="ذكر" {{ $beneficiary->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                        <option value="أنثى" {{ $beneficiary->gender == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700 flex items-center gap-2">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $beneficiary->birth_date) }}" class="input-field">
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-emerald-700 flex items-center gap-2">الدخل الشهري</label>
                    <input type="number" name="monthly_income" value="{{ old('monthly_income', $beneficiary->monthly_income) }}" class="input-field bg-emerald-50/50">
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700">الحالة الاجتماعية</label>
                    <select name="social_status" class="input-field">
                        <option value="متزوج" {{ $beneficiary->social_status == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                        <option value="أعزب" {{ $beneficiary->social_status == 'أعزب' ? 'selected' : '' }}>أعزب</option>
                        <option value="أرمل" {{ $beneficiary->social_status == 'أرمل' ? 'selected' : '' }}>أرمل</option>
                        <option value="مطلق" {{ $beneficiary->social_status == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-gray-700">اسم الزوج/ة</label>
                    <input type="text" name="spouse_name" value="{{ old('spouse_name', $beneficiary->spouse_name) }}" class="input-field" placeholder="في حالة الوفاة يترك فارغاً">
                </div>

                <div class="space-y-2 col-span-full">
                    <label class="font-bold text-gray-700">العنوان</label>
                    <textarea name="address" rows="2" class="input-field">{{ old('address', $beneficiary->address) }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="glass-effect rounded-[2.5rem] p-10 border border-emerald-100 shadow-2xl relative overflow-hidden">
                <h3 class="text-xl font-black text-emerald-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-sm">📁</span>
                    تصنيف الحالة الرقمي
                </h3>
                <div class="grid grid-cols-1 gap-4">
                    @php $statuses = ['أيتام', 'أرامل', 'مرضى', 'غارمين', 'ذوي احتياجات', 'أسر سفينة']; @endphp
                    @foreach($statuses as $status)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-200">
                        <input type="checkbox" name="family_status[]" value="{{ $status }}" class="w-5 h-5 text-emerald-600 rounded-lg"
                        {{ in_array($status, $beneficiary->family_status ?? []) ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm">{{ $status }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="glass-effect rounded-[2.5rem] p-10 border border-blue-100 shadow-2xl relative overflow-hidden">
                <h3 class="text-xl font-black text-blue-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-sm">🎁</span>
                    نوع المساعدة المطلوبة
                </h3>
                <div class="grid grid-cols-1 gap-4">
                    @php $needs = ['غذاء', 'علاج', 'كفالة', 'تجهيز عرائس', 'سكن', 'أجهزة طبية']; @endphp
                    @foreach($needs as $need)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-blue-50 transition-all border border-transparent hover:border-blue-200">
                        <input type="checkbox" name="needs[]" value="{{ $need }}" class="w-5 h-5 text-blue-600 rounded-lg"
                        {{ in_array($need, $beneficiary->needs ?? []) ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm">{{ $need }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="glass-effect rounded-[2.5rem] p-10 border border-purple-100 shadow-2xl relative overflow-hidden">
                <h3 class="text-xl font-black text-purple-800 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-sm">🤝</span>
                    جهات داعمه اخرى
                </h3>
                <div class="grid grid-cols-1 gap-4">
                    @php $entities = ['جمعية شرعية', 'رسالة', 'مصر الخير', 'الأورمان', 'تكافل وكرامة', 'أخرى']; @endphp
                    @foreach($entities as $entity)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-purple-50 transition-all border border-transparent hover:border-purple-200">
                        <input type="checkbox" name="supporting_entity[]" value="{{ $entity }}" class="w-5 h-5 text-purple-600 rounded-lg"
                        {{ in_array($entity, $beneficiary->supporting_entity ?? []) ? 'checked' : '' }}>
                        <span class="font-bold text-slate-700 text-sm">{{ $entity }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="glass-effect rounded-3xl p-10 border border-blue-100 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-blue-500 to-blue-600"></div>
            
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-800">تفاصيل الأسرة والأطفال</h3>
            </div>

            <div class="space-y-6">
                <label class="flex items-center gap-4 p-5 bg-gradient-to-r from-blue-50 to-transparent rounded-2xl border-2 border-blue-100 cursor-pointer">
                    <input type="checkbox" name="has_children" value="1" id="hasChildrenCheckbox" 
                        class="w-6 h-6 text-blue-600 rounded-lg border-2 border-blue-300"
                        {{ $beneficiary->has_children ? 'checked' : '' }}
                        onchange="toggleChildrenSection()">
                    <div>
                        <span class="font-bold text-gray-800 text-lg">تحديث بيانات المعالين؟</span>
                        <p class="text-sm text-gray-500">سيتم عرض قائمة الأطفال الحالية أدناه</p>
                    </div>
                </label>

                <div id="childrenSection" class="{{ $beneficiary->has_children ? '' : 'hidden' }} space-y-4">
                    <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-lg text-purple-900">بيانات الأطفال</h4>
                            <button type="button" onclick="addChild()" class="px-4 py-2 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition-all flex items-center gap-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                إضافة جديد
                            </button>
                        </div>
                        
                        <div id="childrenContainer" class="space-y-4">
                            @if($beneficiary->children)
                                @foreach($beneficiary->children as $index => $child)
                                <div class="p-5 bg-white rounded-2xl border-2 border-purple-100 shadow-sm relative animate-scale-in">
                                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-3 left-3 w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                                        <div>
                                            <label class="font-bold text-sm text-gray-700 mb-2 block">اسم الطفل</label>
                                            <input type="text" name="children[{{ $index }}][name]" value="{{ $child['name'] }}" class="input-field" required>
                                        </div>
                                        <div>
                                            <label class="font-bold text-sm text-gray-700 mb-2 block">العمر</label>
                                            <input type="number" name="children[{{ $index }}][age]" value="{{ $child['age'] }}" class="input-field" required>
                                        </div>
                                        <div>
                                            <label class="font-bold text-sm text-gray-700 mb-2 block">النوع</label>
                                            <select name="children[{{ $index }}][gender]" class="input-field">
                                                <option value="ذكر" {{ $child['gender'] == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                                <option value="أنثى" {{ $child['gender'] == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('beneficiaries.index') }}" class="px-10 py-4 rounded-2xl font-bold border-2 border-gray-300 hover:bg-gray-50 transition-all">إلغاء</a>
            <button type="submit" class="btn-primary min-w-[240px] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                تحديث البيانات
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let childCount = {{ $beneficiary->children ? count($beneficiary->children) : 0 }};

function toggleChildrenSection() {
    const checkbox = document.getElementById('hasChildrenCheckbox');
    const section = document.getElementById('childrenSection');
    if (checkbox.checked) {
        section.classList.remove('hidden');
    } else {
        section.classList.add('hidden');
    }
}

function addChild() {
    childCount++;
    const container = document.getElementById('childrenContainer');
    const childDiv = document.createElement('div');
    childDiv.className = 'p-5 bg-white rounded-2xl border-2 border-purple-100 shadow-sm relative animate-scale-in';
    childDiv.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-3 left-3 w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
            <div><label class="font-bold text-sm text-gray-700 mb-2 block">اسم الطفل</label><input type="text" name="children[${childCount}][name]" class="input-field" required></div>
            <div><label class="font-bold text-sm text-gray-700 mb-2 block">العمر</label><input type="number" name="children[${childCount}][age]" class="input-field" required></div>
            <div><label class="font-bold text-sm text-gray-700 mb-2 block">النوع</label><select name="children[${childCount}][gender]" class="input-field"><option value="ذكر">ذكر</option><option value="أنثى">أنثى</option></select></div>
        </div>
    `;
    container.appendChild(childDiv);
}
</script>
@endpush
@endsection
