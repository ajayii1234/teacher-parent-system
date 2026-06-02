
    <div style="max-width: 600px; margin: auto;">
        
        <h2 style="font-size: 24px; margin-bottom: 20px;">Add Student</h2>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('students.store') }}">
            @csrf
    
            {{-- FIRST NAME --}}
            <div style="margin-bottom: 15px;">
                <label>First Name</label><br>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                       style="width: 100%; padding: 8px;">
            </div>

            {{-- LAST NAME --}}
            <div style="margin-bottom: 15px;">
                <label>Last Name</label><br>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                       style="width: 100%; padding: 8px;">
            </div>

            {{-- CLASS (HARDCODED) --}}
            <div style="margin-bottom: 15px;">
                <label>Select Class</label><br>
                <select name="class_id" style="width: 100%; padding: 8px;">
                @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
                </select>
            </div>

            {{-- SINGLE PARENT SELECT --}}
            <div style="margin-bottom: 15px;">
                <label>Select Parent</label><br>
                <select name="parent_id" style="width: 100%; padding: 8px;">
                    <option disabled selected>-- Select Parent --</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">
                            {{ $parent->name }} ({{ $parent->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    style="padding: 10px 20px; background: #3490dc; color: white; border: none; border-radius: 5px;">
                Save Student
            </button>

        </form>
    </div>
