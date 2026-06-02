<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Parent Portal</title>

    <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
</head>

<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="logo">
            Parent Portal
        </div>

        <nav>

            <a href="{{ route('parent.dashboard') }}">
                Overview
            </a>

            <a href="{{ route('parent.results') }}">
                Results
            </a>

            <a href="{{ route('parent.attendance') }}">
                Attendance
            </a>

            <a href="{{ route('chats.index') }}">
                Chats
            </a>

        </nav>

    </aside>

    {{-- MAIN --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div>
                {{ auth()->user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>

        </div>

        {{-- PAGE CONTENT --}}
        <div class="content">

            @yield('content')

        </div>

    </main>

</div>

</body>

</html>