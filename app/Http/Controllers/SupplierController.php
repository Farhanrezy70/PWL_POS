<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;  


class SupplierController extends Controller
{
    public function index()
    {
        $data = SupplierModel::all();

        $page = (object)[
            'title' => 'Data Supplier'
        ];

        $activeMenu = 'supplier';

        $breadcrumb = (object)[
            'title' => 'Supplier',
            'list' => [
                'Dashboard' => url('/'),
                'Supplier' => ''
            ]
        ];

        return view('supplier.index', compact('data', 'page', 'activeMenu', 'breadcrumb'));
    }
}