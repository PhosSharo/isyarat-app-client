<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BISINDO Client Dashboard &mdash; PCT-PCS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #FFFDF7;
            --fg: #1a1a1a;
            --border: #1a1a1a;
            --border-w: 3px;
            --shadow: 5px 5px 0 #1a1a1a;
            --shadow-sm: 3px 3px 0 #1a1a1a;
            --radius: 0;

            /* Neo-Brutalism accent palette */
            --yellow: #FFE156;
            --pink: #FF6B9D;
            --blue: #7EB6FF;
            --green: #A8E6A3;
            --orange: #FFB067;
            --purple: #C4A1FF;
            --red: #FF6B6B;
            --cyan: #6FEDD6;

            --font-display: 'Syne', sans-serif;
            --font-mono: 'Space Mono', monospace;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-mono);
            background: var(--bg);
            color: var(--fg);
            padding: 28px;
            max-width: 1440px;
            margin: 0 auto;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── Header ── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: var(--border-w) solid var(--border);
            background: var(--yellow);
            padding: 16px 24px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
        }

        .header h1 {
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header .tag {
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border: 2px solid var(--border);
            background: #fff;
        }

        /* ── Error banner ── */
        .error-banner {
            border: var(--border-w) solid var(--border);
            background: var(--red);
            color: #fff;
            padding: 14px 20px;
            font-weight: 700;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* ── Main tabs ── */
        .main-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 0;
        }

        .main-tab {
            padding: 12px 28px;
            border: var(--border-w) solid var(--border);
            border-bottom: none;
            background: #fff;
            color: var(--fg);
            font-family: var(--font-display);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.1s;
        }

        .main-tab:hover:not(.active) {
            background: var(--yellow);
        }

        .main-tab.active {
            background: var(--fg);
            color: #fff;
            position: relative;
            z-index: 2;
        }

        .main-panel {
            display: none;
            border: var(--border-w) solid var(--border);
            border-top: none;
            padding: 24px;
            background: #fff;
            box-shadow: var(--shadow);
        }

        .main-panel.active {
            display: block;
        }

        /* ── Sub tabs (data tables) ── */
        .sub-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }

        .sub-tab {
            padding: 6px 14px;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--fg);
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-sm);
            transition: all 0.1s;
        }

        .sub-tab:hover:not(.active) {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 var(--border);
        }

        .sub-tab.active {
            background: var(--fg);
            color: #fff;
            transform: translate(3px, 3px);
            box-shadow: none;
        }

        .sub-panel {
            display: none;
        }

        .sub-panel.active {
            display: block;
        }

        /* ── Stats cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 14px;
            margin-bottom: 28px;
        }

        .stat-card {
            border: var(--border-w) solid var(--border);
            padding: 16px;
            box-shadow: var(--shadow-sm);
            transition: transform 0.1s, box-shadow 0.1s;
        }

        .stat-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0 var(--border);
        }

        .stat-card:nth-child(9n+1) {
            background: var(--yellow);
        }

        .stat-card:nth-child(9n+2) {
            background: var(--pink);
        }

        .stat-card:nth-child(9n+3) {
            background: var(--blue);
        }

        .stat-card:nth-child(9n+4) {
            background: var(--green);
        }

        .stat-card:nth-child(9n+5) {
            background: var(--orange);
        }

        .stat-card:nth-child(9n+6) {
            background: var(--purple);
        }

        .stat-card:nth-child(9n+7) {
            background: var(--cyan);
        }

        .stat-card:nth-child(9n+8) {
            background: #FFD6E0;
        }

        .stat-card:nth-child(9n+9) {
            background: #D4F0FF;
        }

        .stat-card h3 {
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .stat-row .label {
            opacity: 0.7;
        }

        .stat-row .value {
            font-weight: 700;
        }

        .stat-card .unit {
            font-size: 10px;
            opacity: 0.6;
            margin-top: 8px;
            text-align: right;
            font-style: italic;
        }

        /* ── Section ── */
        .section {
            margin-bottom: 28px;
        }

        .section h2 {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 14px;
            background: var(--yellow);
            border: 2px solid var(--border);
            display: inline-block;
            box-shadow: var(--shadow-sm);
            margin-bottom: 12px;
        }

        .section-meta {
            font-size: 11px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 2px;
        }

        /* ── Tables ── */
        .table-wrap {
            overflow-x: auto;
            border: var(--border-w) solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        thead {
            background: var(--fg);
            color: #fff;
        }

        th {
            padding: 8px 12px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            white-space: nowrap;
            font-family: var(--font-display);
        }

        td {
            padding: 6px 12px;
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        tr:nth-child(even) td {
            background: #FAFAF5;
        }

        tr:hover td {
            background: var(--yellow) !important;
        }

        .empty-msg {
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #999;
            border: 2px dashed var(--border);
            background: #FAFAF5;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border: 2px solid var(--border);
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .badge-active {
            background: var(--green);
        }

        .badge-deployed {
            background: var(--green);
        }

        .badge-training {
            background: var(--orange);
        }

        .badge-ready {
            background: var(--blue);
        }

        .badge-archived {
            background: #ddd;
        }

        .bool-t {
            font-weight: 700;
            color: #1a7a1a;
        }

        .bool-f {
            color: #999;
        }

        /* ── Raw JSON panel ── */
        .json-toggle {
            padding: 6px 14px;
            border: 2px solid var(--border);
            background: var(--cyan);
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            box-shadow: var(--shadow-sm);
            margin-bottom: 12px;
            transition: all 0.1s;
        }

        .json-toggle:hover {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 var(--border);
        }

        .json-panel {
            display: none;
            border: var(--border-w) solid var(--border);
            background: var(--fg);
            color: var(--green);
            padding: 16px;
            font-size: 11px;
            line-height: 1.6;
            overflow-x: auto;
            white-space: pre;
            font-family: var(--font-mono);
            box-shadow: var(--shadow-sm);
            margin-bottom: 16px;
            max-height: 400px;
            overflow-y: auto;
        }

        .json-panel.active {
            display: block;
        }

        /* ── Forms ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }
        .form-grid.single-col { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; gap: 4px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label {
            font-family: var(--font-display);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 8px 12px;
            border: 2px solid var(--border);
            font-family: var(--font-mono);
            font-size: 12px;
            background: #fff;
            outline: none;
            transition: box-shadow 0.1s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            box-shadow: var(--shadow-sm);
        }
        .form-group textarea { resize: vertical; min-height: 60px; }
        .form-group .hint {
            font-size: 9px;
            color: #888;
            font-style: italic;
        }
        .form-submit {
            padding: 10px 24px;
            border: var(--border-w) solid var(--border);
            background: var(--green);
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.1s;
            margin-top: 8px;
        }
        .form-submit:hover {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0 var(--border);
        }
        .form-submit:active {
            transform: translate(3px, 3px);
            box-shadow: none;
        }

        /* ── Flash messages ── */
        .flash-success {
            border: var(--border-w) solid var(--border);
            background: var(--green);
            padding: 12px 20px;
            font-weight: 700;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            font-size: 13px;
        }
        .flash-error {
            border: var(--border-w) solid var(--border);
            background: var(--red);
            color: #fff;
            padding: 12px 20px;
            font-weight: 700;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* ── Form sub tabs ── */
        .form-sub-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }
        .form-sub-tab {
            padding: 6px 14px;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--fg);
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-sm);
            transition: all 0.1s;
        }
        .form-sub-tab:hover:not(.active) {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 var(--border);
        }
        .form-sub-tab.active {
            background: var(--fg);
            color: #fff;
            transform: translate(3px, 3px);
            box-shadow: none;
        }
        .form-panel { display: none; }
        .form-panel.active { display: block; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            .header {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }

            .header h1 {
                font-size: 20px;
            }

            .main-tab {
                padding: 10px 16px;
                font-size: 12px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Isyarat App &mdash; Client</h1>
        <span class="tag">HTTP Client via ngrok</span>
    </div>

    @if (isset($error) && $error)
        <div class="error-banner">{{ $error }}</div>
    @endif

    @if (session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="flash-error">{{ session('error') }}</div>
    @endif

    {{-- ================================================================ --}}
    {{-- MAIN TABS --}}
    {{-- ================================================================ --}}
    <div class="main-tabs">
        <button class="main-tab active" onclick="mainTab('overview')">Overview</button>
        <button class="main-tab" onclick="mainTab('data')">Data Tables</button>
        <button class="main-tab" onclick="mainTab('forms')">Add Data</button>
    </div>

    {{-- ================================================================ --}}
    {{-- PANEL: OVERVIEW (Stats Cards) --}}
    {{-- ================================================================ --}}
    <div class="main-panel active" id="panel-overview">
        @if (empty($stats))
            <div class="empty-msg">Tidak dapat memuat statistik dari server.</div>
        @else
            <div class="stats-grid">
                @foreach ($stats as $stat)
                    <div class="stat-card">
                        <h3>{{ $stat['title'] }}</h3>
                        @foreach ($stat['rows'] as $label => $value)
                            <div class="stat-row">
                                <span class="label">{{ $label }}</span>
                                <span class="value">{{ $value }}</span>
                            </div>
                        @endforeach
                        <div class="unit">Satuan: {{ $stat['satuan'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ================================================================ --}}
    {{-- PANEL: DATA TABLES --}}
    {{-- ================================================================ --}}
    <div class="main-panel" id="panel-data">

        {{-- Sub tabs for 9 data tables --}}
        <div class="sub-tabs">
            <button class="sub-tab active" onclick="subTab('gestures')">1. Gestur</button>
            <button class="sub-tab" onclick="subTab('users')">2. Pengguna</button>
            <button class="sub-tab" onclick="subTab('vocabularies')">3. Kosakata</button>
            <button class="sub-tab" onclick="subTab('translations')">4. Terjemahan</button>
            <button class="sub-tab" onclick="subTab('audio')">5. Audio</button>
            <button class="sub-tab" onclick="subTab('categories')">6. Kategori</button>
            <button class="sub-tab" onclick="subTab('history')">7. Riwayat</button>
            <button class="sub-tab" onclick="subTab('models')">8. Model AI</button>
            <button class="sub-tab" onclick="subTab('feedbacks')">9. Feedback</button>
        </div>

        {{-- 1. Gestur Tangan --}}
        <div class="sub-panel active" id="sub-gestures">
            <div class="section">
                <h2>1. Data Gestur Tangan</h2>
                <div class="section-meta">Satuan: Jumlah gestur (buah/item)</div>
                <button class="json-toggle" onclick="toggleJson('json-gestures')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-gestures">{{ json_encode($gestures, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($gestures))
                    <div class="empty-msg">Tidak ada data gestur.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vocabulary</th>
                                    <th>Hand</th>
                                    <th>Type</th>
                                    <th>Frames</th>
                                    <th>Confidence</th>
                                    <th>Dataset</th>
                                    <th>Contributor</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gestures as $g)
                                    <tr>
                                        <td>{{ $g['id'] ?? '-' }}</td>
                                        <td>{{ $g['vocabulary']['word'] ?? $g['vocabulary_id'] ?? '-' }}</td>
                                        <td>{{ $g['hand'] ?? '-' }}</td>
                                        <td>{{ $g['gesture_type'] ?? '-' }}</td>
                                        <td>{{ $g['frame_count'] ?? '-' }}</td>
                                        <td>{{ isset($g['confidence_score']) ? number_format($g['confidence_score'], 3) : '-' }}
                                        </td>
                                        <td>{{ $g['source_dataset'] ?? '-' }}</td>
                                        <td>{{ $g['contributor_id'] ?? '-' }}</td>
                                        <td>{{ isset($g['created_at']) ? \Illuminate\Support\Carbon::parse($g['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 2. Pengguna --}}
        <div class="sub-panel" id="sub-users">
            <div class="section">
                <h2>2. Data Pengguna</h2>
                <div class="section-meta">Satuan: Jumlah pengguna (orang)</div>
                <button class="json-toggle" onclick="toggleJson('json-users')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-users">{{ json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($users))
                    <div class="empty-msg">Tidak ada data pengguna.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Language</th>
                                    <th>Active</th>
                                    <th>Histories</th>
                                    <th>Feedbacks</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr>
                                        <td>{{ $u['id'] ?? '-' }}</td>
                                        <td>{{ $u['name'] ?? '-' }}</td>
                                        <td>{{ $u['email'] ?? '-' }}</td>
                                        <td>{{ $u['role'] ?? '-' }}</td>
                                        <td>{{ $u['preferred_language'] ?? '-' }}</td>
                                        <td>{!! isset($u['is_active']) && $u['is_active'] ? '<span class="bool-t">Yes</span>' : '<span class="bool-f">No</span>' !!}
                                        </td>
                                        <td>{{ $u['histories_count'] ?? '-' }}</td>
                                        <td>{{ $u['feedbacks_count'] ?? '-' }}</td>
                                        <td>{{ $u['created_at'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 3. Kosakata --}}
        <div class="sub-panel" id="sub-vocabularies">
            <div class="section">
                <h2>3. Data Kosakata Bahasa Isyarat</h2>
                <div class="section-meta">Satuan: Jumlah kata (kata/item)</div>
                <button class="json-toggle" onclick="toggleJson('json-vocabularies')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-vocabularies">{{ json_encode($vocabularies, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($vocabularies))
                    <div class="empty-msg">Tidak ada data kosakata.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Word</th>
                                    <th>Language</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Words</th>
                                    <th>Chars</th>
                                    <th>Gestures</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vocabularies as $v)
                                    <tr>
                                        <td>{{ $v['id'] ?? '-' }}</td>
                                        <td>{{ $v['word'] ?? '-' }}</td>
                                        <td>{{ $v['language'] ?? '-' }}</td>
                                        <td>{{ $v['type'] ?? '-' }}</td>
                                        <td>{{ $v['category']['name'] ?? $v['category_id'] ?? '-' }}</td>
                                        <td>{{ $v['word_count'] ?? '-' }}</td>
                                        <td>{{ $v['character_count'] ?? '-' }}</td>
                                        <td>{{ $v['gestures_count'] ?? '-' }}</td>
                                        <td>{!! isset($v['is_active']) && $v['is_active'] ? '<span class="bool-t">Yes</span>' : '<span class="bool-f">No</span>' !!}
                                        </td>
                                        <td>{{ isset($v['created_at']) ? \Illuminate\Support\Carbon::parse($v['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 4. Terjemahan --}}
        <div class="sub-panel" id="sub-translations">
            <div class="section">
                <h2>4. Data Terjemahan Teks</h2>
                <div class="section-meta">Satuan: Jumlah karakter / kata (string)</div>
                <button class="json-toggle" onclick="toggleJson('json-translations')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-translations">{{ json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($translations))
                    <div class="empty-msg">Tidak ada data terjemahan.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vocabulary</th>
                                    <th>Src Lang</th>
                                    <th>Tgt Lang</th>
                                    <th>Source Text</th>
                                    <th>Translated</th>
                                    <th>Chars</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($translations as $t)
                                    <tr>
                                        <td>{{ $t['id'] ?? '-' }}</td>
                                        <td>{{ $t['vocabulary']['word'] ?? $t['vocabulary_id'] ?? '-' }}</td>
                                        <td>{{ $t['source_language'] ?? '-' }}</td>
                                        <td>{{ $t['target_language'] ?? '-' }}</td>
                                        <td title="{{ $t['source_text'] ?? '' }}">{{ Str::limit($t['source_text'] ?? '-', 50) }}
                                        </td>
                                        <td title="{{ $t['translated_text'] ?? '' }}">
                                            {{ Str::limit($t['translated_text'] ?? '-', 50) }}</td>
                                        <td>{{ $t['character_count'] ?? '-' }}</td>
                                        <td>{{ isset($t['created_at']) ? \Illuminate\Support\Carbon::parse($t['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 5. Audio --}}
        <div class="sub-panel" id="sub-audio">
            <div class="section">
                <h2>5. Data Audio/Suara</h2>
                <div class="section-meta">Satuan: Durasi (detik) / Ukuran file (MB)</div>
                <button class="json-toggle" onclick="toggleJson('json-audio')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-audio">{{ json_encode($audioFiles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($audioFiles))
                    <div class="empty-msg">Tidak ada data audio.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vocabulary</th>
                                    <th>File</th>
                                    <th>MIME</th>
                                    <th>Duration (s)</th>
                                    <th>Size (MB)</th>
                                    <th>Lang</th>
                                    <th>Type</th>
                                    <th>Transcript</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audioFiles as $a)
                                    <tr>
                                        <td>{{ $a['id'] ?? '-' }}</td>
                                        <td>{{ $a['vocabulary']['word'] ?? $a['vocabulary_id'] ?? '-' }}</td>
                                        <td title="{{ $a['file_path'] ?? '' }}">{{ Str::limit($a['file_path'] ?? '-', 40) }}
                                        </td>
                                        <td>{{ $a['mime_type'] ?? '-' }}</td>
                                        <td>{{ isset($a['duration_seconds']) ? number_format($a['duration_seconds'], 2) : '-' }}
                                        </td>
                                        <td>{{ isset($a['file_size_mb']) ? number_format($a['file_size_mb'], 4) : '-' }}</td>
                                        <td>{{ $a['language'] ?? '-' }}</td>
                                        <td>{{ $a['type'] ?? '-' }}</td>
                                        <td title="{{ $a['transcript'] ?? '' }}">{{ Str::limit($a['transcript'] ?? '-', 40) }}
                                        </td>
                                        <td>{{ isset($a['created_at']) ? \Illuminate\Support\Carbon::parse($a['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 6. Kategori --}}
        <div class="sub-panel" id="sub-categories">
            <div class="section">
                <h2>6. Data Kategori Kosakata</h2>
                <div class="section-meta">Satuan: Jumlah kategori (kategori)</div>
                <button class="json-toggle" onclick="toggleJson('json-categories')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-categories">{{ json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($categories))
                    <div class="empty-msg">Tidak ada data kategori.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Language</th>
                                    <th>Sort</th>
                                    <th>Vocabularies</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr>
                                        <td>{{ $c['id'] ?? '-' }}</td>
                                        <td>{{ $c['name'] ?? '-' }}</td>
                                        <td>{{ $c['slug'] ?? '-' }}</td>
                                        <td title="{{ $c['description'] ?? '' }}">{{ Str::limit($c['description'] ?? '-', 50) }}
                                        </td>
                                        <td>{{ $c['language'] ?? '-' }}</td>
                                        <td>{{ $c['sort_order'] ?? '-' }}</td>
                                        <td>{{ $c['vocabularies_count'] ?? '-' }}</td>
                                        <td>{!! isset($c['is_active']) && $c['is_active'] ? '<span class="bool-t">Yes</span>' : '<span class="bool-f">No</span>' !!}
                                        </td>
                                        <td>{{ isset($c['created_at']) ? \Illuminate\Support\Carbon::parse($c['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 7. Riwayat --}}
        <div class="sub-panel" id="sub-history">
            <div class="section">
                <h2>7. Data Riwayat Terjemahan</h2>
                <div class="section-meta">Satuan: Jumlah sesi (sesi/log)</div>
                <button class="json-toggle" onclick="toggleJson('json-history')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-history">{{ json_encode($histories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($histories))
                    <div class="empty-msg">Tidak ada data riwayat.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Session</th>
                                    <th>Direction</th>
                                    <th>Input</th>
                                    <th>Output</th>
                                    <th>In Lang</th>
                                    <th>Out Lang</th>
                                    <th>Confidence</th>
                                    <th>Duration</th>
                                    <th>Correct</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $h)
                                    <tr>
                                        <td>{{ $h['id'] ?? '-' }}</td>
                                        <td>{{ $h['user_id'] ?? '-' }}</td>
                                        <td title="{{ $h['session_id'] ?? '' }}">{{ Str::limit($h['session_id'] ?? '-', 20) }}
                                        </td>
                                        <td>{{ $h['direction'] ?? '-' }}</td>
                                        <td title="{{ $h['input_data'] ?? '' }}">{{ Str::limit($h['input_data'] ?? '-', 30) }}
                                        </td>
                                        <td title="{{ $h['output_data'] ?? '' }}">{{ Str::limit($h['output_data'] ?? '-', 30) }}
                                        </td>
                                        <td>{{ $h['input_language'] ?? '-' }}</td>
                                        <td>{{ $h['output_language'] ?? '-' }}</td>
                                        <td>{{ isset($h['confidence_score']) ? number_format($h['confidence_score'], 3) : '-' }}
                                        </td>
                                        <td>{{ isset($h['duration_seconds']) ? number_format($h['duration_seconds'], 2) : '-' }}
                                        </td>
                                        <td>
                                            @if (isset($h['is_correct']) && $h['is_correct'] === true) <span
                                                class="bool-t">Yes</span>
                                            @elseif (isset($h['is_correct']) && $h['is_correct'] === false) <span
                                                class="bool-f">No</span>
                                            @else <span class="bool-f">-</span>
                                            @endif
                                        </td>
                                        <td>{{ isset($h['created_at']) ? \Illuminate\Support\Carbon::parse($h['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 8. Model AI --}}
        <div class="sub-panel" id="sub-models">
            <div class="section">
                <h2>8. Data Model AI/ML</h2>
                <div class="section-meta">Satuan: Tingkat akurasi (%)</div>
                <button class="json-toggle" onclick="toggleJson('json-models')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-models">{{ json_encode($models, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($models))
                    <div class="empty-msg">Tidak ada data model.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Ver</th>
                                    <th>Type</th>
                                    <th>Lang</th>
                                    <th>Accuracy</th>
                                    <th>Classes</th>
                                    <th>Train</th>
                                    <th>Val</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Active</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $m)
                                    <tr>
                                        <td>{{ $m['id'] ?? '-' }}</td>
                                        <td>{{ $m['name'] ?? '-' }}</td>
                                        <td>{{ $m['version'] ?? '-' }}</td>
                                        <td>{{ $m['type'] ?? '-' }}</td>
                                        <td>{{ $m['language'] ?? '-' }}</td>
                                        <td>{{ isset($m['accuracy_percent']) ? number_format($m['accuracy_percent'], 2) . '%' : '-' }}
                                        </td>
                                        <td>{{ $m['num_classes'] ?? '-' }}</td>
                                        <td>{{ $m['training_samples'] ?? '-' }}</td>
                                        <td>{{ $m['validation_samples'] ?? '-' }}</td>
                                        <td>{{ isset($m['file_size_mb']) ? number_format($m['file_size_mb'], 2) : '-' }}</td>
                                        <td>
                                            @php $status = $m['status'] ?? 'unknown'; @endphp
                                            <span class="badge badge-{{ $status }}">{{ $status }}</span>
                                        </td>
                                        <td>{!! isset($m['is_active']) && $m['is_active'] ? '<span class="bool-t">Yes</span>' : '<span class="bool-f">No</span>' !!}
                                        </td>
                                        <td>{{ isset($m['created_at']) ? \Illuminate\Support\Carbon::parse($m['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- 9. Feedback --}}
        <div class="sub-panel" id="sub-feedbacks">
            <div class="section">
                <h2>9. Data Feedback Pengguna</h2>
                <div class="section-meta">Satuan: Jumlah respons (benar/salah)</div>
                <button class="json-toggle" onclick="toggleJson('json-feedbacks')">Toggle Raw JSON</button>
                <pre class="json-panel"
                    id="json-feedbacks">{{ json_encode($feedbacks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @if (empty($feedbacks))
                    <div class="empty-msg">Tidak ada data feedback.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>History</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th>Correct</th>
                                    <th>Expected</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $f)
                                    <tr>
                                        <td>{{ $f['id'] ?? '-' }}</td>
                                        <td>{{ $f['user_id'] ?? '-' }}</td>
                                        <td>{{ $f['translation_history_id'] ?? '-' }}</td>
                                        <td>{{ $f['ai_model_id'] ?? '-' }}</td>
                                        <td>{{ $f['type'] ?? '-' }}</td>
                                        <td>
                                            @if (isset($f['is_correct']) && $f['is_correct'] === true) <span
                                                class="bool-t">Benar</span>
                                            @elseif (isset($f['is_correct']) && $f['is_correct'] === false) <span
                                                class="bool-f">Salah</span>
                                            @else <span class="bool-f">-</span>
                                            @endif
                                        </td>
                                        <td title="{{ $f['expected_output'] ?? '' }}">
                                            {{ Str::limit($f['expected_output'] ?? '-', 30) }}</td>
                                        <td>{{ isset($f['rating']) ? $f['rating'] . '/5' : '-' }}</td>
                                        <td title="{{ $f['comment'] ?? '' }}">{{ Str::limit($f['comment'] ?? '-', 40) }}</td>
                                        <td>{{ isset($f['created_at']) ? \Illuminate\Support\Carbon::parse($f['created_at'])->format('d/m/Y H:i') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>{{-- /panel-data --}}

{{-- ================================================================ --}}
{{-- PANEL: ADD DATA (9 Forms)                                        --}}
{{-- ================================================================ --}}
<div class="main-panel" id="panel-forms">

    <div class="form-sub-tabs">
        <button class="form-sub-tab active" onclick="formTab('f-gestures')">1. Gestur</button>
        <button class="form-sub-tab" onclick="formTab('f-users')">2. Pengguna</button>
        <button class="form-sub-tab" onclick="formTab('f-vocabularies')">3. Kosakata</button>
        <button class="form-sub-tab" onclick="formTab('f-translations')">4. Terjemahan</button>
        <button class="form-sub-tab" onclick="formTab('f-audio')">5. Audio</button>
        <button class="form-sub-tab" onclick="formTab('f-categories')">6. Kategori</button>
        <button class="form-sub-tab" onclick="formTab('f-history')">7. Riwayat</button>
        <button class="form-sub-tab" onclick="formTab('f-models')">8. Model AI</button>
        <button class="form-sub-tab" onclick="formTab('f-feedbacks')">9. Feedback</button>
    </div>

    {{-- Form 1: Gestur --}}
    <div class="form-panel active" id="f-gestures">
        <div class="section">
            <h2>POST /api/gestures</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="gestures">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Vocabulary ID *</label>
                        <input type="number" name="vocabulary_id" required min="1">
                    </div>
                    <div class="form-group">
                        <label>Hand</label>
                        <select name="hand">
                            <option value="both">Both</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gesture Type</label>
                        <select name="gesture_type">
                            <option value="static">Static</option>
                            <option value="dynamic">Dynamic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Frame Count</label>
                        <input type="number" name="frame_count" value="1" min="1">
                    </div>
                    <div class="form-group">
                        <label>Confidence Score</label>
                        <input type="number" name="confidence_score" step="0.001" min="0" max="1" placeholder="0.0 - 1.0">
                    </div>
                    <div class="form-group">
                        <label>Source Dataset</label>
                        <input type="text" name="source_dataset" placeholder="e.g. bisindo-v1">
                    </div>
                    <div class="form-group">
                        <label>Contributor ID</label>
                        <input type="text" name="contributor_id" placeholder="e.g. user-001">
                    </div>
                    <div class="form-group full">
                        <label>Landmarks (JSON) *</label>
                        <textarea name="landmarks" required placeholder='[[0.5, 0.3, 0.0], [0.6, 0.4, 0.1], ...]'>[[0.5, 0.3, 0.0], [0.6, 0.4, 0.1]]</textarea>
                        <span class="hint">MediaPipe 21-point hand landmarks as JSON array</span>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Gestur</button>
            </form>
        </div>
    </div>

    {{-- Form 2: Pengguna (Register) --}}
    <div class="form-panel" id="f-users">
        <div class="section">
            <h2>POST /api/register</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="users">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" required placeholder="John Doe">
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" required placeholder="john@example.com">
                    </div>
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="password" name="password" required placeholder="min 8 chars">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password *</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="researcher">Researcher</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Preferred Language</label>
                        <select name="preferred_language">
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="form-submit">Register Pengguna</button>
            </form>
        </div>
    </div>

    {{-- Form 3: Kosakata --}}
    <div class="form-panel" id="f-vocabularies">
        <div class="section">
            <h2>POST /api/vocabularies</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="vocabularies">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Category ID *</label>
                        <input type="number" name="category_id" required min="1">
                    </div>
                    <div class="form-group">
                        <label>Word *</label>
                        <input type="text" name="word" required placeholder="e.g. A">
                    </div>
                    <div class="form-group">
                        <label>Language *</label>
                        <select name="language">
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type *</label>
                        <select name="vocab_type">
                            <option value="alphabet">Alphabet</option>
                            <option value="number">Number</option>
                            <option value="word">Word</option>
                            <option value="phrase">Phrase</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" placeholder="Huruf A dalam BISINDO"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select name="is_active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Kosakata</button>
            </form>
        </div>
    </div>

    {{-- Form 4: Terjemahan --}}
    <div class="form-panel" id="f-translations">
        <div class="section">
            <h2>POST /api/translations</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="translations">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Vocabulary ID *</label>
                        <input type="number" name="vocabulary_id" required min="1">
                    </div>
                    <div class="form-group">
                        <label>Source Language *</label>
                        <input type="text" name="source_language" value="id" maxlength="10" placeholder="id">
                    </div>
                    <div class="form-group">
                        <label>Target Language *</label>
                        <input type="text" name="target_language" value="en" maxlength="10" placeholder="en">
                    </div>
                    <div class="form-group full">
                        <label>Source Text *</label>
                        <textarea name="source_text" required placeholder="Halo"></textarea>
                    </div>
                    <div class="form-group full">
                        <label>Translated Text *</label>
                        <textarea name="translated_text" required placeholder="Hello"></textarea>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Terjemahan</button>
            </form>
        </div>
    </div>

    {{-- Form 5: Audio --}}
    <div class="form-panel" id="f-audio">
        <div class="section">
            <h2>POST /api/audio</h2>
            <form method="POST" action="{{ route('bisindo.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_form_type" value="audio">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Audio File * (wav, mp3, ogg, m4a - max 10MB)</label>
                        <input type="file" name="file" required accept=".wav,.mp3,.ogg,.m4a">
                    </div>
                    <div class="form-group">
                        <label>Vocabulary ID</label>
                        <input type="number" name="vocabulary_id" min="1">
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                        <input type="text" name="language" value="id" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="audio_type">
                            <option value="reference">Reference</option>
                            <option value="tts_output">TTS Output</option>
                            <option value="stt_input">STT Input</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Transcript</label>
                        <textarea name="transcript" placeholder="Transcript of the audio"></textarea>
                    </div>
                </div>
                <button type="submit" class="form-submit">Upload Audio</button>
            </form>
        </div>
    </div>

    {{-- Form 6: Kategori --}}
    <div class="form-panel" id="f-categories">
        <div class="section">
            <h2>POST /api/categories</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="categories">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" required placeholder="Alfabet">
                    </div>
                    <div class="form-group">
                        <label>Slug *</label>
                        <input type="text" name="slug" required placeholder="alfabet">
                    </div>
                    <div class="form-group">
                        <label>Language *</label>
                        <select name="language">
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="0" min="0">
                    </div>
                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" placeholder="Huruf A-Z dalam BISINDO"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select name="is_active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Kategori</button>
            </form>
        </div>
    </div>

    {{-- Form 7: Riwayat --}}
    <div class="form-panel" id="f-history">
        <div class="section">
            <h2>POST /api/history</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="history">
                <div class="form-grid">
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="number" name="user_id" min="1">
                    </div>
                    <div class="form-group">
                        <label>Session ID *</label>
                        <input type="text" name="session_id" required placeholder="sess-001">
                    </div>
                    <div class="form-group">
                        <label>Direction *</label>
                        <select name="direction" required>
                            <option value="sign_to_text">Sign to Text</option>
                            <option value="text_to_sign">Text to Sign</option>
                            <option value="speech_to_text">Speech to Text</option>
                            <option value="text_to_speech">Text to Speech</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Input Language *</label>
                        <select name="input_language" required>
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                            <option value="id">Indonesian</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Output Language *</label>
                        <select name="output_language" required>
                            <option value="id">Indonesian</option>
                            <option value="en">English</option>
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Confidence Score</label>
                        <input type="number" name="confidence_score" step="0.001" min="0" max="1" placeholder="0.0 - 1.0">
                    </div>
                    <div class="form-group">
                        <label>Duration (seconds)</label>
                        <input type="number" name="duration_seconds" step="0.01" min="0" placeholder="1.5">
                    </div>
                    <div class="form-group">
                        <label>Is Correct</label>
                        <select name="is_correct">
                            <option value="">-- Not set --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Input Data</label>
                        <textarea name="input_data" placeholder="[landmark array] or text input"></textarea>
                    </div>
                    <div class="form-group full">
                        <label>Output Data</label>
                        <textarea name="output_data" placeholder="Halo"></textarea>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Riwayat</button>
            </form>
        </div>
    </div>

    {{-- Form 8: Model AI --}}
    <div class="form-panel" id="f-models">
        <div class="section">
            <h2>POST /api/models</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="models">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" required placeholder="bisindo-alphabet-cnn">
                    </div>
                    <div class="form-group">
                        <label>Version *</label>
                        <input type="text" name="version" required placeholder="1.0.0">
                    </div>
                    <div class="form-group">
                        <label>Type *</label>
                        <select name="model_type" required>
                            <option value="alphabet_classifier">Alphabet Classifier</option>
                            <option value="word_classifier">Word Classifier</option>
                            <option value="stt_model">STT Model</option>
                            <option value="tts_model">TTS Model</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Language *</label>
                        <select name="language" required>
                            <option value="bisindo">BISINDO</option>
                            <option value="asl">ASL</option>
                            <option value="id">Indonesian</option>
                            <option value="en">English</option>
                            <option value="universal">Universal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Accuracy (%)</label>
                        <input type="number" name="accuracy_percent" step="0.01" min="0" max="100" placeholder="94.5">
                    </div>
                    <div class="form-group">
                        <label>Num Classes</label>
                        <input type="number" name="num_classes" min="1" placeholder="26">
                    </div>
                    <div class="form-group">
                        <label>Training Samples</label>
                        <input type="number" name="training_samples" min="0" placeholder="5000">
                    </div>
                    <div class="form-group">
                        <label>Validation Samples</label>
                        <input type="number" name="validation_samples" min="0" placeholder="1000">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="training">Training</option>
                            <option value="validating">Validating</option>
                            <option value="ready">Ready</option>
                            <option value="deployed">Deployed</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select name="is_active">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Notes</label>
                        <textarea name="notes" placeholder="Trained on BISINDO alphabet dataset v1"></textarea>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Model AI</button>
            </form>
        </div>
    </div>

    {{-- Form 9: Feedback --}}
    <div class="form-panel" id="f-feedbacks">
        <div class="section">
            <h2>POST /api/feedbacks</h2>
            <form method="POST" action="{{ route('bisindo.store') }}">
                @csrf
                <input type="hidden" name="_form_type" value="feedbacks">
                <div class="form-grid">
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="number" name="user_id" min="1">
                    </div>
                    <div class="form-group">
                        <label>Translation History ID</label>
                        <input type="number" name="translation_history_id" min="1">
                    </div>
                    <div class="form-group">
                        <label>AI Model ID</label>
                        <input type="number" name="ai_model_id" min="1">
                    </div>
                    <div class="form-group">
                        <label>Type *</label>
                        <select name="feedback_type" required>
                            <option value="correction">Correction</option>
                            <option value="rating">Rating</option>
                            <option value="bug_report">Bug Report</option>
                            <option value="suggestion">Suggestion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Is Correct</label>
                        <select name="is_correct">
                            <option value="">-- Not set --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rating (1-5)</label>
                        <input type="number" name="rating" min="1" max="5" placeholder="1-5">
                    </div>
                    <div class="form-group full">
                        <label>Expected Output</label>
                        <textarea name="expected_output" placeholder="B"></textarea>
                    </div>
                    <div class="form-group full">
                        <label>Comment</label>
                        <textarea name="comment" placeholder="Model predicted A but the sign was B"></textarea>
                    </div>
                </div>
                <button type="submit" class="form-submit">Submit Feedback</button>
            </form>
        </div>
    </div>

</div>{{-- /panel-forms --}}

    <script>
        var mainNames = ['overview', 'data', 'forms'];
        var subNames = ['gestures', 'users', 'vocabularies', 'translations', 'audio', 'categories', 'history', 'models', 'feedbacks'];
        var formNames = ['f-gestures', 'f-users', 'f-vocabularies', 'f-translations', 'f-audio', 'f-categories', 'f-history', 'f-models', 'f-feedbacks'];

        function activateMain(name) {
            document.querySelectorAll('.main-panel').forEach(function (p) { p.classList.remove('active'); });
            document.querySelectorAll('.main-tab').forEach(function (t) { t.classList.remove('active'); });
            document.getElementById('panel-' + name).classList.add('active');
            var idx = mainNames.indexOf(name);
            if (idx >= 0) document.querySelectorAll('.main-tab')[idx].classList.add('active');
        }

        function activateSub(name) {
            document.querySelectorAll('.sub-panel').forEach(function (p) { p.classList.remove('active'); });
            document.querySelectorAll('.sub-tab').forEach(function (t) { t.classList.remove('active'); });
            document.getElementById('sub-' + name).classList.add('active');
            var idx = subNames.indexOf(name);
            if (idx >= 0) document.querySelectorAll('.sub-tab')[idx].classList.add('active');
        }

        function activateForm(name) {
            document.querySelectorAll('.form-panel').forEach(function (p) { p.classList.remove('active'); });
            document.querySelectorAll('.form-sub-tab').forEach(function (t) { t.classList.remove('active'); });
            document.getElementById(name).classList.add('active');
            var idx = formNames.indexOf(name);
            if (idx >= 0) document.querySelectorAll('.form-sub-tab')[idx].classList.add('active');
        }

        function mainTab(name) {
            activateMain(name);
            var h = name;
            if (name === 'data') {
                var el = document.querySelector('.sub-tab.active');
                var idx = el ? Array.from(document.querySelectorAll('.sub-tab')).indexOf(el) : 0;
                h += '/' + (subNames[idx] || subNames[0]);
            }
            if (name === 'forms') {
                var el = document.querySelector('.form-sub-tab.active');
                var idx = el ? Array.from(document.querySelectorAll('.form-sub-tab')).indexOf(el) : 0;
                h += '/' + (formNames[idx] || formNames[0]);
            }
            history.replaceState(null, '', '#' + h);
        }

        function subTab(name) {
            activateSub(name);
            history.replaceState(null, '', '#data/' + name);
        }

        function formTab(name) {
            activateForm(name);
            history.replaceState(null, '', '#forms/' + name);
        }

        function toggleJson(id) {
            var el = document.getElementById(id);
            if (el) el.classList.toggle('active');
        }

        // Restore from hash on load
        (function () {
            var h = location.hash.replace('#', '');
            if (!h) return;
            var parts = h.split('/');
            var main = parts[0];
            var sub = parts[1];
            if (mainNames.indexOf(main) >= 0) activateMain(main);
            if (sub && subNames.indexOf(sub) >= 0) activateSub(sub);
            if (sub && formNames.indexOf(sub) >= 0) activateForm(sub);
        })();
    </script>

</body>

</html>