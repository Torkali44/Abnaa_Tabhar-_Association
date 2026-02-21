@extends('layouts.app')

@section('title', 'تعديل بيانات الموظف')

@section('content')
<div class="space-y-8 pb-20 animate-fade-in">
    <div>
        <a href="{{ route('employees.index') }}" class="text-emerald-600 hover:text-emerald-700 font-bold inline-flex items-center mb-4 transition-colors">
            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            العودة للقائمة
        </a>
        <h2 class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent mb-2">
            تعديل بيانات: {{ $employee->name }} 👔
        </h2>
        <p class="text-gray-600 text-lg">تحديث سجلات الحضور والبيانات المالية</p>
    </div>

    <form action="{{ route('employees.update', $employee) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="glass-effect rounded-3xl p-10 border border-emerald-100 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-emerald-500 to-emerald-600"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="font-bold text-gray-700">اسم الموظف</label>
                    <input type="text" name="name" value="{{ old('name', $employee->name) }}" required class="input-field">
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-gray-700">نوع الوظيفة</label>
                    <input type="text" name="job_type" value="{{ old('job_type', $employee->job_type) }}" required class="input-field">
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-gray-700">رقم الهاتف</label>
                    <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" required class="input-field">
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-emerald-700">الراتب الشهري (ج.م)</label>
                    <input type="number" name="monthly_salary" value="{{ old('monthly_salary', $employee->monthly_salary) }}" required class="input-field bg-emerald-50/50">
                </div>
            </div>
        </div>

        <div class="glass-effect rounded-3xl p-10 border border-orange-100 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-2 bg-gradient-to-l from-orange-500 to-orange-600"></div>
            
            <div class="flex items-center gap-3 mb-6">
                <h3 class="text-2xl font-black text-gray-800">سجل الحضور والانصراف</h3>
            </div>

            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-red-700">الغيابات</h4>
                    <button type="button" onclick="addAbsence()" class="px-4 py-2 bg-red-600 text-white rounded-xl font-bold">إضافة غياب</button>
                </div>
                <div id="absencesContainer" class="space-y-3">
                    @if($employee->absences)
                        @foreach($employee->absences as $index => $record)
                        <div class="p-4 bg-red-50 rounded-xl border-2 border-red-100 relative animate-scale-in">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 text-red-700">❌</button>
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <input type="date" name="absences[{{$index}}][date]" value="{{$record['date']}}" class="input-field" required>
                                <input type="text" name="absences[{{$index}}][reason]" value="{{$record['reason']}}" class="input-field" placeholder="السبب" required>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-yellow-700">التأخيرات</h4>
                    <button type="button" onclick="addLate()" class="px-4 py-2 bg-yellow-600 text-white rounded-xl font-bold">إضافة تأخير</button>
                </div>
                <div id="latesContainer" class="space-y-3">
                    @if($employee->late_records)
                        @foreach($employee->late_records as $index => $record)
                        <div class="p-4 bg-yellow-50 rounded-xl border-2 border-yellow-100 relative animate-scale-in">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 text-yellow-700">❌</button>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                                <input type="date" name="late_records[{{$index}}][date]" value="{{$record['date']}}" class="input-field" required>
                                <input type="number" name="late_records[{{$index}}][duration]" value="{{$record['duration']}}" class="input-field" placeholder="المدة بالدقائق" required>
                                <input type="text" name="late_records[{{$index}}][reason]" value="{{$record['reason']}}" class="input-field" placeholder="السبب" required>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- Vacations Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-lg text-blue-700">الإجازات</h4>
                    <button type="button" onclick="addVacation()" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-bold">إضافة إجازة</button>
                </div>
                <div id="vacationsContainer" class="space-y-3">
                    @if($employee->vacations)
                        @foreach($employee->vacations as $index => $record)
                        <div class="p-4 bg-blue-50 rounded-xl border-2 border-blue-100 relative animate-scale-in">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 text-blue-700">❌</button>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
                                <input type="date" name="vacations[{{$index}}][start_date]" value="{{$record['start_date']}}" class="input-field" required>
                                <input type="date" name="vacations[{{$index}}][end_date]" value="{{$record['end_date']}}" class="input-field" required>
                                <input type="text" name="vacations[{{$index}}][reason]" value="{{$record['reason']}}" class="input-field" placeholder="السبب" required>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="border-t pt-8">
                <h4 class="font-bold text-lg text-slate-700 mb-6 flex items-center gap-2 px-10">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    المرفقات المسلمة
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-10 pb-10">
                    @php $docs = ['صورة البطاقة', 'فيش جنائي', 'شهادة الميلاد', 'شهادة المؤهل', 'صورة شخصية', 'أخرى']; @endphp
                    @foreach($docs as $doc)
                    <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-emerald-50 transition-all border border-transparent hover:border-emerald-200">
                        <input type="checkbox" name="attachments[]" value="{{ $doc }}" {{ is_array($employee->attachments) && in_array($doc, $employee->attachments) ? 'checked' : '' }} class="w-5 h-5 text-emerald-600 rounded-lg">
                        <span class="font-bold text-slate-700 text-sm">{{ $doc }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('employees.index') }}" class="px-10 py-4 rounded-2xl font-bold border-2 border-gray-300 hover:bg-gray-50 transition-all">إلغاء</a>
            <button type="submit" class="btn-primary min-w-[240px]">تحديث البيانات</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
let absenceCount = {{ $employee->absences ? count($employee->absences) : 0 }};
let lateCount = {{ $employee->late_records ? count($employee->late_records) : 0 }};
let vacationCount = {{ $employee->vacations ? count($employee->vacations) : 0 }};

function addAbsence() {
    absenceCount++;
    const container = document.getElementById('absencesContainer');
    const div = document.createElement('div');
    div.className = 'p-4 bg-red-50 rounded-xl border-2 border-red-100 animate-scale-in relative';
    div.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 w-7 h-7 bg-red-200 hover:bg-red-300 text-red-700 rounded-lg transition-all flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-bold text-sm text-red-900 mb-2 block">التاريخ</label>
                <input type="date" name="absences[${absenceCount}][date]" class="input-field" required>
            </div>
            <div>
                <label class="font-bold text-sm text-red-900 mb-2 block">السبب</label>
                <input type="text" name="absences[${absenceCount}][reason]" class="input-field" placeholder="سبب الغياب" required>
            </div>
        </div>
    `;
    container.appendChild(div);
}

function addLate() {
    lateCount++;
    const container = document.getElementById('latesContainer');
    const div = document.createElement('div');
    div.className = 'p-4 bg-yellow-50 rounded-xl border-2 border-yellow-100 animate-scale-in relative';
    div.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 w-7 h-7 bg-yellow-200 hover:bg-yellow-300 text-yellow-700 rounded-lg transition-all flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-bold text-sm text-yellow-900 mb-2 block">التاريخ</label>
                <input type="date" name="late_records[${lateCount}][date]" class="input-field" required>
            </div>
            <div>
                <label class="font-bold text-sm text-yellow-900 mb-2 block">مدة التأخير (دقيقة)</label>
                <input type="number" name="late_records[${lateCount}][duration]" class="input-field" placeholder="30" min="1" required>
            </div>
            <div>
                <label class="font-bold text-sm text-yellow-900 mb-2 block">السبب</label>
                <input type="text" name="late_records[${lateCount}][reason]" class="input-field" placeholder="سبب التأخير" required>
            </div>
        </div>
    `;
    container.appendChild(div);
}

function addVacation() {
    vacationCount++;
    const container = document.getElementById('vacationsContainer');
    const div = document.createElement('div');
    div.className = 'p-4 bg-blue-50 rounded-xl border-2 border-blue-100 animate-scale-in relative';
    div.innerHTML = `
        <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 left-2 w-7 h-7 bg-blue-200 hover:bg-blue-300 text-blue-700 rounded-lg transition-all flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-bold text-sm text-blue-900 mb-2 block">من تاريخ</label>
                <input type="date" name="vacations[${vacationCount}][start_date]" class="input-field" required>
            </div>
            <div>
                <label class="font-bold text-sm text-blue-900 mb-2 block">إلى تاريخ</label>
                <input type="date" name="vacations[${vacationCount}][end_date]" class="input-field" required>
            </div>
            <div>
                <label class="font-bold text-sm text-blue-900 mb-2 block">السبب</label>
                <input type="text" name="vacations[${vacationCount}][reason]" class="input-field" placeholder="سبب الإجازة" required>
            </div>
        </div>
    `;
    container.appendChild(div);
}
</script>
@endpush
@endsection
