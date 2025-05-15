<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;

class BarangController extends Controller
{
    public function index()
    {
        $data = BarangModel::with(['kategori', 'supplier'])->get();

        $page = (object)[
            'title' => 'Data Barang'
        ];

        $activeMenu = 'barang';

        $breadcrumb = (object)[
            'title' => 'Barang',
            'list' => [
                'Dashboard' => url('/'),
                'Barang' => ''
            ]
        ];

        return view('barang.index', compact('data', 'page', 'activeMenu', 'breadcrumb'));
    }
}
