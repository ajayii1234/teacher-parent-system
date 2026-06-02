
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

@php
    $other = $messages->first()?->sender_id == auth()->id()
        ? $messages->first()?->receiver
        : $messages->first()?->sender;

    $initials = collect(explode(' ', $other?->name ?? 'T'))
        ->map(fn($w) => strtoupper($w[0]))
        ->take(2)
        ->join('');

    $myInitial = strtoupper(substr(auth()->user()->name, 0, 1));
@endphp

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

    .chat-page {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 70px); /* matches --topbar-height */
        font-family: 'DM Sans', sans-serif;
        background: white;
    }

    /* ── Header ── */
    .chat-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        background: var(--primary-light);
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .chat-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 15px;
        flex-shrink: 0;
    }

    .chat-name { font-weight: 600; font-size: 15px; color: var(--text); }
    .chat-sub  { font-size: 12px; color: var(--text-muted); margin-top: 1px; }

    /* ── Message area ── */
    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #f8fafc;
    }

    .chat-body::-webkit-scrollbar { width: 5px; }
    .chat-body::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

    /* ── Bubbles ── */
    .bubble-row { display: flex; align-items: flex-end; gap: 8px; }
    .bubble-row.mine { flex-direction: row-reverse; }

    .bubble-avi {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        flex-shrink: 0;
        background: #e2e8f0;
        color: var(--text-secondary);
    }

    .bubble-avi.mine {
        background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
        color: white;
    }

    .bubble {
        max-width: 65%;
        padding: 11px 15px;
        font-size: 14px;
        line-height: 1.55;
        border-radius: 14px;
    }

    .bubble.theirs {
        background: white;
        border: 1px solid var(--border);
        color: var(--text);
        border-bottom-left-radius: 4px;
    }

    .bubble.mine {
        background: var(--primary);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .bubble-time {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .bubble-row.mine .bubble-time { text-align: right; }

    /* ── Attachment link ── */
    .attach-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 8px;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 6px;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .attach-link:hover { opacity: 0.8; }

    .attach-link.theirs {
        background: var(--primary-light);
        color: var(--primary);
        border: 1px solid var(--border);
    }

    .attach-link.mine {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
    }

    /* ── Footer ── */
    .chat-footer {
        border-top: 1px solid var(--border);
        padding: 16px 24px;
        background: white;
        flex-shrink: 0;
    }

    .file-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .file-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: var(--primary-light);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--primary);
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .file-label:hover { border-color: var(--primary); background: #e0f7ff; }

    .file-name { font-size: 12px; color: var(--text-muted); }

    .input-row { display: flex; gap: 10px; align-items: flex-end; }

    .msg-textarea {
        flex: 1;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 11px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: var(--text);
        resize: none;
        outline: none;
        background: var(--primary-light);
        transition: border-color 0.2s;
        line-height: 1.5;
        min-height: 44px;
        max-height: 120px;
    }

    .msg-textarea:focus { border-color: var(--primary); background: white; }
    .msg-textarea::placeholder { color: var(--text-muted); }

    .send-btn {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: var(--primary);
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .send-btn:hover { background: var(--primary-dark); transform: translateY(-1px); }
</style>

<div class="chat-page">

    {{-- HEADER --}}
    <div class="chat-header">
        <div class="chat-avatar">{{ $initials }}</div>
        <div>
            <div class="chat-name">{{ $other?->name ?? 'Teacher' }}</div>
            <div class="chat-sub">Teacher</div>
        </div>
    </div>

    {{-- MESSAGES --}}
    <div class="chat-body" id="chatBody">
        @foreach($messages as $msg)
            @php $isMine = $msg->sender_id == auth()->id(); @endphp

            <div class="bubble-row {{ $isMine ? 'mine' : '' }}">
                <div class="bubble-avi {{ $isMine ? 'mine' : '' }}">
                    {{ $isMine ? $myInitial : $initials }}
                </div>
                <div>
                    <div class="bubble {{ $isMine ? 'mine' : 'theirs' }}">
                        {{ $msg->message }}

                        @if($msg->file)
                            <div>
                                <a href="{{ asset('storage/' . $msg->file) }}"
                                   target="_blank"
                                   class="attach-link {{ $isMine ? 'mine' : 'theirs' }}">
                                    <i class="ti ti-paperclip"></i>
                                    Attachment
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="bubble-time">
                        {{ $msg->created_at->format('g:i A') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- COMPOSE --}}
    <div class="chat-footer">
        <form method="POST" action="{{ route('messages.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $userId }}">

            <div class="file-row">
                <label class="file-label" for="fileInput">
                    <i class="ti ti-paperclip"></i> Attach file
                </label>
                <span class="file-name" id="fileName">No file chosen</span>
                <input type="file" name="file" id="fileInput" style="display:none"
                    onchange="document.getElementById('fileName').textContent = this.files[0]?.name || 'No file chosen'">
            </div>

            <div class="input-row">
                <textarea name="message"
                          class="msg-textarea"
                          placeholder="Type a message…"
                          rows="1"
                          oninput="this.style.height='auto'; this.style.height=Math.min(this.scrollHeight,120)+'px'"
                          required></textarea>

                <button type="submit" class="send-btn" aria-label="Send message">
                    <i class="ti ti-send"></i>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    // Auto-scroll to latest message on load
    const chatBody = document.getElementById('chatBody');
    chatBody.scrollTop = chatBody.scrollHeight;
</script>
