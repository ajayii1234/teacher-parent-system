

    @if(!$class)

        <div style="
            background:#fff3cd;
            color:#856404;
            padding:20px;
            border:1px solid #ffeeba;
            border-radius:8px;
            margin-bottom:20px;
        ">

            <h3>⚠ No Class Assigned</h3>

            <p>
                You currently do not have any class assigned to you.
            </p>

            <p>
                Please contact the school administrator to assign a class
                before viewing attendance records.
            </p>

        </div>

    @else

        <h2>
            Attendance Records - {{ $class->name }}
        </h2>

        @if($attendances->count() == 0)

            <div style="
                background:#d1ecf1;
                color:#0c5460;
                padding:20px;
                border-radius:8px;
                margin-top:20px;
            ">

                No attendance records have been created for
                {{ $class->name }} yet.

            </div>

        @else

            <table border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>

                @foreach($attendances as $attendance)

                    <tr>

                        {{-- STUDENT NAME --}}
                        <td>
                            {{ $attendance->student->first_name }}
                            {{ $attendance->student->last_name }}
                        </td>

                        {{-- CLASS --}}
                        <td>
                            {{ $attendance->student->class->name }}
                        </td>

                        {{-- DATE --}}
                        <td>
                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td>

                            @if($attendance->status == 'present')

                                <span style="color:green;font-weight:bold;">
                                    Present
                                </span>

                            @elseif($attendance->status == 'absent')

                                <span style="color:red;font-weight:bold;">
                                    Absent
                                </span>

                            @else

                                <span style="color:orange;font-weight:bold;">
                                    Late
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </table>

        @endif

    @endif

