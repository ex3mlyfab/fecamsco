<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class SupplierController extends Controller
{
    public function get_supplier_data(Request $request)
    {
        $supp = Supplier::orderBy('id', 'desc');

        return DataTables::eloquent($supp)
            ->filter(function ($query) use ($request) {
                if ($request->has('name')) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
            })
            ->addColumn('action', function ($supp) {
                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . __('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu">'
            . '<a href="' . route('supplier.show', $supp->id) . '" class="dropdown-item ajax-modal"><i class="ti-credit-card"></i> ' . __('Show Supplier Detail') . '</a>'
                . '</div>';
            })
            ->setRowId(function ($supp) {
            return "row_" . $supp->id;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return view('shop.all-supplier');
    }
}
