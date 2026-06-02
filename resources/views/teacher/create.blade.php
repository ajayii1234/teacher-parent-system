<x-app-layout>

    <div style="max-width:600px; margin:auto;">

        <h2>Create Teacher</h2>

        @if(session('success'))
            <div style="color:green; margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())

            <div style="color:red; margin-bottom:10px;">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form method="POST" action="{{ route('teachers.store') }}">

            @csrf

            {{-- NAME --}}
            <div style="margin-bottom:15px;">

                <label>Name</label>

                <input type="text"
                       name="name"
                       style="width:100%; padding:8px;">

            </div>

            {{-- EMAIL --}}
            <div style="margin-bottom:15px;">

                <label>Email</label>

                <input type="email"
                       name="email"
                       style="width:100%; padding:8px;">

            </div>

            {{-- PASSWORD --}}
            <div style="margin-bottom:15px;">

                <label>Password</label>

                <input type="password"
                       name="password"
                       style="width:100%; padding:8px;">

            </div>

            {{-- CLASS --}}
            <div style="margin-bottom:15px;">

                <label>Assign Class</label>

                <select name="class_id"
                        style="width:100%; padding:8px;">

                    <option disabled selected>
                        -- Select Class --
                    </option>

                    @foreach($classes as $class)

                        <option value="{{ $class->id }}">

                            {{ $class->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit"
                    style="padding:10px 15px; background:#3490dc; color:white; border:none; border-radius:5px;">

                Create Teacher

            </button>

        </form>

    </div>

</x-app-layout>