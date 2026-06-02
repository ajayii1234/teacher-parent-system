<x-app-layout>

    <h2>Teachers</h2>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Assigned Class</th>
        </tr>

        @forelse($teachers as $teacher)

            <tr>

                {{-- NAME --}}
                <td>
                    {{ $teacher->name }}
                </td>

                {{-- EMAIL --}}
                <td>
                    {{ $teacher->email }}
                </td>

                {{-- CLASS --}}
                <td>

                    @if($teacher->classTeacher)

                        {{ $teacher->classTeacher->name }}

                    @else

                        <span style="color:red;">
                            No class assigned
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3">

                    No teachers found.

                </td>

            </tr>

        @endforelse

    </table>

</x-app-layout>