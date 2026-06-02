

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
                before you can take attendance.
            </p>

        </div>

    @else

        <h2>
            Attendance - {{ $class->name }}
        </h2>

        @if($students->count() == 0)

            <div style="
                background:#d1ecf1;
                color:#0c5460;
                padding:20px;
                border-radius:8px;
                margin-bottom:20px;
            ">

                No students have been assigned to
                {{ $class->name }} yet.

            </div>

        @else

            <form method="POST" action="{{ route('attendance.store') }}">
                @csrf

                <table border="1" cellpadding="10">

                    <tr>
                        <th>Student</th>
                        <th>Status</th>
                    </tr>

                    @foreach($students as $student)

                        <tr>

                            <td>
                                {{ $student->first_name }}
                                {{ $student->last_name }}
                            </td>

                            <td>

                                <select name="attendance[{{ $student->id }}]">

                                    <option value="present">
                                        Present
                                    </option>

                                    <option value="absent">
                                        Absent
                                    </option>

                                    <option value="late">
                                        Late
                                    </option>

                                </select>

                            </td>

                        </tr>

                    @endforeach

                </table>

                <br>

                <button type="submit">
                    Save Attendance
                </button>

            </form>

        @endif

    @endif

