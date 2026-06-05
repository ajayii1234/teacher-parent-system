<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --primary-light: #f0f9ff;
            --primary-border: #e0f2fe;
            --bg: #ffffff;
            --bg-alt: #f8fafc;
            --border: #e0f2fe;
            --text: #0c4a6e;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --sidebar-width: 270px;
            --topbar-height: 70px;
        }

        html, body { height: 100%; }

        body {
            overflow: hidden;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
        }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-height);
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(14, 165, 233, 0.08);
        }

        .brand { display: flex; align-items: center; gap: 16px; }

        .brand-icon {
            width: 44px; height: 44px; border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 22px;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
        }

        .brand h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem; font-weight: 500;
            color: var(--text); letter-spacing: 0.5px;
        }

        .top-right { display: flex; align-items: center; gap: 20px; }

        .user-chip {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 16px; background: var(--primary-light);
            border: 1px solid var(--border); border-radius: 12px;
            transition: all 0.2s;
        }

        .user-chip:hover { border-color: var(--primary); background: #e0f7ff; }

        .avatar {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            border: 2px solid white;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 15px;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.2);
        }

        .user-chip span { color: var(--text); font-weight: 500; font-size: 14px; }

        .logout-btn {
            border: 1px solid var(--border); background: var(--primary-light);
            color: var(--primary); cursor: pointer; padding: 10px 18px;
            border-radius: 10px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; transition: all 0.2s;
            display: flex; align-items: center; gap: 6px;
        }

        .logout-btn:hover {
            background: var(--primary); color: white;
            border-color: var(--primary); transform: translateY(-1px);
        }

        /* ── LAYOUT ── */
        .layout { display: flex; height: calc(100vh - var(--topbar-height)); }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width); background: var(--bg);
            border-right: 1px solid var(--border);
            padding: 28px 20px; overflow-y: auto;
            display: flex; flex-direction: column;
        }

        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
        .sidebar::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        .sidebar-title {
            font-size: 11px; letter-spacing: 2.5px;
            text-transform: uppercase; color: var(--text-muted);
            margin-bottom: 12px; font-weight: 600;
        }

        .sidebar-title.gap { margin-top: 20px; }

        .nav-item {
            width: 100%; display: flex; align-items: center; gap: 12px;
            text-decoration: none; color: var(--text-secondary);
            padding: 12px 14px; border-radius: 10px; cursor: pointer;
            margin-bottom: 4px; transition: all 0.2s; font-size: 14px;
            border: 1px solid transparent; background: transparent; font-weight: 500;
        }

        .nav-item i { font-size: 18px; width: 20px; }

        .nav-item:hover {
            background: var(--primary-light);
            color: var(--primary); border-color: var(--border);
        }

        .nav-item.active {
            background: var(--primary-light); color: var(--primary);
            border: 1px solid var(--primary-border);
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.12);
        }

        /* ── CONTENT ── */
        .content {
            flex: 1; display: flex;
            flex-direction: column; overflow: hidden; background: var(--bg-alt);
        }

        .content-header {
            padding: 28px 36px; border-bottom: 1px solid var(--border);
            background: white; animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .content-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem; font-weight: 500;
            color: var(--text); margin-bottom: 6px;
        }

        .content-header p { color: var(--text-muted); font-size: 13px; }

        .iframe-wrapper {
            flex: 1; padding: 20px;
            overflow: hidden; background: var(--bg-alt);
        }

        iframe {
            width: 100%; height: 100%;
            border: 1px solid var(--border); border-radius: 14px;
            background: white;
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.08);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            :root { --sidebar-width: 240px; }
            .content-header h1 { font-size: 1.7rem; }
        }

        @media (max-width: 800px) {
            .layout { flex-direction: column; }
            .sidebar {
                width: 100%; height: auto; border-right: none;
                border-bottom: 1px solid var(--border);
                flex-direction: row; padding: 14px 20px;
                overflow-x: auto; gap: 6px;
            }
            .sidebar-title { display: none; }
            .nav-item { min-width: 150px; margin-bottom: 0; white-space: nowrap; }
            .content-header { padding: 20px 24px; }
            .content-header h1 { font-size: 1.4rem; }
            .iframe-wrapper { padding: 14px; }
        }

        @media (max-width: 600px) {
            .topbar { padding: 0 20px; }
            .brand h2 { font-size: 1.1rem; }
            .user-chip { padding: 8px 12px; }
            .logout-btn { padding: 8px 12px; font-size: 12px; }
        }
    </style>
</head>

<body>
@php
    $name          = auth()->user()->name ?? 'Teacher';
    $initial       = strtoupper(substr($name, 0, 1));
    $firstName     = explode(' ', $name)[0];
    $alerts        = \App\Models\Alert::where('user_id', auth()->id())->latest()->take(5)->get();
    $notifications = auth()->user()->notifications->take(5);
    $studentCount  = \App\Models\Student::count();
    $resultCount   = \App\Models\Result::count();
    $attendanceCount = \App\Models\Attendance::count();
    $unreadCount   = auth()->user()->unreadNotifications->count();
@endphp

<div class="topbar">
    <div class="brand">
        <div class="brand-icon"><i class="ti ti-school"></i></div>
        <h2>Teacher Portal</h2>
    </div>

    <div class="top-right">
        <div class="user-chip">
            <div class="avatar">{{ $initial }}</div>
            <span>{{ $firstName }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button class="logout-btn" type="submit">
                <i class="ti ti-logout"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="layout">
    <aside class="sidebar">
        <div style="width:100%;">

            <div class="sidebar-title">Dashboard</div>
            <a href="#" class="nav-item active" data-type="overview">
                <i class="ti ti-home"></i> Overview
            </a>

            <div class="sidebar-title gap">Students</div>
            <a href="{{ route('students.create') }}" class="nav-item"
               target="teacherFrame" data-title="Add Student"
               data-sub="Create a new student record">
                <i class="ti ti-user-plus"></i> Add Student
            </a>
            
            <!-- <a href="{{ route('students.index') }}" class="nav-item"
               target="teacherFrame" data-title="View Students"
               data-sub="Browse all students">
                <i class="ti ti-users"></i> View Students
            </a> -->



            <a href="{{ route('teacher.students') }}" class="nav-item"
               target="teacherFrame" data-title="View Students"
               data-sub="Browse all students">
                <i class="ti ti-users"></i> My Students
            </a>

            <div class="sidebar-title gap">Academics</div>
            <!-- <a href="{{ route('results.create') }}" class="nav-item"
               target="teacherFrame" data-title="Add Result"
               data-sub="Enter student results">
                <i class="ti ti-pencil-plus"></i> Add Result
            </a> -->



            <a href="{{ route('results.class.create') }}" class="nav-item"
               target="teacherFrame" data-title="Add Result"
               data-sub="Enter student results">
                <i class="ti ti-pencil-plus"></i>  My Class Results
            </a>

            <a href="{{ route('analytics') }}" class="nav-item"
               target="teacherFrame" data-title="Analytics"
               data-sub="View performance analytics">
                <i class="ti ti-chart-bar"></i> Analytics
            </a>

            <div class="sidebar-title gap">Attendance</div>
            <a href="{{ route('attendance.create') }}" class="nav-item"
               target="teacherFrame" data-title="Take Attendance"
               data-sub="Record attendance for students">
                <i class="ti ti-calendar-check"></i> Take Attendance
            </a>
            <a href="{{ route('attendance.index') }}" class="nav-item"
               target="teacherFrame" data-title="Attendance Records"
               data-sub="Review attendance history">
                <i class="ti ti-calendar-stats"></i> View Attendance
            </a>

            <div class="sidebar-title gap">Messaging</div>
            <a href="{{ route('chats.index') }}" class="nav-item"
               target="teacherFrame" data-title="Chats"
               data-sub="Message parents and colleagues">
                <i class="ti ti-message-circle"></i> Chats
            </a>

        </div>
    </aside>

    <main class="content">
        <div class="content-header">
            <h1 id="pageTitle">Overview</h1>
            <p id="pageSub">Your teacher dashboard summary.</p>
        </div>

        <div class="iframe-wrapper">
            <iframe id="teacherFrame" name="teacherFrame"></iframe>
        </div>
    </main>
</div>

<script>
    const frame     = document.getElementById('teacherFrame');
    const buttons   = document.querySelectorAll('.nav-item');
    const pageTitle = document.getElementById('pageTitle');
    const pageSub   = document.getElementById('pageSub');

    const overviewHTML = `
        <html>
        <head>
            <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
            <style>
                * { margin:0; padding:0; box-sizing:border-box; }
                body { font-family:'DM Sans',sans-serif; padding:32px; color:#0c4a6e; background:white; }

                .welcome { margin-bottom:28px; }
                .welcome h2 { font-family:'DM Serif Display',serif; font-size:1.8rem; font-weight:500; margin-bottom:6px; }
                .welcome p  { color:#94a3b8; font-size:13px; }

                .stats { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:28px; }
                .stat { background:#f0f9ff; border:1px solid #e0f2fe; border-radius:12px; padding:18px; }
                .stat-label { font-size:11px; text-transform:uppercase; letter-spacing:1.5px; color:#94a3b8; font-weight:600; margin-bottom:10px; }
                .stat-val { font-size:2rem; font-weight:700; color:#0c4a6e; font-family:'DM Serif Display',serif; margin-bottom:4px; }
                .stat-note { font-size:12px; color:#94a3b8; }

                .grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; }
                .card { background:#f0f9ff; border:1px solid #e0f2fe; border-radius:12px; padding:18px; }
                .card-title { font-family:'DM Serif Display',serif; font-size:1rem; color:#0c4a6e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
                .card-title i { color:#0ea5e9; font-size:16px; }

                .box { border:1px solid #e0f2fe; background:white; border-radius:8px; padding:12px; margin-bottom:8px; font-size:13px; color:#475569; line-height:1.6; transition:all .2s; }
                .box:hover { border-color:#0ea5e9; box-shadow:0 2px 8px rgba(14,165,233,0.1); }
                .new-badge { background:#dc2626; color:white; font-size:10px; font-weight:700; padding:2px 7px; border-radius:20px; margin-left:6px; }

                .empty { color:#94a3b8; font-size:13px; font-style:italic; text-align:center; padding:20px 0; }
                .summary-list { padding-left:18px; list-style:disc; }
                .summary-list li { font-size:13px; color:#475569; line-height:1.9; }

                @media(max-width:700px) {
                    .stats { grid-template-columns:1fr 1fr; }
                    .grid  { grid-template-columns:1fr; }
                }
            </style>
        </head>
        <body>
            <div class="welcome">
                <h2>Welcome, {{ $firstName }}! 👋</h2>
                <p>Here's a summary of your school activity today.</p>
            </div>

            <div class="stats">
                <div class="stat">
                    <div class="stat-label">Students</div>
                    <div class="stat-val">{{ $studentCount }}</div>
                    <div class="stat-note">Total in system</div>
                </div>
                <div class="stat">
                    <div class="stat-label">Results</div>
                    <div class="stat-val">{{ $resultCount }}</div>
                    <div class="stat-note">Recorded so far</div>
                </div>
                <div class="stat">
                    <div class="stat-label">Attendance</div>
                    <div class="stat-val">{{ $attendanceCount }}</div>
                    <div class="stat-note">Records available</div>
                </div>
                <div class="stat">
                    <div class="stat-label">Unread</div>
                    <div class="stat-val">{{ $unreadCount }}</div>
                    <div class="stat-note">Waiting notifications</div>
                </div>
            </div>

            <div class="grid">
                <div class="card">
                    <div class="card-title"><i class="ti ti-bell"></i> Recent Alerts</div>
                    @forelse($alerts as $alert)
                        <div class="box">{{ $alert->message }}</div>
                    @empty
                        <div class="empty">No alerts at the moment.</div>
                    @endforelse
                </div>

                <div class="card">
                    <div class="card-title"><i class="ti ti-inbox"></i> Notifications</div>
                    @forelse($notifications as $notification)
                        <div class="box">
                            {{ $notification->data['message'] ?? 'You have a new notification' }}
                            @if(is_null($notification->read_at))
                                <span class="new-badge">● NEW</span>
                            @endif
                        </div>
                    @empty
                        <div class="empty">No new notifications.</div>
                    @endforelse
                </div>

                <div class="card">
                    <div class="card-title"><i class="ti ti-list-check"></i> Teacher Summary</div>
                    <ul class="summary-list">
                        <li>Manage student records</li>
                        <li>Enter and review results</li>
                        <li>Take and review attendance</li>
                        <li>Respond to messages from parents</li>
                    </ul>
                </div>
            </div>
        </body>
        </html>
    `;

    frame.srcdoc = overviewHTML;

    window.addEventListener('pageshow', () => {
        frame.srcdoc = overviewHTML;
    });

    buttons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            const type = this.dataset.type;

            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            if (type === 'overview') {
                e.preventDefault();
                pageTitle.textContent = 'Overview';
                pageSub.textContent   = 'Your teacher dashboard summary.';
                frame.srcdoc = overviewHTML;
                return;
            }

            pageTitle.textContent = this.dataset.title || '';
            pageSub.textContent   = this.dataset.sub   || '';
        });
    });
</script>
</body>
</html>