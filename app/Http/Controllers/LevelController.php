<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang tersedia dalam sistem'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif
        $level = LevelModel::all(); // ambil semua data level

        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request) 
    { 
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return datatables()->of($levels)
            ->addIndexColumn() // menambahkan kolom index
            ->addColumn('aksi', function ($level) {
                $btn  = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
        ->rawColumns(['aksi']) // agar HTML tidak di-escape
        ->make(true);
    }


    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'level_kode' => 'required|string|max:20|unique:m_level,level_kode',
                'level_nama' => 'required|string|min:3|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            LevelModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil ditambahkan.'
            ]);
        }
    }

    public function edit_ajax($id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', compact('level'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'level_kode' => 'required|string|max:20|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|min:3|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil diupdate.'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }

    public function confirm_ajax($id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', compact('level'));
    }

    public function delete_ajax($id)
    {
        $level = LevelModel::find($id);
        if ($level) {
            $level->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil dihapus.'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan.'
        ]);
    }
}
