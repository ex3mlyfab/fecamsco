<?php

namespace App\Http\Controllers;

use App\Models\Ctls;
use App\Models\CtlsDetails;
use App\Models\Revenue;
use App\Models\Sale;
use App\Models\SavingUpload;
use App\Models\SavingUploadDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index()
    {
        $ctss_year = SavingUploadDetail::select(DB::raw('YEAR(deduction_period) as year'))->groupBy('year')->orderBy('year', 'desc')->get();
        $sale_year = Sale::select(DB::raw('YEAR(created_at) as year'))->groupBy('year')->orderBy('year', 'desc')->get();
        $ctss_year = array_merge( $sale_year,$ctss_year);
        return view('analysis.index', compact('ctss_year'));
    }

    public function depositAnalysis(Request $request)
    {

        $deposits = SavingUploadDetail::whereYear('deduction_period', $request->year)->get();

        $ctlsses = CtlsDetails::whereYear('deduction_period', $request->year)->get();

        $sales= Sale::query()->whereYear('created_at', $request->year)
                            ->selectRaw('MONTH(created_at) as month, SUM(Total_cost) as total_sum')
                            ->groupBy('month')
                            ->get();

                        // Optional: Format the results for easier display
        foreach ($sales as $group) {
            $monthName = date('F', mktime(0, 0, 0, $group->month, 1));
            $group->month_name = $monthName;
        }
        $revenues = Revenue::query()->whereYear('created_at', $request->year)
                                    ->selectRaw('MONTH(created_at) as month, Sum(amount) as total_sum')
                                    ->groupBy('month')
                                    ->get();
        foreach ($revenues as $groupRev) {
            $monthNameRev = date('F', mktime(0, 0, 0, $groupRev->month, 1));
            $groupRev->month_name = $monthNameRev;
        }
        return response()->json(['deposits' => $deposits, 'ctlsses' => $ctlsses, 'sales' => $sales, 'revenues' => $revenues]);
    }
}
