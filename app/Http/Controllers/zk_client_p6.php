<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class zk_client_p6 extends Controller
{
    private $apiKelompok = 'https://orthomorphic-providential-shaina.ngrok-free.dev/public/api/rd_server_p6';

    public function index()
    {
        $hasil = [];
        $rawJson = '[]';
        $error = null;

        try {
            $hasil = Http::withHeaders(['ngrok-skip-browser-warning' => '69420'])
                ->connectTimeout(30)
                ->timeout(30)
                ->retry(2, 1000)
                ->get($this->apiKelompok)
                ->json() ?? [];
        } catch (\Exception $e) {
            $error = 'API Error: ' . $e->getMessage();
        }

        $rawJson = json_encode($hasil, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?: '[]';

        return view('zk_client_page', [
            'hasil' => $hasil,
            'rawJson' => $rawJson,
            'error' => $error,
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
