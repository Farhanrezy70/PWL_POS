<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    // Tampilkan form create ajax
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori produk yang tersedia'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif
        $kategori = KategoriModel::all(); // ambil semua data kategori

        return view('kategori.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request) 
    { 
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return datatables()->of($kategori)
            ->addIndexColumn() // menambahkan kolom index
            ->addColumn('aksi', function ($kategori) {
                $btn  = '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
        ->rawColumns(['aksi']) // agar HTML tidak di-escape
        ->make(true);
    }


    // Simpan data baru via AJAX
    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|max:50'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil ditambahkan.'
            ]);
        }
    }

    // Tampilkan form edit via AJAX
    public function edit_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', compact('kategori'));
    }

    // Update data via AJAX
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
                'kategori_nama' => 'required|max:50'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data kategori berhasil diperbarui.'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    // Tampilkan konfirmasi hapus via AJAX
    public function confirm_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', compact('kategori'));
    }

    // Hapus data via AJAX
    public function delete_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        if ($kategori) {
            $kategori->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil dihapus.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan.'
        ]);
    }
}
