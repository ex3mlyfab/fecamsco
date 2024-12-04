<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function get_supplier_data(Request $request)
    {
        $supp = Supplier::orderBy('id', 'desc');
    }
}
