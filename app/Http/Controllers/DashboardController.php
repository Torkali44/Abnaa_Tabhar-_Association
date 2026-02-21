<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\SupporterOrg;
use App\Models\SupporterIndividual;
use App\Models\Donation;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'beneficiaries' => Beneficiary::count(),
            'supporters' => SupporterOrg::count() + SupporterIndividual::count(),
            'donations_amount' => Donation::sum('amount'), 
            'donations_count' => Donation::count(), 
            'income' => SupporterIndividual::sum('donation_amount') + SupporterOrg::sum('donation_amount'), 
            'employees' => Employee::count(),
            'projects_count' => Donation::distinct('category')->count(),
        ];

        $stats['balance'] = $stats['income'] - $stats['donations_amount'];

        $recent_beneficiaries = Beneficiary::latest()->take(5)->get();
        $recent_donations = Donation::with('beneficiary')->latest()->take(5)->get();

        $total_beneficiaries = Beneficiary::count();
        $high_need_count = Beneficiary::where('need_level', 'عالي')->count();
        
        $aided_beneficiaries_count = Donation::distinct('beneficiary_id')->count('beneficiary_id');
        $high_need_aided_count = Donation::whereIn('beneficiary_id', Beneficiary::where('need_level', 'عالي')->pluck('id'))
            ->distinct('beneficiary_id')
            ->count('beneficiary_id');

        $stats['achievement_rate'] = $total_beneficiaries > 0 ? round(($aided_beneficiaries_count / $total_beneficiaries) * 100) : 0;
        $stats['high_need_rate'] = $high_need_count > 0 ? round(($high_need_aided_count / $high_need_count) * 100) : 0;
        $stats['fund_usage'] = $stats['income'] > 0 ? round(($stats['donations_amount'] / $stats['income']) * 100) : 0;

        return view('home', compact('stats', 'recent_beneficiaries', 'recent_donations'));
    }

    public function dashboard()
    {
        $stats = [
            'beneficiaries' => Beneficiary::count(),
            'supporters' => SupporterOrg::count() + SupporterIndividual::count(),
            'donations' => Donation::sum('amount'), 
            'income' => SupporterIndividual::sum('donation_amount') + SupporterOrg::sum('donation_amount'), 
            'employees' => Employee::count(),
        ];

        $stats['balance'] = $stats['income'] - $stats['donations'];

        $recent_beneficiaries = Beneficiary::latest()->take(5)->get();
        $recent_donations = Donation::with('beneficiary')->latest()->take(5)->get();

        $total_beneficiaries = Beneficiary::count();
        $high_need_count = Beneficiary::where('need_level', 'عالي')->count();
        
        $aided_beneficiaries_count = Donation::distinct('beneficiary_id')->count('beneficiary_id');
        $high_need_aided_count = Donation::whereIn('beneficiary_id', Beneficiary::where('need_level', 'عالي')->pluck('id'))
            ->distinct('beneficiary_id')
            ->count('beneficiary_id');

        $stats['achievement_rate'] = $total_beneficiaries > 0 ? round(($aided_beneficiaries_count / $total_beneficiaries) * 100) : 0;
        $stats['high_need_rate'] = $high_need_count > 0 ? round(($high_need_aided_count / $high_need_count) * 100) : 0;
        $stats['fund_usage'] = $stats['income'] > 0 ? round(($stats['donations'] / $stats['income']) * 100) : 0;

        return view('dashboard.index', compact('stats', 'recent_beneficiaries', 'recent_donations'));
    }
}
