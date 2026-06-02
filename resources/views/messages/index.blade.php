
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<style>
    :root {
        --primary: #0ea5e9;
        --primary-dark: #0284c7;
        --primary-light: #f0f9ff;
        --primary-border: #e0f2fe;
        --text: #0c4a6e;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border: #e0f2fe;
    }

    .inbox-wrap {
        padding: 32px 36px;
        font-family: 'DM Sans', sans-serif;
        background: white;
    }

    .inbox-head { margin-bottom: 28px; }

    .inbox-head h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 1.8rem;
        font-weight: 500;
        color: var(--text);
        margin-bottom: 6px;
    }

    .inbox-head p { color: var(--text-muted); font-size: 14px; }

    .msg-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 22px;
        margin-bottom: 14px;
        background: var(--primary-light);
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .msg-card:hover {
        border-color: var(--primary);
        box-shadow: 0 2px 12px rgba(14, 165, 233, 0.12);
    }

    .msg-card.unread { border-left: 3px solid var(--primary); }

    .msg-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sender-row { display: flex; align-items: center; gap: 10px; }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

    .sender-name { font-weight: 600; font-size: 14px; color: var(--text); }
    .sender-label { font-size: 12px; color: var(--text-muted); margin-top: 1px; }

    .unread-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fee2e2;
        color: #dc2626;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .student-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: white;
        border: 1px solid var(--border);
        color: var(--text-secondary);
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 6px;
        width: fit-content;
    }

    .msg-body {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .msg-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .chat-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        padding: 9px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .chat-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
        font-size: 14px;
    }

    .empty-state i {
        font-size: 40px;
        color: var(--primary-border);
        display: block;
        margin-bottom: 12px;
    }
</style>

<div class="inbox-wrap">
    <div class="inbox-head">
        <h2>Inbox</h2>
        <p>Messages from your child's teachers and school staff.</p>
    </div>

    @forelse($messages as $msg)
        @php
            $initials = collect(explode(' ', $msg->sender->name))
                ->map(fn($w) => strtoupper($w[0]))
                ->take(2)
                ->join('');
        @endphp

        <div class="msg-card {{ !$msg->is_read ? 'unread' : '' }}">

            {{-- TOP: sender + unread badge --}}
            <div class="msg-top">
                <div class="sender-row">
                    <div class="avatar">{{ $initials }}</div>
                    <div>
                        <div class="sender-name">{{ $msg->sender->name }}</div>
                        <div class="sender-label">Teacher</div>
                    </div>
                </div>

                @if(!$msg->is_read)
                    <span class="unread-badge">
                        <i class="ti ti-circle-filled" style="font-size:8px"></i> Unread
                    </span>
                @endif
            </div>

            {{-- STUDENT TAG --}}
            @if($msg->student)
                <div class="student-tag">
                    <i class="ti ti-user" style="font-size:13px; color:var(--primary)"></i>
                    {{ $msg->student->first_name }}
                </div>
            @endif

            {{-- MESSAGE --}}
            <div class="msg-body">{{ $msg->message }}</div>

            {{-- OPEN CHAT --}}
            <div class="msg-footer">
                <a href="{{ route('messages.chat', $msg->sender_id) }}" class="chat-btn">
                    <i class="ti ti-message-circle"></i>
                    Open Chat
                </a>
            </div>

        </div>
    @empty
        <div class="empty-state">
            <i class="ti ti-inbox"></i>
            No messages yet. Check back soon!
        </div>
    @endforelse
</div>