<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class biodata extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $json;

    public function __construct()
    {
        $this->json = storage_path('biodata.json');
    }


    public function index()
    {
        $contents = @file_get_contents($this->json);
        $view_api = json_decode($contents, true) ?? [];

        $view_api = array_map(function ($item) {
            return [
                'zk_nama' => $item['zk_nama'] ?? $item['nama'] ?? '',
                'zk_npm' => $item['zk_npm'] ?? $item['npm'] ?? '',
                'zk_prodi' => $item['zk_prodi'] ?? $item['prodi'] ?? '',
                'zk_ipk' => $item['zk_ipk'] ?? $item['ipk'] ?? '',
                'zk_semester' => $item['zk_semester'] ?? $item['semester'] ?? '',
            ];
        }, $view_api);

        return response()->json($view_api);
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
        $biodata_baru = json_decode(file_get_contents($this->json), true) ?? [];

        $payload = $request->all();

        // Check if the payload is an array of objects (indexed array)
        if (is_array($payload) && count($payload) > 0 && !isset($payload['zk_nama'])) {
            foreach ($payload as $item) {
                if (is_array($item)) {
                    $biodata_baru[] = [
                        'zk_nama' => $item['zk_nama'] ?? $item['nama'] ?? null,
                        'zk_npm' => $item['zk_npm'] ?? $item['npm'] ?? null,
                        'zk_prodi' => $item['zk_prodi'] ?? $item['prodi'] ?? null,
                        'zk_ipk' => $item['zk_ipk'] ?? $item['ipk'] ?? null,
                        'zk_semester' => $item['zk_semester'] ?? $item['semester'] ?? null,
                    ];
                }
            }
            $data = $payload;
        } else {
            $biodata = [
                'zk_nama' => $request->input('zk_nama'),
                'zk_npm' => $request->input('zk_npm'),
                'zk_prodi' => $request->input('zk_prodi'),
                'zk_ipk' => $request->input('zk_ipk'),
                'zk_semester' => $request->input('zk_semester'),
            ];
            $biodata_baru[] = $biodata;
            $data = $biodata;
        }

        file_put_contents($this->json, json_encode($biodata_baru, JSON_PRETTY_PRINT));
        return response()->json(['message' => 'Data cantik diproses', 'data' => $data]);
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
        $biodata_json = json_decode(@file_get_contents($this->json), true) ?? [];

        if (! isset($biodata_json[$id])) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $biodata_json[$id] = [
            'zk_nama' => $request->input('zk_nama'),
            'zk_npm' => $request->input('zk_npm'),
            'zk_prodi' => $request->input('zk_prodi'),
            'zk_ipk' => $request->input('zk_ipk'),
            'zk_semester' => $request->input('zk_semester'),
        ];

        file_put_contents($this->json, json_encode(array_values($biodata_json), JSON_PRETTY_PRINT));

        return response()->json(['message' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $biodata_json = json_decode(file_get_contents($this->json), true) ?? [];
        if (isset($biodata_json[$id])) {
            unset($biodata_json[$id]);
            file_put_contents($this->json, json_encode(array_values($biodata_json), JSON_PRETTY_PRINT));
            return response()->json(['message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
