
    <h2>Students</h2>

    @foreach($students as $student)
        <div>
            {{ $student->first_name }} {{ $student->last_name }}  
            - Class: {{ $student->class->name }}

            <br>
            Parents:
            @foreach($student->parents as $parent)
                {{ $parent->name }}
            @endforeach
        </div>
    @endforeach
