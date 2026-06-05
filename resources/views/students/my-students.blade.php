<div style="font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 4px;">
            My Students
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            Students assigned to your class.
        </p>
    </div>

    @if(!$class)

        <div style="
            background:#fff3cd;
            color:#856404;
            padding:20px;
            border:1px solid #ffeeba;
            border-radius:12px;
            margin-bottom:20px;
        ">
            <h3 style="margin:0 0 8px 0; font-size:18px;">⚠ No Class Assigned</h3>

            <p style="margin:0 0 6px 0;">
                You do not currently have a class assigned.
            </p>

            <p style="margin:0;">
                Contact the administrator.
            </p>
        </div>

    @else

        {{-- Class Info --}}
        <div style="margin-bottom: 20px;">
            <span style="display:inline-flex; align-items:center; gap:5px;
                         padding:4px 10px; background:#f0f9ff;
                         border:1px solid #e0f2fe; border-radius:20px;
                         font-size:12px; font-weight:600; color:#0ea5e9;">
                <i class="ti ti-door" style="font-size:12px;"></i>
                {{ $class->name }}
            </span>
        </div>

        @if($students->count())

            {{-- Table --}}
            <div style="border: 1px solid #e0f2fe; border-radius: 12px; overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse;">

                    <thead style="background: #f0f9ff;">
                        <tr>
                            <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                        letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                        border-bottom: 1px solid #e0f2fe; width: 70px;">
                                #
                            </th>
                            <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                        letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                        border-bottom: 1px solid #e0f2fe;">
                                First Name
                            </th>
                            <th style="padding: 13px 18px; text-align: left; font-size: 11px; font-weight: 600;
                                        letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;
                                        border-bottom: 1px solid #e0f2fe;">
                                Last Name
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($students as $student)
                            <tr style="border-bottom: 1px solid #e0f2fe; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8fcff'"
                                onmouseout="this.style.background='transparent'">

                                {{-- Auto increment --}}
                                <td style="padding: 14px 18px; vertical-align: middle; color:#0c4a6e; font-weight:600;">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- First Name --}}
                                <td style="padding: 14px 18px; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 34px; height: 34px; border-radius: 8px;
                                                    background: linear-gradient(135deg,#0ea5e9,#06b6d4);
                                                    display: flex; align-items: center; justify-content: center;
                                                    color: white; font-weight: 600; font-size: 13px; flex-shrink: 0;">
                                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                        </div>
                                        <span style="font-size: 14px; color: #0c4a6e; font-weight: 500;">
                                            {{ $student->first_name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Last Name --}}
                                <td style="padding: 14px 18px; vertical-align: middle;">
                                    <span style="font-size: 14px; color: #0c4a6e; font-weight: 500;">
                                        {{ $student->last_name }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @else

            <div style="
                background:#d1ecf1;
                color:#0c5460;
                padding:20px;
                border:1px solid #bee5eb;
                border-radius:12px;
            ">
                No students have been assigned to {{ $class->name }}.
            </div>

        @endif

    @endif

</div>