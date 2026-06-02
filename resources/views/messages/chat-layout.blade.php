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
            --bg:             #f8fafc;
            --bubble-out:     #dbeafe;
            --bubble-in:      #ffffff;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            height: 100vh;
            display: flex;
            align-items: stretch;
            padding: 24px;
        }

        /* ── Shell ── */
        .chat-shell {
            display: flex;
            width: 100%;
            height: 100%;
            border: 1px solid var(--primary-border);
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 32px rgba(14, 165, 233, 0.10);
        }

        /* ────────────────────────────
           LEFT PANEL — contact list
        ──────────────────────────── */
        .left-panel {
            width: 300px;
            flex-shrink: 0;
            border-right: 1px solid var(--primary-border);
            display: flex;
            flex-direction: column;
            background: white;
        }

        .left-header {
            padding: 20px 20px 16px;
            border-bottom: 1px solid var(--primary-border);
        }

        .left-header h3 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 12px;
        }

        /* search inside left panel */
        .left-search {
            position: relative;
        }

        .left-search i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 15px;
            pointer-events: none;
        }

        .left-search input {
            width: 100%;
            padding: 9px 12px 9px 34px;
            border: 1px solid var(--primary-border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text);
            outline: none;
            background: var(--primary-light);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .left-search input::placeholder { color: var(--text-muted); }

        .left-search input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.10);
        }

        .contacts-list {
            flex: 1;
            overflow-y: auto;
        }

        .contacts-list::-webkit-scrollbar { width: 4px; }
        .contacts-list::-webkit-scrollbar-thumb {
            background: var(--primary-border);
            border-radius: 2px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--primary-border);
            text-decoration: none;
            color: var(--text);
            transition: background 0.15s;
        }

        .contact-item:hover,
        .contact-item.active {
            background: var(--primary-light);
        }

        .contact-item.active {
            border-left: 3px solid var(--primary);
        }

        .c-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, #06b6d4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 15px;
            font-weight: 600;
            flex-shrink: 0;
            box-shadow: 0 3px 8px rgba(14, 165, 233, 0.22);
        }

        .c-info { min-width: 0; }

        .c-name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .c-email {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ────────────────────────────
           RIGHT PANEL — chat area
        ──────────────────────────── */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background: var(--bg);
        }

        /* chat header */
        .chat-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--primary-border);
            background: white;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .chat-header .c-avatar { width: 38px; height: 38px; font-size: 14px; }

        .chat-header-info h3 {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
        }

        .chat-header-info span {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* messages body */
        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .chat-body::-webkit-scrollbar { width: 4px; }
        .chat-body::-webkit-scrollbar-thumb {
            background: var(--primary-border);
            border-radius: 2px;
        }

        /* bubbles */
        .bubble-row {
            display: flex;
        }

        .bubble-row.out { justify-content: flex-end; }
        .bubble-row.in  { justify-content: flex-start; }

        .bubble {
            max-width: 68%;
            padding: 11px 15px;
            border-radius: 14px;
            font-size: 13.5px;
            line-height: 1.55;
            color: var(--text);
            word-break: break-word;
        }

        .bubble-row.out .bubble {
            background: var(--bubble-out);
            border-bottom-right-radius: 4px;
        }

        .bubble-row.in .bubble {
            background: var(--bubble-in);
            border: 1px solid var(--primary-border);
            border-bottom-left-radius: 4px;
        }

        .bubble-time {
            display: block;
            font-size: 10.5px;
            color: var(--text-muted);
            margin-top: 5px;
            text-align: right;
        }

        .attachment-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            font-size: 12.5px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .attachment-link:hover { text-decoration: underline; }

        /* empty / select state */
        .empty-chat {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--text-muted);
        }

        .empty-chat i {
            font-size: 48px;
            color: var(--primary-border);
        }

        .empty-chat p {
            font-size: 14px;
        }

        /* send box */
        .send-box {
            padding: 16px 20px;
            border-top: 1px solid var(--primary-border);
            background: white;
        }

        .send-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .send-input {
            flex: 1;
            padding: 11px 16px;
            border: 1px solid var(--primary-border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            color: var(--text);
            background: var(--primary-light);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .send-input::placeholder { color: var(--text-muted); }

        .send-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.10);
            background: white;
        }

        .send-btn {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--primary);
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.28);
        }

        .send-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(14, 165, 233, 0.35);
        }

        /* ── Responsive ── */
        @media (max-width: 700px) {
            body { padding: 0; }

            .chat-shell { border-radius: 0; border: none; }

            .left-panel {
                width: 72px;
            }

            .left-header h3,
            .left-search,
            .c-info { display: none; }

            .contact-item { justify-content: center; padding: 12px; }

            .c-avatar { width: 44px; height: 44px; font-size: 16px; }
        }
    </style>
</head>

<body>
<div class="chat-shell">

    {{-- ── LEFT PANEL ── --}}
    <div class="left-panel">

        <div class="left-header">
            <h3>Chats</h3>
            <div class="left-search">
                <i class="ti ti-search"></i>
                <input type="text" id="contactSearch" placeholder="Search…">
            </div>
        </div>

        <div class="contacts-list" id="contactsList">
            @foreach($contacts as $contact)
                <a href="{{ route('messages.chat', $contact->id) }}"
                   class="contact-item {{ isset($selectedUser) && $selectedUser->id == $contact->id ? 'active' : '' }}"
                   data-name="{{ strtolower($contact->name) }}">

                    <div class="c-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>

                    <div class="c-info">
                        <div class="c-name">{{ $contact->name }}</div>
                        <div class="c-email">{{ $contact->email }}</div>
                    </div>

                </a>
            @endforeach
        </div>

    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="right-panel">

        @if(isset($selectedUser))

            {{-- Header --}}
            <div class="chat-header">
                <div class="c-avatar">{{ strtoupper(substr($selectedUser->name, 0, 1)) }}</div>
                <div class="chat-header-info">
                    <h3>{{ $selectedUser->name }}</h3>
                    <span>{{ $selectedUser->email }}</span>
                </div>
            </div>

            {{-- Messages --}}
            <div class="chat-body" id="chatBody">
                @forelse($messages as $msg)

                    <div class="bubble-row {{ $msg->sender_id == auth()->id() ? 'out' : 'in' }}">
                        <div class="bubble">

                            @if($msg->message)
                                {{ $msg->message }}
                            @endif

                            @if($msg->file)
                                <a href="{{ asset('storage/'.$msg->file) }}"
                                   target="_blank"
                                   class="attachment-link">
                                    <i class="ti ti-paperclip"></i> Attachment
                                </a>
                            @endif

                            <span class="bubble-time">
                                {{ $msg->created_at->format('d M Y, H:i') }}
                            </span>

                        </div>
                    </div>

                @empty
                    <div class="empty-chat">
                        <i class="ti ti-message-dots"></i>
                        <p>No messages yet. Say hello!</p>
                    </div>
                @endforelse
            </div>

            {{-- Send box --}}
            <div class="send-box">
                <form method="POST"
                      action="{{ route('messages.store') }}"
                      enctype="multipart/form-data"
                      class="send-form">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">

                    <input type="text"
                           name="message"
                           class="send-input"
                           placeholder="Type a message…"
                           autocomplete="off">

                    <button type="submit" class="send-btn">
                        <i class="ti ti-send"></i>
                    </button>
                </form>
            </div>

        @else

            <div class="empty-chat">
                <i class="ti ti-messages"></i>
                <p>Select a contact to start chatting.</p>
            </div>

        @endif

    </div>

</div>

<script>
    // Auto-scroll to latest message
    const chatBody = document.getElementById('chatBody');
    if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;

    // Live contact search
    document.getElementById('contactSearch')?.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.contact-item').forEach(item => {
            item.style.display = item.dataset.name.includes(q) ? '' : 'none';
        });
    });
</script>

</body>
</html>