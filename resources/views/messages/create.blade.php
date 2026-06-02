<div style="padding: 40px; max-width: 640px; font-family: 'DM Sans', sans-serif;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Send Message
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            @if(auth()->user()->role === 'parent')
                Compose a message to your child's teacher below.
            @else
                Send a message to a parent below.
            @endif
        </p>
    </div>

    <form method="POST" action="{{ route('messages.store') }}">
        @csrf

        {{-- Receiver + Student row --}}
        <div style="display: grid; grid-template-columns: 1fr{{ auth()->user()->role === 'parent' ? ' 1fr' : '' }};
                    gap: 16px; margin-bottom: 20px;">

            {{-- Receiver --}}
            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Send To
                </label>
                <select name="receiver_id" style="width:100%; padding:12px 38px 12px 14px;
                    border:1px solid #e0f2fe; border-radius:10px; background:#f0f9ff url(
                    'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\'
                    viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\'
                    stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'
                    %3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                    color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                    outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                    @if(auth()->user()->role === 'parent')
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    @elseif(auth()->user()->role === 'teacher')
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- Student (parents only) --}}
            @if(auth()->user()->role === 'parent')
            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Regarding Student
                </label>
                <select name="student_id" style="width:100%; padding:12px 38px 12px 14px;
                    border:1px solid #e0f2fe; border-radius:10px; background:#f0f9ff url(
                    'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\'
                    viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\'
                    stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'
                    %3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                    color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                    outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif

        </div>

        {{-- Message --}}
        <div style="margin-bottom: 24px;">
            <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                           text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                Message
            </label>
            <textarea name="message" placeholder="Type your message here…"
                style="width:100%; padding:12px 14px; border:1px solid #e0f2fe; border-radius:10px;
                       background:#f0f9ff; color:#0c4a6e; font-family:'DM Sans',sans-serif;
                       font-size:14px; outline:none; resize:vertical; min-height:130px;
                       line-height:1.6; transition:all 0.2s;">
            </textarea>
        </div>

        {{-- Submit --}}
        <div style="display:flex; justify-content:flex-end;">
            <button type="submit"
                style="display:inline-flex; align-items:center; gap:8px; padding:13px 28px;
                       background:linear-gradient(135deg,#0ea5e9 0%,#06b6d4 100%); color:white;
                       border:none; border-radius:10px; font-family:'DM Sans',sans-serif;
                       font-size:14px; font-weight:600; cursor:pointer;
                       box-shadow:0 4px 12px rgba(14,165,233,0.25); transition:all 0.2s;">
                <i class="ti ti-send" style="font-size:16px;"></i>
                Send Message
            </button>
        </div>

    </form>
</div>

<style>
    select:focus, textarea:focus {
        border-color: #0ea5e9!important;
        box-shadow: 0 0 0 3px rgba(14,165,233,0.12)!important;
        background: #fff!important;
    }
    button[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14,165,233,0.35)!important;
    }
    textarea::placeholder { color: #94a3b8; }
</style>