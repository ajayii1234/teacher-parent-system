@php
    $userInitial = fn($name) => strtoupper(substr($name, 0, 1));
@endphp

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary:        #0ea5e9;
            --primary-dark:   #0284c7;
            --primary-light:  #f0f9ff;
            --primary-border: #e0f2fe;
            --text:           #0c4a6e;
            --text-secondary: #475569;
            --text-muted:     #94a3b8;
            --border:         #e0f2fe;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8fafc;
            color: var(--text);
            min-height: 100vh;
            padding: 36px 40px;
        }

        /* ── Header ── */
        .page-header {
            margin-bottom: 32px;
            animation: fadeUp 0.4s ease-out;
        }

        .page-header h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 6px;
        }

        .page-header p {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ── Search ── */
        .search-wrap {
            position: relative;
            margin-bottom: 28px;
            max-width: 420px;
            animation: fadeUp 0.45s ease-out;
        }

        .search-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 17px;
            pointer-events: none;
        }

        .search-wrap input {
            width: 100%;
            padding: 11px 16px 11px 42px;
            border: 1px solid var(--primary-border);
            border-radius: 10px;
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-wrap input::placeholder { color: var(--text-muted); }

        .search-wrap input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
        }

        /* ── Grid ── */
        .contacts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 18px;
        }

        /* ── Card ── */
        .contact-card {
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: 14px;
            padding: 22px 22px 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            animation: fadeUp 0.4s ease-out both;
        }

        .contact-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.12);
            border-color: var(--primary);
        }

        .card-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(14, 165, 233, 0.25);
        }

        .contact-info { flex: 1; min-width: 0; }

        .contact-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .contact-email {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── Button ── */
        .chat-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 0;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--primary-border);
            border-radius: 10px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .chat-btn i { font-size: 16px; }

        .chat-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        /* ── Empty state ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 40px;
            color: var(--primary-border);
            margin-bottom: 12px;
            display: block;
        }

        .empty-state p { font-size: 14px; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            body { padding: 24px 20px; }
            .page-header h2 { font-size: 1.5rem; }
            .contacts-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <div class="page-header">
        <h2>Chats</h2>
        <p>Select a contact to open a conversation.</p>
    </div>

    <div class="search-wrap">
        <i class="ti ti-search"></i>
        <input type="text" id="searchInput" placeholder="Search contacts…">
    </div>

    <div class="contacts-grid" id="contactsGrid">
        @forelse($contacts as $index => $contact)
            <div class="contact-card" style="animation-delay: {{ $index * 0.06 }}s" data-name="{{ strtolower($contact->name) }}">
                <div class="card-top">
                    <div class="avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                    <div class="contact-info">
                        <div class="contact-name">{{ $contact->name }}</div>
                        <div class="contact-email">{{ $contact->email }}</div>
                        @if($contact->role === 'teacher' && $contact->classTeacher)

<div style="font-size:12px;color:#25D366;margin-top:3px;">
    Class Teacher:
    {{ $contact->classTeacher->name }}
</div>

@endif
                    </div>
                </div>

                <a href="{{ route('messages.chat', $contact->id) }}" class="chat-btn">
                    <i class="ti ti-message-circle"></i>
                    Open Chat
                </a>
            </div>
        @empty
            <div class="empty-state">
                <i class="ti ti-messages-off"></i>
                <p>No contacts available yet.</p>
            </div>
        @endforelse
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.contact-card').forEach(card => {
                card.style.display = card.dataset.name.includes(query) ? '' : 'none';
            });
        });
    </script>

</body>
</html>