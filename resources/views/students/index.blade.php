<div style="font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 4px;">
            Students
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            All enrolled students and their assigned classes.
        </p>
    </div>

    {{-- Table --}}
    <div style="border: 1px solid #e0f2fe; border-radius: 12px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">

            <thead style="background: #f0f9ff;">
                <tr>
                    <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                border-bottom: 1px solid #e0f2fe;">
                        Student
                    </th>
                    <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                border-bottom: 1px solid #e0f2fe;">
                        Class
                    </th>
                    <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                border-bottom: 1px solid #e0f2fe;">
                        Parent(s)
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr style="border-bottom: 1px solid #e0f2fe; transition: background 0.15s;"
                        onmouseover="this.style.background='#f8fcff'"
                        onmouseout="this.style.background='transparent'">

                        {{-- Student Name + Avatar --}}
                        <td style="padding: 14px 18px; vertical-align: middle;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 34px; height: 34px; border-radius: 8px;
                                            background: linear-gradient(135deg,#0ea5e9,#06b6d4);
                                            display: flex; align-items: center; justify-content: center;
                                            color: white; font-weight: 600; font-size: 13px; flex-shrink: 0;">
                                    {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                </div>
                                <span style="font-size: 14px; color: #0c4a6e; font-weight: 500;">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </span>
                            </div>
                        </td>

                        {{-- Class --}}
                        <td style="padding: 14px 18px; vertical-align: middle;">
                            <span style="display:inline-flex; align-items:center; gap:5px;
                                         padding:4px 10px; background:#f0f9ff;
                                         border:1px solid #e0f2fe; border-radius:20px;
                                         font-size:12px; font-weight:600; color:#0ea5e9;">
                                <i class="ti ti-door" style="font-size:12px;"></i>
                                {{ $student->class->name }}
                            </span>
                        </td>

                        {{-- Parents --}}
                        <td style="padding: 14px 18px; vertical-align: middle;">
                            @forelse($student->parents as $parent)
                                <span style="display:inline-flex; align-items:center; gap:5px;
                                             padding:3px 9px; background:#f8fafc;
                                             border:1px solid #e0f2fe; border-radius:20px;
                                             font-size:12px; color:#475569;
                                             margin-right:5px; margin-bottom:3px;">
                                    <i class="ti ti-user" style="font-size:11px;"></i>
                                    {{ $parent->name }}
                                </span>
                            @empty
                                <span style="display:inline-flex; align-items:center; gap:5px;
                                             padding:4px 10px; background:#fff1f2;
                                             border:1px solid #fecdd3; border-radius:20px;
                                             font-size:12px; font-weight:600; color:#e11d48;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>
                                    No parent linked
                                </span>
                            @endforelse
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3"
                            style="text-align: center; padding: 48px 20px;
                                   color: #94a3b8; font-size: 14px;">
                            <i class="ti ti-users" style="font-size: 40px; display: block;
                                                           margin-bottom: 10px; color: #bae6fd;"></i>
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>