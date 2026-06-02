<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        :root{
            --bg:#060D1A;
            --bg2:#0C1B30;
            --card:#10233B;
            --green:#27AE60;
            --green-dark:#166B3A;
            --blue:#3490dc;
            --orange:#f6993f;
            --purple:#9561e2;
            --red:#e3342f;
            --gray:#6c757d;
            --border:rgba(255,255,255,0.08);
            --text:#fff;
            --muted:#7E91A8;
            --sidebar:270px;
            --topbar:60px;
        }

        html,
        body{
            height:100%;
        }

        body{
            overflow:hidden;
            background:var(--bg);
            color:var(--text);
            font-family:'DM Sans', sans-serif;
        }

        .topbar{
            height:var(--topbar);
            background:var(--bg2);
            border-bottom:1px solid var(--border);
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 20px;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .brand img{
            width:38px;
            height:38px;
            object-fit:contain;
        }

        .brand h2{
            font-family:'Cormorant Garamond', serif;
            font-size:1.2rem;
            letter-spacing:1px;
        }

        .top-right{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .user-chip{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .avatar{
            width:34px;
            height:34px;
            border-radius:50%;
            background:var(--green-dark);
            border:1px solid var(--green);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:700;
        }

        .logout-btn{
            border:none;
            background:transparent;
            color:#fff;
            cursor:pointer;
            border:1px solid var(--border);
            padding:10px 14px;
            border-radius:6px;
        }

        .layout{
            display:flex;
            height:calc(100vh - var(--topbar));
        }

        .sidebar{
            width:var(--sidebar);
            background:var(--bg2);
            border-right:1px solid var(--border);
            padding:20px;
            overflow-y:auto;
        }

        .sidebar-title{
            font-size:.7rem;
            letter-spacing:3px;
            text-transform:uppercase;
            color:var(--muted);
            margin-bottom:15px;
        }

        .nav-link{
            width:100%;
            display:block;
            text-decoration:none;
            color:rgba(255,255,255,.65);
            padding:14px 15px;
            border-radius:8px;
            text-align:left;
            cursor:pointer;
            margin-bottom:10px;
            transition:.2s;
            font-size:.92rem;
            border:1px solid transparent;
            background:transparent;
        }

        .nav-link:hover{
            background:rgba(39,174,96,.1);
            color:#fff;
        }

        .nav-link.active{
            background:rgba(39,174,96,.15);
            color:#fff;
            border:1px solid rgba(39,174,96,.3);
        }

        .content{
            flex:1;
            display:flex;
            flex-direction:column;
            overflow:hidden;
        }

        .content-header{
            padding:25px;
            border-bottom:1px solid var(--border);
        }

        .content-header h1{
            font-family:'Cormorant Garamond', serif;
            font-size:2rem;
            font-weight:500;
            margin-bottom:5px;
        }

        .content-header p{
            color:var(--muted);
            font-size:.9rem;
        }

        .iframe-wrapper{
            flex:1;
            padding:15px;
            background:var(--bg);
        }

        iframe{
            width:100%;
            height:100%;
            border:none;
            border-radius:10px;
            background:#fff;
        }

        @media(max-width:900px){
            .sidebar{
                width:220px;
            }

            .content-header h1{
                font-size:1.6rem;
            }
        }

        @media(max-width:700px){
            .layout{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
                height:auto;
                border-right:none;
                border-bottom:1px solid var(--border);
                display:flex;
                overflow-x:auto;
                gap:10px;
            }

            .sidebar-title{
                display:none;
            }

            .nav-link{
                min-width:180px;
                margin-bottom:0;
            }

            .iframe-wrapper{
                height:100%;
            }
        }
    </style>
</head>

<body>
@php
    $name = auth()->user()->name ?? 'Teacher';
    $initial = strtoupper(substr($name, 0, 1));
    $firstName = explode(' ', $name)[0];

    $alerts = \App\Models\Alert::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    $notifications = auth()->user()->notifications->take(5);

    $studentCount = \App\Models\Student::count();
    $resultCount = \App\Models\Result::count();
    $attendanceCount = \App\Models\Attendance::count();
    $unreadCount = auth()->user()->unreadNotifications->count();
@endphp

<div class="topbar">
    <div class="brand">
        <img src="{{ asset('images/ema.png') }}" alt="Euromega">
        <h2>Teacher Portal</h2>
    </div>

    <div class="top-right">
        <div class="user-chip">
            <div class="avatar">{{ $initial }}</div>
            <span>{{ $firstName }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="layout">
    <aside class="sidebar">
        <div style="width:100%;">
            <div class="sidebar-title">Dashboard</div>

            <a href="#"
               class="nav-link active"
               data-type="overview">
                Overview
            </a>

            <a href="{{ route('students.create') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Add Student"
               data-sub="Create a new student record">
                Add Student
            </a>

            <a href="{{ route('students.index') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="View Students"
               data-sub="Browse all students">
                View Students
            </a>

            <a href="{{ route('results.create') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Add Result"
               data-sub="Enter student results">
                Add Result
            </a>

            <a href="{{ route('analytics') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Analytics"
               data-sub="View performance analytics">
                View Analytics
            </a>

            <a href="{{ route('attendance.create') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Take Attendance"
               data-sub="Record attendance for students">
                Take Attendance
            </a>

            <a href="{{ route('attendance.index') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Attendance Records"
               data-sub="Review attendance history">
                View Attendance
            </a>

            <!-- <a href="{{ route('messages.create') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Send Message"
               data-sub="Message a parent or colleague">
                Send Message
            </a> -->

            <!-- <a href="{{ route('messages.index') }}"
               class="nav-link"
               target="teacherFrame"
               data-title="Inbox"
               data-sub="Read your messages">
                Inbox
            </a> -->

            <a href="{{ route('chats.index') }}"
   style="padding:10px 15px; background:#25D366; color:white; text-decoration:none; border-radius:5px;">
    Chats
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
    const frame = document.getElementById('teacherFrame');
    const buttons = document.querySelectorAll('.nav-link');
    const pageTitle = document.getElementById('pageTitle');
    const pageSub = document.getElementById('pageSub');

    const overviewHTML = `
        <html>
        <head>
            <style>
                body{
                    font-family:Arial, sans-serif;
                    padding:30px;
                    color:#111;
                    background:#fff;
                }

                .header{
                    margin-bottom:24px;
                }

                .header h2{
                    margin-bottom:8px;
                }

                .header p{
                    color:#555;
                    line-height:1.5;
                }

                .stats{
                    display:grid;
                    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
                    gap:16px;
                    margin-top:20px;
                    margin-bottom:28px;
                }

                .stat-card{
                    border:1px solid #e5e7eb;
                    border-radius:14px;
                    padding:18px;
                    background:#f9fafb;
                    box-shadow:0 2px 8px rgba(0,0,0,0.04);
                }

                .stat-label{
                    font-size:12px;
                    text-transform:uppercase;
                    letter-spacing:1px;
                    color:#6b7280;
                    margin-bottom:10px;
                }

                .stat-value{
                    font-size:28px;
                    font-weight:700;
                    color:#111827;
                    margin-bottom:6px;
                }

                .stat-note{
                    font-size:13px;
                    color:#6b7280;
                }

                .section-title{
                    margin-top:28px;
                    margin-bottom:14px;
                    font-size:18px;
                    font-weight:700;
                    color:#111827;
                }

                .grid{
                    display:grid;
                    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
                    gap:16px;
                }

                .card{
                    border:1px solid #e5e7eb;
                    border-radius:14px;
                    padding:18px;
                    background:#ffffff;
                    box-shadow:0 2px 8px rgba(0,0,0,0.04);
                }

                .card h4{
                    margin-bottom:10px;
                    font-size:15px;
                    color:#111827;
                }

                .card p,
                .card li{
                    color:#4b5563;
                    font-size:14px;
                    line-height:1.6;
                }

                .list{
                    margin-top:10px;
                    padding-left:18px;
                }

                .badge{
                    display:inline-block;
                    padding:5px 10px;
                    border-radius:999px;
                    font-size:12px;
                    font-weight:600;
                    background:#e0f2fe;
                    color:#0369a1;
                    margin-bottom:10px;
                }

                .alert-box{
                    border:1px solid #dbeafe;
                    background:#f8fbff;
                    padding:12px;
                    border-radius:10px;
                    margin-bottom:10px;
                }

                .empty{
                    color:#6b7280;
                    font-size:14px;
                    font-style:italic;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Welcome, {{ $firstName }}</h2>
                <p>This is your teacher dashboard overview.</p>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-label">Students</div>
                    <div class="stat-value">{{ $studentCount }}</div>
                    <div class="stat-note">Total students currently in the system</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Results</div>
                    <div class="stat-value">{{ $resultCount }}</div>
                    <div class="stat-note">Results already recorded</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Attendance</div>
                    <div class="stat-value">{{ $attendanceCount }}</div>
                    <div class="stat-note">Attendance records available</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Unread Messages</div>
                    <div class="stat-value">{{ $unreadCount }}</div>
                    <div class="stat-note">Unread notifications waiting</div>
                </div>
            </div>

            <div class="grid">
                <div class="card">
                    <div class="badge">Recent Alerts</div>
                    <h4>Latest system alerts</h4>

                    @forelse($alerts as $alert)
                        <div class="alert-box">
                            {{ $alert->message }}
                        </div>
                    @empty
                        <p class="empty">No alerts available.</p>
                    @endforelse
                </div>

                <div class="card">
                    <div class="badge">Notifications</div>
                    <h4>Recent notifications</h4>

                    @forelse($notifications as $notification)
                        <div class="alert-box">
                            {{ $notification->data['message'] ?? 'Notification' }}
                            @if(is_null($notification->read_at))
                                <div style="margin-top:6px; color:#dc2626; font-size:12px; font-weight:700;">
                                    New
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="empty">No notifications available.</p>
                    @endforelse
                </div>

                <div class="card">
                    <div class="badge">Teacher Summary</div>
                    <h4>Current activity</h4>
                    <ul class="list">
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

    buttons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            const type = this.dataset.type;

            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            if (type === 'overview') {
                e.preventDefault();
                pageTitle.textContent = 'Overview';
                pageSub.textContent = 'Your teacher dashboard summary.';
                frame.srcdoc = overviewHTML;
                return;
            }

            pageTitle.textContent = this.dataset.title || '';
            pageSub.textContent = this.dataset.sub || '';
        });
    });
</script>

</body>
</html>