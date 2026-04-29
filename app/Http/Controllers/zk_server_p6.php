<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class zk_server_p6 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil data dari tabel zk_p6 lalu ditampilkan ke API JSON
        $data = DB::table('zk_p6')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Seluruh Data Mahasiswa',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // simpan data (npm, nama, prodi) ke tabel zk_p6
        DB::table('zk_p6')->insert([
            'zk_npm' => $request->npm,
            'zk_nama' => $request->nama,
            'zk_prodi' => $request->prodi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'data' => [
                'npm' => $request->npm,
                'nama' => $request->nama,
                'prodi' => $request->prodi,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // menghapus berdasarkan id lalu kirim feedback JSON
        DB::table('zk_p6')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
            'data' => ['id' => $id],
        ]);
    }
}
