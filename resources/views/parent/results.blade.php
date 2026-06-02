<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Child Results</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --primary-light: #f0f9ff;
            --primary-border: #e0f2fe;
            --bg: white;
            --bg-alt: #f8fafc;
            --border: #e0f2fe;
            --text: #0c4a6e;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --success: #16a34a;
            --warning: #ea8c16;
            --danger: #dc2626;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            padding: 0;
            margin: 0;
        }

        .results-container {
            padding: 0;
        }

        .students-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* ────── STUDENT CARD ────── */
        .student-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.08);
            animation: slideUp 0.4s ease-out forwards;
            opacity: 0;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .student-card:nth-child(1) { animation-delay: 0.1s; }
        .student-card:nth-child(2) { animation-delay: 0.2s; }
        .student-card:nth-child(3) { animation-delay: 0.3s; }
        .student-card:nth-child(4) { animation-delay: 0.4s; }
        .student-card:nth-child(5) { animation-delay: 0.5s; }

        .student-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.15);
            transform: translateY(-2px);
        }

        .student-header {
            padding: 24px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #e0f7ff 100%);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
        }

        .student-info h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .student-info p {
            color: var(--text-muted);
            font-size: 13px;
        }

        .no-results {
            padding: 40px 24px;
            text-align: center;
            color: var(--text-muted);
        }

        .no-results i {
            font-size: 48px;
            color: var(--border);
            margin-bottom: 12px;
            display: block;
        }

        /* ────── RESULTS TABLE ────── */
        .results-table-wrapper {
            overflow-x: auto;
            padding: 0;
        }

        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .results-table thead {
            background: var(--primary-light);
            border-bottom: 2px solid var(--primary-border);
        }

        .results-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--primary);
            font-family: 'DM Sans', sans-serif;
        }

        .results-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: all 0.2s;
        }

        .results-table tbody tr:hover {
            background: var(--primary-light);
        }

        .results-table tbody tr:last-child {
            border-bottom: none;
        }

        .results-table td {
            padding: 14px 16px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 400;
        }

        .results-table td:first-child {
            color: var(--text);
            font-weight: 500;
        }

        /* ────── SCORE STYLING ────── */
        .score-value {
            font-weight: 600;
            color: var(--primary);
        }

        .score-total {
            font-weight: 700;
            font-size: 15px;
            color: var(--text);
        }

        /* ────── GRADE BADGE ────── */
        .grade-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            min-width: 45px;
        }

        .grade-a {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .grade-b {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }

        .grade-c {
            background: rgba(251, 146, 60, 0.1);
            color: #ea580c;
        }

        .grade-d {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .grade-f {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        /* ────── TERM & SESSION BADGES ────── */
        .term-badge, .session-badge {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--border);
        }

        /* ────── EMPTY STATE ────── */
        .empty-state {
            text-align: center;
            padding: 60px 40px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 64px;
            color: var(--primary-light);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            color: var(--text);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ────── RESPONSIVE ────── */
        @media(max-width: 768px) {
            .results-container {
                padding: 0;
            }

            .student-header {
                padding: 18px;
            }

            .student-info h3 {
                font-size: 1.1rem;
            }

            .results-table th,
            .results-table td {
                padding: 10px 12px;
                font-size: 12px;
            }

            .results-table th {
                font-size: 11px;
            }

            .score-value {
                font-size: 13px;
            }

            .grade-badge {
                font-size: 12px;
                padding: 5px 10px;
            }
        }

        @media(max-width: 500px) {
            .students-list {
                gap: 16px;
            }

            .student-header {
                padding: 16px;
            }

            .student-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .student-info h3 {
                font-size: 1rem;
            }

            .results-table {
                font-size: 11px;
            }

            .results-table th,
            .results-table td {
                padding: 8px 10px;
            }

            .grade-badge {
                padding: 4px 8px;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

<div class="results-container">
    @if($students->isEmpty())
        <div class="empty-state">
            <i class="ti ti-inbox"></i>
            <h3>No Students Found</h3>
            <p>No student records available to display results.</p>
        </div>
    @else
        <div class="students-list">
            @foreach($students as $student)
                <div class="student-card">
                    <!-- Student Header -->
                    <div class="student-header">
                        <div class="student-avatar">
                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                        </div>
                        <div class="student-info">
                            <h3>{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <p>📚 Academic Results</p>
                        </div>
                    </div>

                    <!-- Results Table -->
                    @if($student->results->isEmpty())
                        <div class="no-results">
                            <i class="ti ti-alert-circle"></i>
                            <p style="color: var(--text-muted); font-size: 14px;">No results available yet.</p>
                        </div>
                    @else
                        <div class="results-table-wrapper">
                            <table class="results-table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>CA Score</th>
                                        <th>Exam Score</th>
                                        <th>Total</th>
                                        <th>Grade</th>
                                        <th>Term</th>
                                        <th>Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->results as $result)
                                        <tr>
                                            <td>{{ $result->subject->name }}</td>
                                            <td><span class="score-value">{{ $result->ca_score }}</span></td>
                                            <td><span class="score-value">{{ $result->exam_score }}</span></td>
                                            <td><span class="score-total">{{ $result->total }}</span></td>
                                            <td>
                                                <span class="grade-badge grade-{{ strtolower($result->grade) }}">
                                                    {{ $result->grade }}
                                                </span>
                                            </td>
                                            <td><span class="term-badge">{{ $result->term }}</span></td>
                                            <td><span class="session-badge">{{ $result->session }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>

</html>