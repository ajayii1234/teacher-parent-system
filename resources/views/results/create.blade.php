
    <h2>Add Result</h2>

    <form method="POST" action="{{ route('results.store') }}">
        @csrf

        <label>Student</label>
        <select name="student_id">
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->first_name }} {{ $student->last_name }}
                </option>
            @endforeach
        </select>
    
        <label>Subject</label>
        <select name="subject_id">
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>

        <label>CA Score (40)</label>
        <input type="number" name="ca_score">

        <label>Exam Score (60)</label>
        <input type="number" name="exam_score">

        <label>Term</label>
        <select name="term">
            <option>First Term</option>
            <option>Second Term</option>
            <option>Third Term</option>
        </select>

        <label>Session</label>
        <input type="text" name="session" placeholder="2025/2026">

        <button type="submit">Save Result</button>
    </form>
