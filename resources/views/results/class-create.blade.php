@if(!$class)

<div style="
    background:#fff3cd;
    color:#856404;
    padding:20px;
    border-radius:8px;
">

    <h3>⚠ No Class Assigned</h3>

    <p>
        You currently do not have a class assigned.
    </p>

</div>

@else
<div style="max-width: 580px; font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Add Result - {{ $class->name ?? 'No Class Assigned' }}
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            Enter the student's assessment scores for the selected term.
        </p>
    </div>

    <form method="POST" action="{{ route('results.class.store') }}">
        @csrf

        {{-- Student + Subject --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Student
                </label>
                <select name="student_id"
                        style="width:100%; padding:12px 38px 12px 14px; border:1px solid #e0f2fe;
                               border-radius:10px; background:#f0f9ff url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'%3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                               color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                               outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                 @foreach($students as $student)
                    <option value="{{ $student->id }}"
                        {{ old('student_id') == $student->id ? 'selected' : '' }}>

                        {{ $student->first_name }}
                        {{ $student->last_name }}

                        <!-- @if($student->class)
                            ({{ $student->class->name }})
                        @endif -->

                    </option>
                @endforeach
                </select>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Subject
                </label>
                <select name="subject_id"
                        style="width:100%; padding:12px 38px 12px 14px; border:1px solid #e0f2fe;
                               border-radius:10px; background:#f0f9ff url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'%3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                               color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                               outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- CA Score + Exam Score --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    CA Score <span style="font-size:11px; font-weight:400; letter-spacing:0;
                                          text-transform:none;">(max 40)</span>
                </label>
                <input type="number" name="ca_score" min="0" max="40"
                       value="{{ old('ca_score') }}" placeholder="0 – 40"
                       style="width:100%; padding:12px 14px; border:1px solid #e0f2fe;
                              border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                              font-family:'DM Sans',sans-serif; font-size:14px;
                              outline:none; transition:all 0.2s;">
                <div style="font-size:11px; color:#94a3b8; margin-top:5px;">
                    Continuous Assessment
                </div>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Exam Score <span style="font-size:11px; font-weight:400; letter-spacing:0;
                                            text-transform:none;">(max 60)</span>
                </label>
                <input type="number" name="exam_score" min="0" max="60"
                       value="{{ old('exam_score') }}" placeholder="0 – 60"
                       style="width:100%; padding:12px 14px; border:1px solid #e0f2fe;
                              border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                              font-family:'DM Sans',sans-serif; font-size:14px;
                              outline:none; transition:all 0.2s;">
                <div style="font-size:11px; color:#94a3b8; margin-top:5px;">
                    End of Term Examination
                </div>
            </div>

        </div>

        {{-- Term + Session --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px;">

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Term
                </label>
                <select name="term"
                        style="width:100%; padding:12px 38px 12px 14px; border:1px solid #e0f2fe;
                               border-radius:10px; background:#f0f9ff url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230ea5e9\' stroke-width=\'2.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'%3E%3C/polyline%3E%3C/svg%3E') no-repeat right 14px center;
                               color:#0c4a6e; font-family:\'DM Sans\',sans-serif; font-size:14px;
                               outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;">
                    <option {{ old('term') == 'First Term'  ? 'selected' : '' }}>First Term</option>
                    <option {{ old('term') == 'Second Term' ? 'selected' : '' }}>Second Term</option>
                    <option {{ old('term') == 'Third Term'  ? 'selected' : '' }}>Third Term</option>
                </select>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; letter-spacing:1.5px;
                               text-transform:uppercase; color:#94a3b8; margin-bottom:8px;">
                    Session
                </label>
                <input type="text" name="session" value="{{ old('session') }}"
                       placeholder="e.g. 2025/2026"
                       style="width:100%; padding:12px 14px; border:1px solid #e0f2fe;
                              border-radius:10px; background:#f0f9ff; color:#0c4a6e;
                              font-family:'DM Sans',sans-serif; font-size:14px;
                              outline:none; transition:all 0.2s;">
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
                <i class="ti ti-device-floppy" style="font-size:16px;"></i>
                Save Result
            </button>
        </div>

    </form>
</div>

<style>
    input[type="number"]:focus,
    input[type="text"]:focus,
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
    input[type="number"]::-webkit-inner-spin-button { opacity: 0.4; }
</style>

@endif