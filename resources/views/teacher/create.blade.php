<div style="max-width: 580px; font-family: 'DM Sans', sans-serif;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Create Teacher
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            Fill in the details below to register a new teacher account.
        </p>
    </div>
    
    {{-- Success --}}
    @if(session('success'))
        <div style="display:flex; align-items:flex-start; gap:10px; padding:12px 16px;
                    background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px;
                    color:#166534; font-size:13px; margin-bottom:20px;">
            <i class="ti ti-circle-check" style="font-size:17px; flex-shrink:0; margin-top:1px;"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
        <div style="display:flex; align-items:flex-start; gap:10px; padding:12px 16px;
                    background:#fff1f2; border:1px solid #fecdd3; border-radius:10px;
                    color:#9f1239; font-size:13px; margin-bottom:20px;">
            <i class="ti ti-alert-circle" style="font-size:17px; flex-shrink:0; margin-top:1px;"></i>
            <ul style="margin:0; padding-left:16px;">
                @foreach($errors->all() as $error)
                    <li style="margin-bottom:3px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf

        {{-- Name + Email --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Full Name
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="e.g. Mr. James Okonkwo"
                       style="width:100%; padding:12px 14px; border:1px solid #e0f2fe;
                              border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                              font-family:'DM Sans',sans-serif; font-size:14px; outline:none;
                              transition:all 0.2s;">
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Email Address
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="teacher@school.edu"
                       style="width:100%; padding:12px 14px; border:1px solid #e0f2fe;
                              border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                              font-family:'DM Sans',sans-serif; font-size:14px; outline:none;
                              transition:all 0.2s;">
            </div>

        </div>

        {{-- Password + Class --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Password
                </label>
                <div style="position:relative;">
                    <input type="password" name="password" id="teacherPassword"
                           placeholder="Set a password"
                           style="width:100%; padding:12px 44px 12px 14px; border:1px solid #e0f2fe;
                                  border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                                  font-family:'DM Sans',sans-serif; font-size:14px; outline:none;
                                  transition:all 0.2s;">
                    <button type="button" onclick="togglePassword()"
                            style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                   background:none; border:none; color:#94a3b8; cursor:pointer;
                                   font-size:17px; display:flex; align-items:center;">
                        <i class="ti ti-eye" id="pwIcon"></i>
                    </button>
                </div>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Assign Class
                </label>
                <select name="class_id"
                        style="width:100%; padding:12px 38px 12px 14px; border:1px solid #e0f2fe;
                               border-radius:10px; background:#f0f9ff url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'%3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                               color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                               outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                    <option disabled selected value="">— Select Class —</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}"
                            {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- Submit --}}
        <div style="display:flex; justify-content:flex-end;">
            <button type="submit"
                    style="display:inline-flex; align-items:center; gap:8px; padding:13px 28px;
                           background:linear-gradient(135deg,#0ea5e9,#06b6d4); color:white;
                           border:none; border-radius:10px; font-family:'DM Sans',sans-serif;
                           font-size:14px; font-weight:600; cursor:pointer;
                           box-shadow:0 4px 12px rgba(14,165,233,0.25); transition:all 0.2s;">
                <i class="ti ti-user-check" style="font-size:16px;"></i>
                Create Teacher
            </button>
        </div>

    </form>
</div>

<style>
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus {
        border-color: #0ea5e9 !important;
        box-shadow: 0 0 0 3px rgba(14,165,233,0.12) !important;
        background: white !important;
    }
    button[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14,165,233,0.35) !important;
    }
    input::placeholder { color: #94a3b8; }
</style>

<script>
    function togglePassword() {
        const input = document.getElementById('teacherPassword');
        const icon  = document.getElementById('pwIcon');
        if (input.type === 'password') {
            input.type     = 'text';
            icon.className = 'ti ti-eye-off';
        } else {
            input.type     = 'password';
            icon.className = 'ti ti-eye';
        }
    }
</script>