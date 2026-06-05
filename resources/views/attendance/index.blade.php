<div style="max-width: 980px; font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Attendance Records
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            View attendance history for the assigned class.
        </p>
    </div>

    @if(!$class)

        <div style="background:#fef3c7; border:1px solid #fde68a; border-radius:14px; padding:22px;
                    color:#92400e; box-shadow:0 4px 12px rgba(245,158,11,0.08);">
            <div style="display:flex; align-items:flex-start; gap:12px;">
                <div style="width:38px; height:38px; border-radius:12px; background:#fff7ed;
                            display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <span style="font-size:18px;">⚠</span>
                </div>
                <div>
                    <h3 style="margin:0 0 8px 0; font-size:16px; font-weight:600; color:#92400e;">
                        No Class Assigned
                    </h3>
                    <p style="margin:0 0 6px 0; font-size:14px; line-height:1.6;">
                        You currently do not have any class assigned to you.
                    </p>
                    <p style="margin:0; font-size:14px; line-height:1.6;">
                        Please contact the school administrator to assign a class before viewing attendance records.
                    </p>
                </div>
            </div>
        </div>

    @else

        <div style="background:#f0f9ff; border:1px solid #e0f2fe; border-radius:14px; padding:18px 20px;
                    margin-bottom:22px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <div style="font-size:12px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:#94a3b8; margin-bottom:4px;">
                    Current Class
                </div>
                <div style="font-size:18px; font-weight:600; color:#0c4a6e;">
                    Attendance Records - {{ $class->name }}
                </div>
            </div>
            <div style="width:42px; height:42px; border-radius:12px; background:#e0f2fe;
                        display:flex; align-items:center; justify-content:center; color:#0ea5e9; font-weight:700;">
                R
            </div>
        </div>

        @if($attendances->count() == 0)

            <div style="background:#f0f9ff; color:#0c4a6e; padding:20px; border:1px solid #e0f2fe;
                        border-radius:14px; margin-top:20px;">
                No attendance records have been created for {{ $class->name }} yet.
            </div>

        @else


            <div style="background:#ffffff; border:1px solid #e0f2fe; border-radius:14px; padding:20px;
                        box-shadow:0 4px 12px rgba(14,165,233,0.06);">

                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:separate; border-spacing:0; font-family:'DM Sans', sans-serif;">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding:14px; font-size:12px; font-weight:600;
                                           letter-spacing:1.2px; text-transform:uppercase; color:#94a3b8;
                                           border-bottom:1px solid #e0f2fe;">
                                    Student
                                </th>
                                <th style="text-align:left; padding:14px; font-size:12px; font-weight:600;
                                           letter-spacing:1.2px; text-transform:uppercase; color:#94a3b8;
                                           border-bottom:1px solid #e0f2fe;">
                                    Class
                                </th>
                                <th style="text-align:left; padding:14px; font-size:12px; font-weight:600;
                                           letter-spacing:1.2px; text-transform:uppercase; color:#94a3b8;
                                           border-bottom:1px solid #e0f2fe;">
                                    Date
                                </th>
                                <th style="text-align:left; padding:14px; font-size:12px; font-weight:600;
                                           letter-spacing:1.2px; text-transform:uppercase; color:#94a3b8;
                                           border-bottom:1px solid #e0f2fe;">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td style="padding:14px; border-bottom:1px solid #f1f5f9; color:#0c4a6e; font-weight:500;">
                                        {{ $attendance->student->first_name }} {{ $attendance->student->last_name }}
                                    </td>

                                    <td style="padding:14px; border-bottom:1px solid #f1f5f9; color:#0c4a6e;">
                                        {{ $attendance->student->class->name }}
                                    </td>

                                    <td style="padding:14px; border-bottom:1px solid #f1f5f9; color:#0c4a6e;">
                                        {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                                    </td>

                                    <td style="padding:14px; border-bottom:1px solid #f1f5f9;">
                                        @if($attendance->status == 'present')
                                            <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 10px;
                                                         border-radius:999px; background:#dcfce7; color:#166534;
                                                         font-size:12px; font-weight:600;">
                                                <span style="width:8px; height:8px; border-radius:50%; background:#22c55e;"></span>
                                                Present
                                            </span>
                                        @elseif($attendance->status == 'absent')
                                            <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 10px;
                                                         border-radius:999px; background:#fee2e2; color:#991b1b;
                                                         font-size:12px; font-weight:600;">
                                                <span style="width:8px; height:8px; border-radius:50%; background:#ef4444;"></span>
                                                Absent
                                            </span>
                                        @else
                                            <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 10px;
                                                         border-radius:999px; background:#ffedd5; color:#9a3412;
                                                         font-size:12px; font-weight:600;">
                                                <span style="width:8px; height:8px; border-radius:50%; background:#f59e0b;"></span>
                                                Late
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        @endif

    @endif

</div>