@php

$firstName = explode(' ', auth()->user()->name)[0];

$alerts = \App\Models\Alert::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

$notifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(5)
            ->get();

@endphp

<h2>
    Welcome, {{ $firstName }}! 👋
</h2>

<p>
    Here's your child's latest information and updates.
</p>

<hr>

<h3>🔔 Recent Alerts</h3>

@forelse($alerts as $alert)

    <div class="box alert-card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
        ">

            <div>

                {{ $alert->message }}

                <br>

                <small>
                    {{ $alert->created_at->format('d M Y h:i A') }}
                </small>

            </div>

            <form method="POST"
                  action="{{ route('alerts.delete', $alert->id) }}">
                @csrf
                @method('DELETE')

                <button type="submit">
                    ✕
                </button>

            </form>

        </div>

    </div>

@empty

    <p>No alerts at the moment.</p>

@endforelse


<hr>

<h3>📩 Notifications</h3>

@forelse($notifications as $notification)

    <div class="box notification-card">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
        ">

            <div>

                {{ $notification->data['message'] }}

                @if(is_null($notification->read_at))

                    <span style="color:red;">
                        ● NEW
                    </span>

                @endif

                <br>

                <small>
                    {{ $notification->created_at->format('d M Y h:i A') }}
                </small>

            </div>

            <form method="POST"
                  action="{{ route('notifications.delete', $notification->id) }}">
                @csrf
                @method('DELETE')

                <button type="submit">
                    ✕
                </button>

            </form>

        </div>

    </div>

@empty

    <p>No notifications.</p>

@endforelse