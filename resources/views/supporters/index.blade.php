@extends('layouts.app')

@section('title', 'سجل الداعمين')

@section('content')
<div class="space-y-8 pb-20 animate-fade-in">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 print:hidden">
        <div>
            <h2 class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent mb-2">
                سجل الداعمين والشركاء 🤝
            </h2>
            <p class="text-gray-600 text-lg">إدارة المؤسسات والأفراد المساهمين في أعمال الجمعية</p>
        </div>
        <div class="flex flex-col md:flex-row gap-3">
            <button onclick="exportToExcel(document.getElementById('individuals_content').classList.contains('hidden') ? 'orgsPrintTable' : 'individualsPrintTable', 'سجل_الداعمين')" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                تصدير Excel
            </button>
            <button onclick="window.print()" class="px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition-all flex items-center justify-center gap-2 border border-slate-200">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                طباعة
            </button>
            <a href="{{ route('supporters.create', ['type' => 'org']) }}" class="px-6 py-3 rounded-xl bg-gradient-to-br from-emerald-600 to-emerald-500 text-white font-bold hover:shadow-lg hover:scale-105 transition-all flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                إضافة مؤسسة
            </a>
            <a href="{{ route('supporters.create', ['type' => 'individual']) }}" class="px-6 py-3 rounded-xl border-2 border-emerald-600 text-emerald-700 font-bold hover:bg-emerald-50 hover:scale-105 transition-all flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                إضافة متبرع
            </a>
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6 print:hidden">
        <div class="bg-gray-100 p-1.5 rounded-2xl inline-flex shadow-inner">
            <button onclick="showTab('individuals')" id="tab_individuals" class="px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-emerald-700">متبرعين أفراد</button>
            <button onclick="showTab('orgs')" id="tab_orgs" class="px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700">مؤسسات وجمعيات</button>
        </div>
        
        <form action="{{ route('supporters.index') }}" method="GET" class="relative group">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث باسم الداعم أو الهاتف..." 
                class="w-64 px-10 py-3 bg-white border-2 border-slate-100 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all font-bold text-sm">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <div id="individuals_content" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in print:hidden">
        @forelse($individuals as $individual)
        <div class="card-hover glass-effect rounded-[2.5rem] p-8 border border-white/20 shadow-xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-400/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg text-white font-black text-2xl">
                        {{ substr($individual->name, 0, 1) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-black text-xl text-gray-800 truncate">{{ $individual->name }}</h4>
                        <p class="text-xs text-emerald-600 font-bold bg-emerald-50 inline-block px-2 py-1 rounded-lg mt-1">داعم فردي</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 group-hover:bg-emerald-50/50 transition-colors">
                        <p class="text-[10px] font-black text-gray-400 uppercase mb-1 tracking-wider">قيمة التبرع</p>
                        <p class="text-lg font-black text-emerald-700">{{ number_format($individual->donation_amount ?? 0) }}ج.م</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 group-hover:bg-blue-50/50 transition-colors">
                        <p class="text-[10px] font-black text-gray-400 uppercase mb-1 tracking-wider">دورية التبرع</p>
                        <p class="text-sm font-black text-blue-600">{{ $individual->donation_time ?? 'غير محدد' }}</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="font-bold">{{ $individual->phone }}</span>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openEditIndividualModal({{ $individual }})" class="w-10 h-10 flex items-center justify-center text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <form action="{{ route('supporters.individual.destroy', $individual) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المتبرع؟')">
                            @csrf
                            @method('DELETE')
                            @if(auth()->user()->role == 'admin')
                            <button type="submit" class="w-10 h-10 flex items-center justify-center text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-gray-400 font-bold">لا يوجد متبرعين أفراد مسجلين</p>
        </div>
        @endforelse

        <div class="col-span-full mt-4">
            {{ $individuals->appends(['org_page' => request('org_page')])->links() }}
        </div>
    </div>

    <div id="orgs_content" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in print:hidden">
        @forelse($orgs as $org)
        <div class="card-hover glass-effect rounded-[2.5rem] p-8 border border-white/20 shadow-xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-400/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-emerald-600 flex items-center justify-center shadow-lg text-white font-black text-2xl">
                        🏢
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-black text-xl text-gray-800 truncate">{{ $org->name }}</h4>
                        <p class="text-xs text-blue-600 font-bold bg-blue-50 inline-block px-2 py-1 rounded-lg mt-1">شريك مؤسسي</p>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 group-hover:bg-blue-50/50 transition-colors">
                    <p class="text-[10px] font-black text-gray-400 uppercase mb-1">بيانات التواصل</p>
                    <p class="text-sm font-black text-gray-700 leading-relaxed">{{ $org->phone }}<br>{{ $org->address ?? 'لا يوجد عنوان' }}</p>
                </div>
                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <button onclick="openEditOrgModal({{ $org }})" class="text-emerald-600 font-bold text-sm hover:underline">تعديل</button>
                    @if(auth()->user()->role == 'admin')
                    <form action="{{ route('supporters.org.destroy', $org) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-rose-500 font-black text-sm hover:underline" onclick="return confirm('حذف المؤسسة؟')">حذف الشريك</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <p class="text-gray-400 font-bold">لا يوجد مؤسسات مسجلة</p>
        </div>
        @endforelse

        <div class="col-span-full mt-4">
            {{ $orgs->appends(['ind_page' => request('ind_page')])->links() }}
        </div>
    </div>

    {{-- Print Only Tables --}}
    <div class="hidden print:block">
        <h2 class="text-2xl font-black mb-4">قائمة الداعمين الأفراد</h2>
        <table id="individualsPrintTable">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>مبلغ التبرع</th>
                    <th>دورية التبرع</th>
                </tr>
            </thead>
            <tbody>
                @foreach($individuals as $individual)
                <tr>
                    <td>{{ $individual->name }}</td>
                    <td>{{ $individual->phone }}</td>
                    <td>{{ number_format($individual->donation_amount ?? 0) }}ج.م</td>
                    <td>{{ $individual->donation_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-2xl font-black mb-4 mt-10">قائمة المؤسسات والشركاء</h2>
        <table id="orgsPrintTable">
            <thead>
                <tr>
                    <th>اسم المؤسسة</th>
                    <th>الهاتف</th>
                    <th>العنوان</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orgs as $org)
                <tr>
                    <td>{{ $org->name }}</td>
                    <td>{{ $org->phone }}</td>
                    <td>{{ $org->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="modalOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">


    <div id="editOrgModal" class="bg-white rounded-[2.5rem] p-10 max-w-xl w-full shadow-2xl relative animate-scale-in hidden">
        <h3 class="text-3xl font-black text-gray-800 mb-6">تعديل بيانات المؤسسة 🏢</h3>
        <form id="editOrgForm" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div><label class="font-bold text-gray-700 mb-2 block">اسم المؤسسة</label><input type="text" name="name" id="edit_org_name" required class="input-field"></div>
            <div><label class="font-bold text-gray-700 mb-2 block">رقم الهاتف</label><input type="text" name="phone" id="edit_org_phone" required class="input-field"></div>
            <div><label class="font-bold text-gray-700 mb-2 block">العنوان بالتفصيل</label><textarea name="address" id="edit_org_address" rows="2" class="input-field"></textarea></div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeAllModals()" class="flex-1 py-4 font-bold border-2 border-gray-200 rounded-2xl">إلغاء</button>
                <button type="submit" class="flex-1 btn-primary">تحديث البيانات</button>
            </div>
        </form>
    </div>

    <div id="editIndividualModal" class="bg-white rounded-[2.5rem] p-10 max-w-xl w-full shadow-2xl relative animate-scale-in hidden">
        <h3 class="text-3xl font-black text-gray-800 mb-6">تعديل بيانات المتبرع 👤</h3>
        <form id="editIndividualForm" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div><label class="font-bold text-gray-700 mb-2 block">اسم المتبرع</label><input type="text" name="name" id="edit_ind_name" required class="input-field"></div>
            <div><label class="font-bold text-gray-700 mb-2 block">رقم الهاتف</label><input type="text" name="phone" id="edit_ind_phone" required class="input-field"></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="font-bold text-gray-700 mb-2 block">مبلغ التبرع</label><input type="number" name="donation_amount" id="edit_ind_amount" class="input-field"></div>
                <div><label class="font-bold text-gray-700 mb-2 block">دورية التبرع</label>
                    <select name="donation_time" id="edit_ind_time" class="input-field">
                        <option value="شهري">شهري</option>
                        <option value="موسمي">موسمي</option>
                        <option value="مرة واحدة">مرة واحدة</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="closeAllModals()" class="flex-1 py-4 font-bold border-2 border-gray-200 rounded-2xl">إلغاء</button>
                <button type="submit" class="flex-1 btn-primary">تحديث البيانات</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showTab(type) {
    const indTab = document.getElementById('tab_individuals');
    const orgTab = document.getElementById('tab_orgs');
    const indContent = document.getElementById('individuals_content');
    const orgContent = document.getElementById('orgs_content');

    if (type === 'individuals') {
        indTab.className = "px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-emerald-700";
        orgTab.className = "px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700";
        indContent.classList.remove('hidden');
        orgContent.classList.add('hidden');
    } else {
        orgTab.className = "px-10 py-3 rounded-xl font-black text-sm transition-all bg-white shadow-sm text-emerald-700";
        indTab.className = "px-10 py-3 rounded-xl font-black text-sm transition-all text-gray-500 hover:text-gray-700";
        orgContent.classList.remove('hidden');
        indContent.classList.add('hidden');
    }
}

function openModal(id) {
    document.getElementById('modalOverlay').classList.remove('hidden');
    document.getElementById('modalOverlay').classList.add('flex');
    document.getElementById(id).classList.remove('hidden');
}

function openEditOrgModal(org) {
    openModal('editOrgModal');
    document.getElementById('editOrgForm').action = `/supporters/org/${org.id}`;
    document.getElementById('edit_org_name').value = org.name;
    document.getElementById('edit_org_phone').value = org.phone;
    document.getElementById('edit_org_address').value = org.address || '';
}

function openEditIndividualModal(individual) {
    openModal('editIndividualModal');
    document.getElementById('editIndividualForm').action = `/supporters/individual/${individual.id}`;
    document.getElementById('edit_ind_name').value = individual.name;
    document.getElementById('edit_ind_phone').value = individual.phone;
    document.getElementById('edit_ind_amount').value = individual.donation_amount || '';
    document.getElementById('edit_ind_time').value = individual.donation_time || 'مرة واحدة';
}

function closeAllModals() {
    document.getElementById('modalOverlay').classList.add('hidden');
    document.querySelectorAll('#modalOverlay > div').forEach(div => div.classList.add('hidden'));
}

document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAllModals();
    }
});
</script>
@endpush
@endsection

