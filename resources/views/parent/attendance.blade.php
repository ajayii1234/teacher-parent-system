<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Child Attendance Records</title>

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

        .attendance-container {
            padding: 0;
        }

        .students-list {
            display: flex;
            flex-direction: column;
            gap: 28px;
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

        /* ────── STUDENT HEADER ────── */
        .student-header {
            padding: 24px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #e0f7ff 100%);
            border-bottom: 1px solid var(--border);
        }

        .student-header-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
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
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .student-info p {
            color: var(--text-muted);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .student-info p i {
            font-size: 16px;
            color: var(--primary);
        }

        /* ────── STATS ROW ────── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
        }

        .stat-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            transition: all 0.2s;
        }

        .stat-item:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-value.present {
            color: var(--success);
        }

        .stat-value.absent {
            color: var(--danger);
        }

        .stat-value.late {
            color: var(--warning);
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* ────── ATTENDANCE PERCENTAGE ────── */
        .attendance-percentage {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 12px;
        }

        .percentage-bar {
            flex: 1;
            height: 8px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .percentage-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--success) 0%, var(--primary) 100%);
            border-radius: 4px;
            transition: width 0.4s ease;
        }

        .percentage-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            min-width: 50px;
        }

        /* ────── ATTENDANCE TABLE ────── */
        .attendance-table-wrapper {
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .attendance-table thead {
            background: var(--primary-light);
            border-bottom: 2px solid var(--primary-border);
        }

        .attendance-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--primary);
            font-family: 'DM Sans', sans-serif;
        }

        .attendance-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: all 0.2s;
        }

        .attendance-table tbody tr:hover {
            background: var(--primary-light);
        }

        .attendance-table tbody tr:last-child {
            border-bottom: none;
        }

        .attendance-table td {
            padding: 14px 16px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 400;
        }

        .attendance-table td:first-child {
            color: var(--text);
            font-weight: 500;
        }

        /* ────── STATUS BADGE ────── */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            min-width: 85px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .status-badge i {
            font-size: 14px;
        }

        .status-present {
            background: rgba(22, 163, 74, 0.1);
            color: var(--success);
        }

        .status-absent {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        .status-late {
            background: rgba(234, 140, 22, 0.1);
            color: var(--warning);
        }

        /* ────── EMPTY STATES ────── */
        .no-records {
            padding: 40px 24px;
            text-align: center;
            color: var(--text-muted);
        }

        .no-records i {
            font-size: 48px;
            color: var(--border);
            margin-bottom: 12px;
            display: block;
        }

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
            .student-header-top {
                margin-bottom: 16px;
            }

            .stats-row {
                grid-template-columns: repeat(3, 1fr);
            }

            .stat-item {
                padding: 10px;
            }

            .stat-value {
                font-size: 16px;
            }

            .stat-label {
                font-size: 10px;
            }

            .attendance-table th,
            .attendance-table td {
                padding: 12px;
                font-size: 13px;
            }

            .attendance-table th {
                font-size: 11px;
            }

            .status-badge {
                padding: 5px 10px;
                font-size: 12px;
                min-width: 75px;
            }
        }

        @media(max-width: 500px) {
            .students-list {
                gap: 16px;
            }

            .student-header {
                padding: 16px;
            }

            .student-header-top {
                margin-bottom: 12px;
            }

            .student-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .student-info h3 {
                font-size: 1.1rem;
            }

            .stats-row {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .stat-item {
                padding: 8px;
            }

            .stat-value {
                font-size: 14px;
            }

            .attendance-table {
                font-size: 12px;
            }

            .attendance-table th,
            .attendance-table td {
                padding: 10px 8px;
            }

            .attendance-table th {
                font-size: 10px;
            }

            .status-badge {
                padding: 4px 8px;
                font-size: 11px;
                gap: 4px;
            }

            .attendance-percentage {
                flex-direction: column;
                align-items: flex-start;
            }

            .percentage-bar {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="attendance-container">
    @if($students->isEmpty())
        <div class="empty-state">
            <i class="ti ti-inbox"></i>
            <h3>No Students Found</h3>
            <p>No student records available to display attendance.</p>
        </div>
    @else
        <div class="students-list">
            @foreach($students as $student)
                @php
                    $attendances = $student->attendances;
                    $presentCount = $attendances->where('status', 'present')->count();
                    $absentCount = $attendances->where('status', 'absent')->count();
                    $lateCount = $attendances->where('status', 'late')->count();
                    $totalDays = $attendances->count();
                    $attendancePercentage = $totalDays > 0 ? round(($presentCount / $totalDays) * 100) : 0;
                @endphp

                <div class="student-card">
                    <!-- Student Header with Stats -->
                    <div class="student-header">
                        <div class="student-header-top">
                            <div class="student-avatar">
                                {{ strtoupper(substr($student->first_name, 0, 1)) }}
                            </div>
                            <div class="student-info">
                                <h3>{{ $student->first_name }} {{ $student->last_name }}</h3>
                                <p>
                                    <i class="ti ti-building"></i>
                                    {{ $student->class->name ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <!-- Stats Row -->
                        @if($totalDays > 0)
                            <div class="stats-row">
                                <div class="stat-item">
                                    <div class="stat-value present">{{ $presentCount }}</div>
                                    <div class="stat-label">Present</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value absent">{{ $absentCount }}</div>
                                    <div class="stat-label">Absent</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value late">{{ $lateCount }}</div>
                                    <div class="stat-label">Late</div>
                                </div>
                            </div>

                            <!-- Attendance Percentage Bar -->
                            <div class="attendance-percentage">
                                <div class="percentage-bar">
                                    <div class="percentage-fill" style="width: {{ $attendancePercentage }}%"></div>
                                </div>
                                <div class="percentage-text">{{ $attendancePercentage }}%</div>
                            </div>
                        @endif
                    </div>

                    <!-- Attendance Records Table -->
                    @if($attendances->isEmpty())
                        <div class="no-records">
                            <i class="ti ti-alert-circle"></i>
                            <p style="color: var(--text-muted); font-size: 14px;">No attendance records found.</p>
                        </div>
                    @else
                        <div class="attendance-table-wrapper">
                            <table class="attendance-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->attendances->sortByDesc('attendance_date') as $attendance)
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}
                                            </td>
                                            <td>
                                                @if($attendance->status === 'present')
                                                    <span class="status-badge status-present">
                                                        <i class="ti ti-check"></i>
                                                        Present
                                                    </span>
                                                @elseif($attendance->status === 'absent')
                                                    <span class="status-badge status-absent">
                                                        <i class="ti ti-x"></i>
                                                        Absent
                                                    </span>
                                                @else
                                                    <span class="status-badge status-late">
                                                        <i class="ti ti-clock"></i>
                                                        Late
                                                    </span>
                                                @endif
                                            </td>
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