<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            --bg: #ffffff;
            --bg-alt: #f8fafc;
            --card: #f0f9ff;
            --border: #e0f2fe;
            --text: #0c4a6e;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --success: #16a34a;
            --sidebar-width: 280px;
            --topbar-height: 70px;
        }

        html, body {
            height: 100%;
        }

        body {
            overflow: hidden;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
        }

        /* ────── TOPBAR ────── */
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

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
        }

        .brand h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.5px;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            background: var(--primary-light);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s;
        }

        .user-chip:hover {
            border-color: var(--primary);
            background: #e0f7ff;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.2);
        }

        .user-chip span {
            color: var(--text);
            font-weight: 500;
            font-size: 14px;
        }

        .logout-btn {
            border: 1px solid var(--border);
            background: var(--primary-light);
            color: var(--primary);
            cursor: pointer;
            padding: 10px 18px;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        /* ────── LAYOUT ────── */
        .layout {
            display: flex;
            height: calc(100vh - var(--topbar-height));
        }

        /* ────── SIDEBAR ────── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg);
            border-right: 1px solid var(--border);
            padding: 28px 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        .sidebar-title {
            font-size: 11px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 18px;
            font-weight: 600;
        }

        .nav-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-secondary);
            padding: 13px 14px;
            border-radius: 10px;
            text-align: left;
            cursor: pointer;
            margin-bottom: 8px;
            transition: all 0.2s;
            font-size: 14px;
            border: 1px solid transparent;
            background: transparent;
            font-weight: 500;
        }

        .nav-item i {
            font-size: 18px;
            width: 20px;
        }

        .nav-item:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--border);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--primary-border);
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.12);
        }

        .nav-item.active i {
            color: var(--primary);
        }

        /* ────── CONTENT ────── */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg-alt);
        }

        .content-header {
            padding: 32px 36px;
            border-bottom: 1px solid var(--border);
            background: white;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 400;
        }

        .iframe-wrapper {
            flex: 1;
            padding: 24px;
            overflow: hidden;
            background: var(--bg-alt);
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: white;
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.08);
        }

        /* ────── IFRAME CONTENT ────── */
        .overview {
            padding: 40px;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: white;
            height: 100%;
            overflow-y: auto;
        }

        .overview h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 28px;
            color: var(--text);
        }

        .overview h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 36px;
            margin-bottom: 16px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .box {
            border: 1px solid var(--border);
            padding: 16px;
            margin-bottom: 14px;
            border-radius: 10px;
            background: var(--primary-light);
            transition: all 0.2s;
            color: var(--text);
            font-size: 14px;
            line-height: 1.5;
        }

        .box:hover {
            border-color: var(--primary);
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.12);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
            font-size: 14px;
        }

        .new {
            color: #dc2626;
            font-weight: 600;
            font-size: 12px;
            margin-left: 6px;
        }

        /* ────── RESPONSIVE ────── */
        @media(max-width: 1100px) {
            :root {
                --sidebar-width: 240px;
            }

            .content-header h1 {
                font-size: 1.8rem;
            }

            .content-header {
                padding: 24px 28px;
            }
        }

        @media(max-width: 800px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border);
                flex-direction: row;
                padding: 16px 20px;
                overflow-x: auto;
                gap: 8px;
            }

            .sidebar-title {
                display: none;
            }

            .nav-item {
                min-width: 160px;
                margin-bottom: 0;
                white-space: nowrap;
            }

            .iframe-wrapper {
                flex: 1;
                padding: 16px;
            }

            iframe {
                border-radius: 10px;
            }

            .content-header {
                padding: 20px 24px;
            }

            .content-header h1 {
                font-size: 1.5rem;
            }

            .topbar {
                padding: 0 20px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .brand h2 {
                font-size: 1.1rem;
            }
        }

        @media(max-width: 600px) {
            .top-right {
                gap: 12px;
            }

            .user-chip {
                padding: 8px 12px;
                font-size: 12px;
            }

            .avatar {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .logout-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .overview {
                padding: 24px;
            }

            .overview h2 {
                font-size: 1.4rem;
                margin-bottom: 20px;
            }

            .overview h3 {
                font-size: 1rem;
                margin-top: 24px;
            }

            .box {
                padding: 12px;
                font-size: 13px;
            }

            .notification-card{
    position:relative;
}

.notification-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:10px;
}

.notification-time{
    margin-top:8px;
    font-size:12px;
    color:#777;
}

.close-btn{
    border:none;
    background:none;
    cursor:pointer;
    color:#999;
    font-size:16px;
    font-weight:bold;
}

.close-btn:hover{
    color:red;
}

.alert-card{
    position:relative;
}

.alert-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:10px;
}

.alert-time{
    margin-top:8px;
    font-size:12px;
    color:#777;
}
        }
    </style>
</head>

<body>
@php
    $name = auth()->user()->name ?? 'Parent';
    $initial = strtoupper(substr($name, 0, 1));
    $firstName = explode(' ', $name)[0];

    $alerts = \App\Models\Alert::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    $notifications = auth()->user()->notifications->take(5);
@endphp

<div class="topbar">
    <div class="brand">
        <div class="brand-icon">
            <i class="ti ti-book"></i>
        </div>
        <h2>Parent Portal</h2>
    </div>

    <div class="top-right">
        <div class="user-chip">
            <div class="avatar">{{ $initial }}</div>
            <span>{{ $firstName }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button class="logout-btn" type="submit">
                <i class="ti ti-logout"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<div class="layout">
    <aside class="sidebar">
        <div>
            <div class="sidebar-title">Dashboard</div>

            <a href="#"
               class="nav-item active"
               data-type="overview">
                <i class="ti ti-home"></i>
                Overview
            </a>

            <a href="{{ route('parent.results') }}"
               class="nav-item"
               target="dashboardFrame"
               data-title="Child Results"
               data-sub="View your child's academic results">
                <i class="ti ti-chart-bar"></i>
                Results
            </a>

            <a href="{{ route('parent.attendance') }}"
               class="nav-item"
               target="dashboardFrame"
               data-title="Attendance"
               data-sub="Check your child's attendance">
                <i class="ti ti-calendar-check"></i>
                Attendance
            </a>

            <a href="{{ route('chats.index') }}"
                class="nav-item"
                target="dashboardFrame"
                data-title="Chats"
                data-sub="Message and chat with teachers">
                    <i class="ti ti-message-circle"></i>
                    Chats
                </a>

            <!-- <a href="{{ route('messages.create') }}"
               class="nav-item"
               target="dashboardFrame"
               data-title="Contact Teacher"
               data-sub="Send a message to teachers">
                <i class="ti ti-mail-plus"></i>
                Message
            </a> -->

            <!-- <a href="{{ route('messages.index') }}"
               class="nav-item"
               target="dashboardFrame"
               data-title="Inbox"
               data-sub="Read your messages">
                <i class="ti ti-inbox"></i>
                Inbox
            </a> -->
        </div>
    </aside>

    <main class="content">
        <div class="content-header">
            <h1 id="pageTitle">Overview</h1>
            <p id="pageSub">Your parent dashboard summary.</p>
        </div>

        <div class="iframe-wrapper">
            <iframe id="dashboardFrame" name="dashboardFrame"></iframe>
        </div>
    </main>
</div>

<script>
    const frame = document.getElementById('dashboardFrame');
    const buttons = document.querySelectorAll('.nav-item');
    const pageTitle = document.getElementById('pageTitle');
    const pageSub = document.getElementById('pageSub');

    const overviewHTML = `
        <html>
        <head>
            <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                
                :root {
                    --primary: #0ea5e9;
                    --text: #0c4a6e;
                    --text-secondary: #475569;
                    --text-muted: #94a3b8;
                    --border: #e0f2fe;
                    --primary-light: #f0f9ff;
                }
                
                body {
                    font-family: 'DM Sans', sans-serif;
                    padding: 40px;
                    color: var(--text);
                    background: white;
                }
                
                h2 {
                    font-family: 'DM Serif Display', serif;
                    font-size: 1.8rem;
                    font-weight: 500;
                    margin-bottom: 28px;
                    color: var(--text);
                }
                
                p {
                    color: var(--text-secondary);
                    font-size: 14px;
                    line-height: 1.6;
                    margin-bottom: 16px;
                }
                
                h3 {
                    font-family: 'DM Serif Display', serif;
                    font-size: 1.2rem;
                    font-weight: 500;
                    margin-top: 36px;
                    margin-bottom: 16px;
                    color: var(--text);
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                
                .box {
                    border: 1px solid var(--border);
                    padding: 16px;
                    margin-bottom: 14px;
                    border-radius: 10px;
                    background: var(--primary-light);
                    transition: all 0.2s;
                    color: var(--text);
                    font-size: 14px;
                    line-height: 1.6;
                }
                
                .box:hover {
                    border-color: var(--primary);
                    box-shadow: 0 2px 8px rgba(14, 165, 233, 0.12);
                }
                
                .empty-state {
                    text-align: center;
                    padding: 40px 20px;
                    color: var(--text-muted);
                    font-size: 14px;
                }
                
                .new {
                    color: #dc2626;
                    font-weight: 600;
                    font-size: 12px;
                    margin-left: 6px;
                }
            </style>
        </head>
        <body>
            <h2>Welcome, {{ $firstName }}! 👋</h2>
            <p>Here's your child's latest information and updates. Keep track of their progress and stay connected with the school.</p>

            <h3>🔔 Recent Alerts</h3>

@forelse($alerts as $alert)

<div class="box alert-card">

    <div class="alert-header">

        <div>
            {{ $alert->message }}
        </div>

        <form method="POST"
              action="{{ route('alerts.delete', $alert->id) }}"
              class="delete-alert-form">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="close-btn">
                ✕
            </button>

        </form>

    </div>

    <div class="alert-time">
        {{ $alert->created_at->format('d M Y, h:i A') }}
    </div>

</div>

@empty

    <div class="empty-state">
        No alerts at the moment. Everything looks good!
    </div>

@endforelse

            <h3>📩 Notifications</h3>

@forelse($notifications as $notification)

<div class="box notification-card">

<div class="notification-header">

    <div>

        {{ $notification->data['message'] ?? 'You have a new notification' }}

        @if(is_null($notification->read_at))
            <span class="new">● NEW</span>
        @endif

    </div>

    <form method="POST"
          action="{{ route('notifications.delete', $notification->id) }}"
          class="delete-notification-form">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="close-btn">
            ✕
        </button>

    </form>

</div>

<div class="notification-time">
    {{ $notification->created_at->format('d M Y, h:i A') }}
</div>

</div>

@empty

    <div class="empty-state">
        No new notifications. Check back soon!
    </div>

@endforelse
        </body>
        </html>
    `;

    frame.srcdoc = overviewHTML;

    buttons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            const type = this.dataset.type;

            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            if (type === 'overview') {
                e.preventDefault();
                pageTitle.textContent = 'Overview';
                pageSub.textContent = 'Your parent dashboard summary.';
                frame.srcdoc = overviewHTML;
                return;
            }

            pageTitle.textContent = this.dataset.title || '';
            pageSub.textContent = this.dataset.sub || '';
        });
    });
</script>

<script>
document.querySelectorAll('.delete-alert-form').forEach(form => {

    form.addEventListener('submit', async function(e) {

        e.preventDefault();

        if (!confirm('Remove this alert?')) {
            return;
        }

        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(this)
        });

        if (response.ok) {

            this.closest('.alert-card').remove();

        }

    });

});
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    // DELETE ALERTS
    document.querySelectorAll('.delete-alert-form').forEach(form => {

        form.addEventListener('submit', async function (e) {

            e.preventDefault();

            if (!confirm('Remove this alert?')) {
                return;
            }

            try {

                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });

                const data = await response.json();

                if (data.success) {

                    this.closest('.alert-card').remove();

                }

            } catch (error) {
                console.error(error);
            }

        });

    });


    // DELETE NOTIFICATIONS
    document.querySelectorAll('.delete-notification-form').forEach(form => {

        form.addEventListener('submit', async function (e) {

            e.preventDefault();

            if (!confirm('Remove this notification?')) {
                return;
            }

            try {

                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(this)
                });

                const data = await response.json();

                if (data.success) {

                    this.closest('.notification-card').remove();

                }

            } catch (error) {
                console.error(error);
            }

        });

    });

});

</script>
</body>
</html>