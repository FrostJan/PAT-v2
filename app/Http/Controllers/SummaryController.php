<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Models\FacilityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SummaryController extends Controller
{
    public function index(Request $request): Response
    {
        Gate::authorize('approve', FacilityRequest::class);

        $year = (int) ($request->query('year') ?: now()->year);
        $month = $request->query('month') ? (int) $request->query('month') : null;

        $base = FacilityRequest::query()->whereYear('date_needed', $year);
        if ($month) {
            $base->whereMonth('date_needed', $month);
        }

        $approvedVsDeclined = [
            'approved' => (clone $base)->where('status', RequestStatus::Approved)->count(),
            'declined' => (clone $base)->where('status', RequestStatus::Declined)->count(),
            'pending' => (clone $base)->where('status', RequestStatus::Pending)->count(),
        ];

        $perDepartment = (clone $base)
            ->select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->orderBy('total', 'desc')
            ->get()
            ->map(fn ($row) => ['department' => $row->department, 'total' => (int) $row->total]);

        $monthly = FacilityRequest::query()
            ->whereYear('date_needed', $year)
            ->selectRaw('EXTRACT(MONTH FROM date_needed) as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(fn ($row) => ['month' => (int) $row->month, 'total' => (int) $row->total]);

        return Inertia::render('summary/index', [
            'year' => $year,
            'month' => $month,
            'approvedVsDeclined' => $approvedVsDeclined,
            'perDepartment' => $perDepartment,
            'monthly' => $monthly,
        ]);
    }
}
