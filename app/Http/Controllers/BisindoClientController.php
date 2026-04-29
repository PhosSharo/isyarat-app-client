<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BisindoClientController extends Controller
{
    private $baseUrl = 'https://polyester-pupil-armored.ngrok-free.dev/public/api';
    private $webUrl = 'https://polyester-pupil-armored.ngrok-free.dev';

    /**
     * Helper: make a GET request to the ngrok API with proper headers.
     */
    private function apiGet(string $endpoint, array $query = [])
    {
        return Http::withHeaders([
            'ngrok-skip-browser-warning' => '69420',
            'Accept' => 'application/json',
        ])
            ->connectTimeout(30)
            ->timeout(30)
            ->retry(2, 1000)
            ->get($this->baseUrl . $endpoint, $query);
    }

    /**
     * Dashboard: fetch stats + all 9 data tables from the remote API and display.
     */
    public function index()
    {
        $error = null;
        $stats = [];
        $gestures = [];
        $users = [];
        $vocabularies = [];
        $translations = [];
        $audioFiles = [];
        $categories = [];
        $histories = [];
        $models = [];
        $feedbacks = [];

        try {
            // Fetch dashboard stats
            $statsResponse = $this->apiGet('/dashboard/stats');
            if ($statsResponse->successful()) {
                $statsData = $statsResponse->json();

                $stats = [
                    [
                        'title'  => '1. Data Gestur Tangan',
                        'satuan' => 'Jumlah gestur (buah/item)',
                        'rows'   => [
                            'Total Gestur'   => $statsData['data_gestur_tangan']['total_gestur'] ?? 0,
                            'Gestur Statis'  => $statsData['data_gestur_tangan']['gestur_statis'] ?? 0,
                            'Gestur Dinamis' => $statsData['data_gestur_tangan']['gestur_dinamis'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '2. Data Pengguna',
                        'satuan' => 'Jumlah pengguna (orang)',
                        'rows'   => [
                            'Total Pengguna'  => $statsData['data_pengguna']['total_pengguna'] ?? 0,
                            'Pengguna Aktif'  => $statsData['data_pengguna']['pengguna_aktif'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '3. Data Kosakata Bahasa Isyarat',
                        'satuan' => 'Jumlah kata (kata/item)',
                        'rows'   => [
                            'Total Kosakata'   => $statsData['data_kosakata_bahasa_isyarat']['total_kosakata'] ?? 0,
                            'Kosakata BISINDO' => $statsData['data_kosakata_bahasa_isyarat']['kosakata_bisindo'] ?? 0,
                            'Kosakata ASL'     => $statsData['data_kosakata_bahasa_isyarat']['kosakata_asl'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '4. Data Terjemahan Teks',
                        'satuan' => 'Jumlah karakter / kata (string)',
                        'rows'   => [
                            'Total Terjemahan' => $statsData['data_terjemahan_teks']['total_terjemahan'] ?? 0,
                            'Total Karakter'   => $statsData['data_terjemahan_teks']['total_karakter'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '5. Data Audio/Suara',
                        'satuan' => 'Durasi (detik) / Ukuran file (MB)',
                        'rows'   => [
                            'Total File'        => $statsData['data_audio_suara']['total_file'] ?? 0,
                            'Total Durasi (s)'  => $statsData['data_audio_suara']['total_durasi_detik'] ?? 0,
                            'Total Ukuran (MB)' => $statsData['data_audio_suara']['total_ukuran_mb'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '6. Data Kategori Kosakata',
                        'satuan' => 'Jumlah kategori (kategori)',
                        'rows'   => [
                            'Total Kategori' => $statsData['data_kategori_kosakata']['total_kategori'] ?? 0,
                            'Kategori Aktif' => $statsData['data_kategori_kosakata']['kategori_aktif'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '7. Data Riwayat Terjemahan',
                        'satuan' => 'Jumlah sesi (sesi/log)',
                        'rows'   => [
                            'Total Sesi'  => $statsData['data_riwayat_terjemahan']['total_sesi'] ?? 0,
                            'Total Entri' => $statsData['data_riwayat_terjemahan']['total_entri'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '8. Data Model AI/ML',
                        'satuan' => 'Tingkat akurasi (%)',
                        'rows'   => [
                            'Total Model'    => $statsData['data_model_ai_ml']['total_model'] ?? 0,
                            'Model Deployed' => $statsData['data_model_ai_ml']['model_deployed'] ?? 0,
                        ],
                    ],
                    [
                        'title'  => '9. Data Feedback Pengguna',
                        'satuan' => 'Jumlah respons (benar/salah)',
                        'rows'   => [
                            'Total Feedback' => $statsData['data_feedback_pengguna']['total_feedback'] ?? 0,
                            'Respons Benar'  => $statsData['data_feedback_pengguna']['respons_benar'] ?? 0,
                            'Respons Salah'  => $statsData['data_feedback_pengguna']['respons_salah'] ?? 0,
                        ],
                    ],
                ];
            }

            // Fetch all 9 data tables
            $gesturesResp     = $this->apiGet('/gestures', ['per_page' => 50]);
            $vocabulariesResp = $this->apiGet('/vocabularies', ['per_page' => 50]);
            $translationsResp = $this->apiGet('/translations', ['per_page' => 50]);
            $audioResp        = $this->apiGet('/audio', ['per_page' => 50]);
            $categoriesResp   = $this->apiGet('/categories');
            $historyResp      = $this->apiGet('/history', ['per_page' => 50]);
            $modelsResp       = $this->apiGet('/models');
            $feedbacksResp    = $this->apiGet('/feedbacks', ['per_page' => 50]);

            // Fetch users from the web dashboard HTML (no /api/users list endpoint)
            $users = $this->fetchUsersFromDashboard();

            // Parse responses - handle both paginated {data:[...]} and plain [...] formats
            $gestures     = $this->sortById($this->extractData($gesturesResp));
            $vocabularies = $this->sortById($this->extractData($vocabulariesResp));
            $translations = $this->sortById($this->extractData($translationsResp));
            $audioFiles   = $this->sortById($this->extractData($audioResp));
            $categories   = $this->sortById($this->extractData($categoriesResp));
            $histories    = $this->sortById($this->extractData($historyResp));
            $models       = $this->sortById($this->extractData($modelsResp));
            $feedbacks    = $this->sortById($this->extractData($feedbacksResp));
        } catch (\Exception $e) {
            $error = 'API Error: ' . $e->getMessage();
        }

        return view('bisindo_dashboard', compact(
            'error',
            'stats',
            'users',
            'gestures',
            'vocabularies',
            'translations',
            'audioFiles',
            'categories',
            'histories',
            'models',
            'feedbacks'
        ));
    }

    /**
     * Fetch ALL user rows by scraping every page of the web dashboard.
     * The API has no public /api/users list endpoint, so we parse the HTML table (for now).
     */
    private function fetchUsersFromDashboard(): array
    {
        try {
            // Try multiple possible dashboard URLs to find the one that serves the HTML with users table
            $paths = ['/', '/public', '/public/dashboard', '/dashboard', '/public/index.php'];

            foreach ($paths as $path) {
                $url = $this->webUrl . $path;
                $response = Http::withHeaders([
                    'ngrok-skip-browser-warning' => '69420',
                ])
                    ->connectTimeout(15)
                    ->timeout(15)
                    ->get($url, ['users_page' => 1]);

                Log::info("fetchUsers: trying {$path} => status=" . $response->status() . ', body length=' . strlen($response->body()));

                if ($response->successful()) {
                    $html = $response->body();
                    $hasUsersTable = strpos($html, 'id="sub-users"') !== false;
                    Log::info("fetchUsers: {$path} => contains sub-users=" . ($hasUsersTable ? 'YES' : 'NO'));

                    if ($hasUsersTable) {
                        Log::info("fetchUsers: found dashboard at {$path}");
                        $users = $this->parseUsersTable($html);
                        usort($users, fn($a, $b) => ((int) $a['id']) <=> ((int) $b['id']));
                        return $users;
                    }
                }
            }

            Log::warning('fetchUsers: could not find dashboard with users table at any path');
            return [];
        } catch (\Exception $e) {
            Log::error('fetchUsers exception: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Parse user rows from the dashboard HTML.
     */
    private function parseUsersTable(string $html): array
    {
        $usersStart = strpos($html, 'id="sub-users"');
        if ($usersStart === false) {
            return [];
        }

        $tableStart = strpos($html, '<tbody>', $usersStart);
        $tableEnd = strpos($html, '</tbody>', $tableStart);
        if ($tableStart === false || $tableEnd === false) {
            return [];
        }

        $tbody = substr($html, $tableStart, $tableEnd - $tableStart + 8);

        $users = [];
        preg_match_all('/<tr>(.*?)<\/tr>/s', $tbody, $rows);

        foreach ($rows[1] as $row) {
            preg_match_all('/<td[^>]*>(.*?)<\/td>/s', $row, $cells);
            $values = array_map(function ($cell) {
                return trim(strip_tags($cell));
            }, $cells[1] ?? []);

            if (count($values) >= 9) {
                $users[] = [
                    'id'                => $values[0],
                    'name'              => $values[1],
                    'email'             => $values[2],
                    'role'              => $values[3],
                    'preferred_language' => $values[4],
                    'is_active'         => strtolower($values[5]) === 'yes',
                    'histories_count'   => $values[6],
                    'feedbacks_count'   => $values[7],
                    'created_at'        => $values[8],
                ];
            }
        }

        return $users;
    }

    /**
     * Helper: make a POST request to the ngrok API.
     */
    private function apiPost(string $endpoint, array $data = [])
    {
        return Http::withHeaders([
            'ngrok-skip-browser-warning' => '69420',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->connectTimeout(30)
            ->timeout(30)
            ->post($this->baseUrl . $endpoint, $data);
    }

    /**
     * Handle form submissions -- POST data to the remote API.
     */
    public function store(Request $request)
    {
        $type = $request->input('_form_type');
        $response = null;
        $endpoint = '';

        switch ($type) {
            case 'gestures':
                $endpoint = '/gestures';
                $data = [
                    'vocabulary_id'    => (int) $request->input('vocabulary_id'),
                    'landmarks'        => json_decode($request->input('landmarks', '[]'), true),
                    'hand'             => $request->input('hand', 'both'),
                    'gesture_type'     => $request->input('gesture_type', 'static'),
                    'frame_count'      => (int) $request->input('frame_count', 1),
                    'confidence_score' => $request->input('confidence_score') ? (float) $request->input('confidence_score') : null,
                    'source_dataset'   => $request->input('source_dataset'),
                    'contributor_id'   => $request->input('contributor_id'),
                ];
                break;

            case 'users':
                $endpoint = '/register';
                $data = [
                    'name'                  => $request->input('name'),
                    'email'                 => $request->input('email'),
                    'password'              => $request->input('password'),
                    'password_confirmation' => $request->input('password_confirmation'),
                    'role'                  => $request->input('role', 'user'),
                    'preferred_language'    => $request->input('preferred_language', 'bisindo'),
                ];
                break;

            case 'vocabularies':
                $endpoint = '/vocabularies';
                $data = [
                    'category_id'  => (int) $request->input('category_id'),
                    'word'         => $request->input('word'),
                    'description'  => $request->input('description'),
                    'language'     => $request->input('language', 'bisindo'),
                    'type'         => $request->input('vocab_type', 'alphabet'),
                    'is_active'    => $request->boolean('is_active', true),
                ];
                break;

            case 'translations':
                $endpoint = '/translations';
                $data = [
                    'vocabulary_id'   => (int) $request->input('vocabulary_id'),
                    'source_language' => $request->input('source_language', 'id'),
                    'target_language' => $request->input('target_language', 'en'),
                    'source_text'     => $request->input('source_text'),
                    'translated_text' => $request->input('translated_text'),
                ];
                break;

            case 'audio':
                $endpoint = '/audio';
                // Audio requires file upload -- use multipart
                $http = Http::withHeaders([
                    'ngrok-skip-browser-warning' => '69420',
                    'Accept' => 'application/json',
                ])
                    ->connectTimeout(30)
                    ->timeout(30);

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $http = $http->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName());
                }

                $formData = [
                    'vocabulary_id' => $request->input('vocabulary_id'),
                    'language'      => $request->input('language', 'id'),
                    'transcript'    => $request->input('transcript'),
                    'type'          => $request->input('audio_type', 'reference'),
                ];

                $response = $http->post($this->baseUrl . $endpoint, $formData);

                return redirect()->route('bisindo.dashboard')
                    ->with(
                        $response && $response->successful() ? 'success' : 'error',
                        $response && $response->successful()
                            ? 'Audio berhasil ditambahkan!'
                            : 'Gagal: ' . ($response ? $response->body() : 'No response')
                    );

            case 'categories':
                $endpoint = '/categories';
                $data = [
                    'name'        => $request->input('name'),
                    'slug'        => $request->input('slug'),
                    'description' => $request->input('description'),
                    'language'    => $request->input('language', 'bisindo'),
                    'sort_order'  => (int) $request->input('sort_order', 0),
                    'is_active'   => $request->boolean('is_active', true),
                ];
                break;

            case 'history':
                $endpoint = '/history';
                $data = [
                    'user_id'          => $request->input('user_id') ? (int) $request->input('user_id') : null,
                    'session_id'       => $request->input('session_id'),
                    'direction'        => $request->input('direction'),
                    'input_data'       => $request->input('input_data'),
                    'output_data'      => $request->input('output_data'),
                    'input_language'   => $request->input('input_language'),
                    'output_language'  => $request->input('output_language'),
                    'confidence_score' => $request->input('confidence_score') ? (float) $request->input('confidence_score') : null,
                    'duration_seconds' => $request->input('duration_seconds') ? (float) $request->input('duration_seconds') : null,
                    'is_correct'       => $request->has('is_correct') ? $request->boolean('is_correct') : null,
                ];
                break;

            case 'models':
                $endpoint = '/models';
                $data = [
                    'name'               => $request->input('name'),
                    'version'            => $request->input('version'),
                    'type'               => $request->input('model_type'),
                    'language'           => $request->input('language'),
                    'accuracy_percent'   => $request->input('accuracy_percent') ? (float) $request->input('accuracy_percent') : null,
                    'num_classes'        => $request->input('num_classes') ? (int) $request->input('num_classes') : null,
                    'training_samples'   => $request->input('training_samples') ? (int) $request->input('training_samples') : null,
                    'validation_samples' => $request->input('validation_samples') ? (int) $request->input('validation_samples') : null,
                    'status'             => $request->input('status', 'training'),
                    'is_active'          => $request->boolean('is_active', false),
                    'notes'              => $request->input('notes'),
                ];
                break;

            case 'feedbacks':
                $endpoint = '/feedbacks';
                $data = [
                    'user_id'                => $request->input('user_id') ? (int) $request->input('user_id') : null,
                    'translation_history_id' => $request->input('translation_history_id') ? (int) $request->input('translation_history_id') : null,
                    'ai_model_id'            => $request->input('ai_model_id') ? (int) $request->input('ai_model_id') : null,
                    'type'                   => $request->input('feedback_type'),
                    'is_correct'             => $request->has('is_correct') ? $request->boolean('is_correct') : null,
                    'expected_output'        => $request->input('expected_output'),
                    'rating'                 => $request->input('rating') ? (int) $request->input('rating') : null,
                    'comment'                => $request->input('comment'),
                ];
                break;

            default:
                return redirect()->route('bisindo.dashboard')->with('error', 'Form type tidak dikenali.');
        }

        $response = $this->apiPost($endpoint, $data);

        $labels = [
            'gestures' => 'Gestur',
            'users' => 'Pengguna',
            'vocabularies' => 'Kosakata',
            'translations' => 'Terjemahan',
            'audio' => 'Audio',
            'categories' => 'Kategori',
            'history' => 'Riwayat',
            'models' => 'Model AI',
            'feedbacks' => 'Feedback',
        ];
        $label = $labels[$type] ?? $type;

        if ($response->successful()) {
            return redirect()->route('bisindo.dashboard', ['#forms/' . $type])
                ->with('success', $label . ' berhasil ditambahkan!');
        }

        return redirect()->route('bisindo.dashboard', ['#forms/' . $type])
            ->with('error', 'Gagal menambahkan ' . $label . ': ' . $response->body());
    }

    /**
     * Sort data array by 'id' ascending.
     */
    private function sortById(array $data): array
    {
        usort($data, function ($a, $b) {
            return ($a['id'] ?? 0) <=> ($b['id'] ?? 0);
        });
        return $data;
    }

    /**
     * Extract data array from API response (handles paginated and non-paginated).
     */
    private function extractData($response): array
    {
        if (!$response->successful()) {
            return [];
        }

        $json = $response->json();

        // Paginated response: { "data": [...], "links": ..., "meta": ... }
        if (isset($json['data']) && is_array($json['data'])) {
            return $json['data'];
        }

        // Plain array response
        if (is_array($json) && !isset($json['data'])) {
            return $json;
        }

        return [];
    }
}
