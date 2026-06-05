<div style="max-width: 780px; font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Attendance
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            Record student attendance for the assigned class.
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
                        Please contact the school administrator to assign a class before you can take attendance.
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
                    {{ $class->name }}
                </div>
            </div>
            <div style="width:42px; height:42px; border-radius:12px; background:#e0f2fe;
                        display:flex; align-items:center; justify-content:center; color:#0ea5e9; font-weight:700;">
                A
            </div>
        </div>

        @if($students->count() == 0)

            <div style="background:#f0f9ff; color:#0c4a6e; padding:20px; border:1px solid #e0f2fe;
                        border-radius:14px; margin-bottom:20px;">
                No students have been assigned to {{ $class->name }} yet.
            </div>

        @else

            <div style="background:#ffffff; border:1px solid #e0f2fe; border-radius:14px; padding:20px;
                        box-shadow:0 4px 12px rgba(14,165,233,0.06);">

                <form method="POST" action="{{ route('attendance.store') }}">
                    @csrf

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
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td style="padding:14px; border-bottom:1px solid #f1f5f9; color:#0c4a6e; font-weight:500;">
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </td>
                                        <td style="padding:14px; border-bottom:1px solid #f1f5f9;">
                                            <select name="attendance[{{ $student->id }}]"
                                                style="width:100%; max-width:220px; padding:12px 38px 12px 14px;
                                                       border:1px solid #e0f2fe; border-radius:10px; background:#f0f9ff;
                                                       color:#0c4a6e; font-family:'DM Sans',sans-serif; font-size:14px;
                                                       outline:none; appearance:none; -webkit-appearance:none; cursor:pointer;
                                                       background-image:url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2712%27 height=%2712%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%230ea5e9%27 stroke-width=%272.5%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Cpolyline points=%276 9 12 15 18 9%27/%3E%3C/svg%3E');
                                                       background-repeat:no-repeat; background-position:right 14px center;">
                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                                <option value="late">Late</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="display:flex; justify-content:flex-end; margin-top:24px;">
                        <button type="submit"
                                style="display:inline-flex; align-items:center; gap:8px; padding:13px 28px;
                                       background:linear-gradient(135deg,#0ea5e9,#06b6d4); color:white;
                                       border:none; border-radius:10px; font-family:'DM Sans',sans-serif;
                                       font-size:14px; font-weight:600; cursor:pointer;
                                       box-shadow:0 4px 12px rgba(14,165,233,0.25); transition:all 0.2s;">
                            <i class="ti ti-device-floppy" style="font-size:16px;"></i>
                            Save Attendance
                        </button>
                    </div>

                </form>
            </div>

        @endif

    @endif

</div>

<style>
    select:focus {
        border-color: #0ea5e9 !important;
        box-shadow: 0 0 0 3px rgba(14,165,233,0.12) !important;
        background-color: white !important;
    }

    button[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(14,165,233,0.35) !important;
    }
</style>