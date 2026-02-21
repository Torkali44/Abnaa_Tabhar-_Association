<?php

namespace App\Http\Controllers;

use App\Models\SupporterOrg;
use App\Models\SupporterIndividual;
use App\Services\SupporterService;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
    protected $service;

    public function __construct(SupporterService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $orgsQuery = SupporterOrg::latest();
        $individualsQuery = SupporterIndividual::latest();

        if ($request->filled('search')) {
            $orgsQuery->search($request->search);
            $individualsQuery->search($request->search);
        }

        $orgs = $orgsQuery->paginate(12, ['*'], 'org_page')->withQueryString();
        $individuals = $individualsQuery->paginate(12, ['*'], 'ind_page')->withQueryString();

        return view('supporters.index', compact('orgs', 'individuals'));
    }

    public function create()
    {
        return view('supporters.create');
    }

    public function storeOrg(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'support_type' => 'nullable|string',
            'donation_amount' => 'nullable|numeric',
            'assistance_time' => 'nullable|string',
            'attachments' => 'nullable|array',
        ]);

        $this->service->createOrg($validated);

        return redirect()->route('supporters.index')
            ->with('success', 'تم إضافة المؤسسة بنجاح');
    }

    public function storeIndividual(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'national_id' => 'nullable|string',
            'address' => 'nullable|string',
            'donation_type' => 'nullable|string',
            'donation_amount' => 'nullable|numeric',
            'donation_time' => 'nullable|string',
            'contact_method' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'donation_goal' => 'nullable|string',
            'attachments' => 'nullable|array',
        ]);

        $this->service->createIndividual($validated);

        return redirect()->route('supporters.index')
            ->with('success', 'تم إضافة المتبرع بنجاح');
    }

    public function updateOrg(Request $request, SupporterOrg $org)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'support_type' => 'nullable|string',
            'donation_amount' => 'nullable|numeric',
            'assistance_time' => 'nullable|string',
            'attachments' => 'nullable|array',
        ]);

        $this->service->updateOrg($org->id, $validated);

        return redirect()->route('supporters.index')
            ->with('success', 'تم تحديث بيانات المؤسسة بنجاح');
    }

    public function updateIndividual(Request $request, SupporterIndividual $individual)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'national_id' => 'nullable|string',
            'address' => 'nullable|string',
            'donation_type' => 'nullable|string',
            'donation_amount' => 'nullable|numeric',
            'donation_time' => 'nullable|string',
            'contact_method' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'donation_goal' => 'nullable|string',
            'attachments' => 'nullable|array',
        ]);

        $this->service->updateIndividual($individual->id, $validated);

        return redirect()->route('supporters.index')
            ->with('success', 'تم تحديث بيانات المتبرع بنجاح');
    }

    public function destroyOrg(SupporterOrg $org)
    {
        $this->service->deleteOrg($org->id);

        return redirect()->route('supporters.index')
            ->with('success', 'تم حذف المؤسسة بنجاح');
    }

    public function destroyIndividual(SupporterIndividual $individual)
    {
        $this->service->deleteIndividual($individual->id);

        return redirect()->route('supporters.index')
            ->with('success', 'تم حذف المتبرع بنجاح');
    }
}
