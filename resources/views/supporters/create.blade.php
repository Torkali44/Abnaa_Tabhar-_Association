@extends('layouts.app')

@section('title', 'إضافة داعم جديد')

@section('content')
<div class="space-y-8 pb-20 animate-fade-in">
    <div>
        <a href="{{ route('supporters.index') }}" class="text-emerald-600 hover:text-emerald-700 font-bold inline-flex items-center mb-4 transition-colors">
            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            العودة للقائمة
        </a>
        <h2 class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent mb-2">
            تسجيل داعم جديد 🤝
        </h2>
        <p class="text-gray-600 text-lg">إضافة شريك نجاح جديد للجمعية (فرد أو مؤسسة)</p>
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

    <div class="bg-gray-100 p-1.5 rounded-2xl inline-flex shadow-inner mb-6 w-full md:w-auto">
        <button onclick="switchTab('individual')" id="tab_individual" class="flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-emerald-700">متبرع فردي 👤</button>
        <button onclick="switchTab('org')" id="tab_org" class="flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700">مؤسسة شريكة 🏢</button>
    </div>

    <!-- Individual Form -->
    <div id="form_individual" class="glass-effect rounded-[2.5rem] p-8 md:p-12 border border-emerald-100 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-emerald-500 to-emerald-600"></div>
        
        <form action="{{ route('supporters.individual.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">اسم المتبرع <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="الاسم الكامل">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">رقم الهاتف <span class="text-rose-500">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="input-field" placeholder="01xxxxxxxxx">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">العنوان</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="input-field" placeholder="العنوان بالتفصيل">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">رقم الهوية</label>
                    <input type="text" name="national_id" value="{{ old('national_id') }}" class="input-field" placeholder="الرقم القومي (اختياري)">
                </div>
            </div>

            <div class="p-6 bg-emerald-50/50 rounded-3xl border border-emerald-100 space-y-6">
                <h3 class="font-black text-emerald-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-sm">💰</span>
                    بيانات التبرع
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">نوع التبرع</label>
                        <select name="donation_type" class="input-field">
                            <option value="مادي" {{ old('donation_type') == 'مادي' ? 'selected' : '' }}>مادي (نقدي)</option>
                            <option value="عيني" {{ old('donation_type') == 'عيني' ? 'selected' : '' }}>عيني (سلع/لحوم/إلخ)</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">مبلغ التبرع</label>
                        <input type="number" name="donation_amount" value="{{ old('donation_amount') }}" class="input-field font-mono" placeholder="0.00">
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">دورية التبرع</label>
                        <select name="donation_time" class="input-field">
                            <option value="شهري" {{ old('donation_time') == 'شهري' ? 'selected' : '' }}>شهري</option>
                            <option value="موسمي" {{ old('donation_time') == 'موسمي' ? 'selected' : '' }}>موسمي</option>
                            <option value="مرة واحدة" {{ old('donation_time') == 'مرة واحدة' ? 'selected' : '' }}>مرة واحدة</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">وسيلة التواصل</label>
                        <select name="contact_method" class="input-field">
                            <option value="واتساب" {{ old('contact_method') == 'واتساب' ? 'selected' : '' }}>واتساب</option>
                            <option value="اتصال هاتف" {{ old('contact_method') == 'اتصال هاتف' ? 'selected' : '' }}>اتصال هاتف</option>
                            <option value="زيارة منزلية" {{ old('contact_method') == 'زيارة منزلية' ? 'selected' : '' }}>زيارة منزلية</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">تاريخ التبرع</label>
                        <input type="date" name="donation_date" value="{{ old('donation_date', date('Y-m-d')) }}" class="input-field">
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">طريقة الدفع</label>
                        <select name="payment_method" class="input-field">
                            <option value="نقدي" {{ old('payment_method') == 'نقدي' ? 'selected' : '' }}>نقدي</option>
                            <option value="فودافون كاش" {{ old('payment_method') == 'فودافون كاش' ? 'selected' : '' }}>فودافون كاش</option>
                            <option value="تحويل بنكي" {{ old('payment_method') == 'تحويل بنكي' ? 'selected' : '' }}>تحويل بنكي</option>
                            <option value="مندوب" {{ old('payment_method') == 'مندوب' ? 'selected' : '' }}>مندوب</option>
                        </select>
                    </div>
                </div>
                
                <div class="space-y-2 text-right">
                    <label class="font-black text-gray-700 block px-2 text-sm">هدف التبرع</label>
                    <div class="relative">
                        <select name="donation_goal" class="input-field appearance-none">
                            <option value="عام">عام</option>
                            <option value="كفالة يتيم">كفالة يتيم</option>
                            <option value="تجهيز عرائس">تجهيز عرائس</option>
                            <option value="وجبات ساخنة">وجبات ساخنة</option>
                            <option value="شنط رمضان">شنط رمضان</option>
                            <option value="كفارات يمين">كفارات يمين</option>
                            <option value="علاج">علاج</option>
                            <option value="بنك الطعام">بنك الطعام</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                <h3 class="font-black text-slate-800 flex items-center gap-2 mb-4">
                    <span class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-sm">📎</span>
                    المرفقات
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php $indDocs = ['صورة الهوية', 'إيصال تبرع', 'أخرى']; @endphp
                    @foreach($indDocs as $doc)
                    <label class="flex items-center gap-3 p-3 bg-white rounded-xl cursor-pointer hover:bg-emerald-50 transition-all border border-slate-200 hover:border-emerald-200">
                        <input type="checkbox" name="attachments[]" value="{{ $doc }}" {{ is_array(old('attachments')) && in_array($doc, old('attachments')) ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 rounded">
                        <span class="font-bold text-slate-700 text-sm">{{ $doc }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('supporters.index') }}" class="px-8 py-4 font-bold text-slate-500 hover:bg-slate-50 rounded-2xl transition-all">إلغاء</a>
                <button type="submit" class="btn-primary min-w-[200px] text-lg">حفظ المتبرع ✨</button>
            </div>
        </form>
    </div>

    <!-- Organization Form -->
    <div id="form_org" class="hidden glass-effect rounded-[2.5rem] p-8 md:p-12 border border-blue-100 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-blue-500 to-blue-600"></div>
        
        <form action="{{ route('supporters.org.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">اسم المؤسسة <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="اسم الشركة أو الجمعية">
                </div>
                <div class="space-y-2">
                    <label class="font-black text-gray-700 block px-2">رقم الهاتف <span class="text-rose-500">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required class="input-field" placeholder="01xxxxxxxxx">
                </div>
            </div>

            <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100 space-y-6">
                <h3 class="font-black text-blue-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-sm">🤝</span>
                    تفاصيل الشراكة
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">وقت المساعدة</label>
                        <select name="assistance_time" class="input-field">
                            <option value="شهري" {{ old('assistance_time') == 'شهري' ? 'selected' : '' }}>شهري</option>
                            <option value="موسمي" {{ old('assistance_time') == 'موسمي' ? 'selected' : '' }}>موسمي</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-gray-700 block px-2 text-sm">نوع الدعم المقدم</label>
                        <select name="support_type" class="input-field">
                            <option value="مالي" {{ old('support_type') == 'مالي' ? 'selected' : '' }}>دعم مالي</option>
                            <option value="ملابس" {{ old('support_type') == 'ملابس' ? 'selected' : '' }}>ملابس</option>
                            <option value="وجبات ساخنة" {{ old('support_type') == 'وجبات ساخنة' ? 'selected' : '' }}>وجبات ساخنة</option>
                            <option value="سلع تموينية" {{ old('support_type') == 'سلع تموينية' ? 'selected' : '' }}>سلع تموينية</option>
                            <option value="لحوم" {{ old('support_type') == 'لحوم' ? 'selected' : '' }}>لحوم</option>
                            <option value="تجهيز عرائس" {{ old('support_type') == 'تجهيز عرائس' ? 'selected' : '' }}>تجهيز عرائس</option>
                            <option value="علاج" {{ old('support_type') == 'علاج' ? 'selected' : '' }}>علاج</option>
                            <option value="أخرى" {{ old('support_type') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                        </select>
                    </div>
                    <div class="space-y-2 col-span-full">
                        <label class="font-black text-gray-700 block px-2 text-sm">مبلغ التبرع (إن وجد)</label>
                        <input type="number" name="donation_amount" value="{{ old('donation_amount') }}" class="input-field font-mono" placeholder="0.00">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="font-black text-gray-700 block px-2">العنوان بالتفصيل</label>
                <textarea name="address" rows="3" class="input-field" placeholder="محافظة - مدينة - شارع">{{ old('address') }}</textarea>
            </div>

            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                <h3 class="font-black text-slate-800 flex items-center gap-2 mb-4">
                    <span class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-sm">📎</span>
                    وثائق الشراكة
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php $orgDocs = ['عقد', 'سجل تجاري', 'بطاقة ضريبية', 'أخرى']; @endphp
                    @foreach($orgDocs as $doc)
                    <label class="flex items-center gap-3 p-3 bg-white rounded-xl cursor-pointer hover:bg-blue-50 transition-all border border-slate-200 hover:border-blue-200">
                        <input type="checkbox" name="attachments[]" value="{{ $doc }}" {{ is_array(old('attachments')) && in_array($doc, old('attachments')) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                        <span class="font-bold text-slate-700 text-sm">{{ $doc }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('supporters.index') }}" class="px-8 py-4 font-bold text-slate-500 hover:bg-slate-50 rounded-2xl transition-all">إلغاء</a>
                <button type="submit" class="btn-primary min-w-[200px] text-lg bg-blue-600 hover:bg-blue-700 shadow-blue-500/20">حفظ المؤسسة ✨</button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
    function switchTab(type) {
        const indTab = document.getElementById('tab_individual');
        const orgTab = document.getElementById('tab_org');
        const indForm = document.getElementById('form_individual');
        const orgForm = document.getElementById('form_org');

        if (type === 'individual') {
            indTab.className = "flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-emerald-700 ring-2 ring-emerald-100";
            orgTab.className = "flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700";
            indForm.classList.remove('hidden');
            orgForm.classList.add('hidden');
        } else {
            orgTab.className = "flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-blue-700 ring-2 ring-blue-100";
            indTab.className = "flex-1 md:flex-none px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700";
            orgForm.classList.remove('hidden');
            indForm.classList.add('hidden');
        }
    }

    // Default to individual unless there are errors for org, or org params
    @if($errors->hasBag('default') && (old('assistance_time') || old('support_type')))
        switchTab('org');
    @elseif(request('type') == 'org')
        switchTab('org');
    @else
        switchTab('individual');
    @endif
</script>
@endpush
@endsection
