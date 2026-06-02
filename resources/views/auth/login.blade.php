<x-guest-layout>
    {{-- Suppress the default Laravel logo rendered by x-guest-layout --}}
    <x-slot name="logo"></x-slot>
    
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

    .login-root * { box-sizing: border-box; }
    .login-root { font-family: 'DM Sans', sans-serif; font-weight: 300; }
    .font-serif { font-family: 'DM Serif Display', serif; }

    .live-dot {
        display: inline-block; width: 7px; height: 7px;
        border-radius: 50%; background: #16a34a;
        margin-right: 5px; vertical-align: middle;
        animation: livepulse 2s ease-in-out infinite;
    }
    @keyframes livepulse { 0%,100%{opacity:1} 50%{opacity:0.25} }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e0f2fe;
        border-radius: 10px;
        background: #f0f9ff;
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        color: #0c4a6e;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input::placeholder { color: #94a3b8; }
    .form-input:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14,165,233,0.12);
        background: #fff;
    }

    .pw-wrapper { position: relative; }
    .pw-toggle {
        position: absolute; right: 12px; top: 50%;
        transform: translateY(-50%);
        background: none; border: none; cursor: pointer;
        color: #94a3b8; font-size: 16px; padding: 0;
        display: flex; align-items: center;
        transition: color 0.2s;
    }
    .pw-toggle:hover { color: #0ea5e9; }

    .btn-primary {
        width: 100%; padding: 0.8rem 1.5rem;
        background: #0ea5e9; color: #fff;
        border: none; border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px; font-weight: 600;
        cursor: pointer; display: flex;
        align-items: center; justify-content: center; gap: 8px;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-primary:hover { background: #0284c7; }
    .btn-primary:active { transform: scale(0.98); }

    .stat-card {
        border: 1px solid #e0f2fe;
        border-radius: 12px;
        padding: 1rem;
        background: #f0f9ff;
    }

    /* Fade-in animation */
    .fade-up {
        opacity: 0; transform: translateY(16px);
        animation: fadeUp 0.5s ease forwards;
    }
    @keyframes fadeUp { to { opacity:1; transform:translateY(0); } }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>

<div class="login-root min-h-screen bg-white flex">

    <!-- ── LEFT PANEL (image + info) ── -->
    <div class="hidden lg:flex lg:w-1/2 relative flex-col overflow-hidden">

        <!-- Background image -->
        <img
            src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1200&q=80"
            alt="School environment"
            class="absolute inset-0 w-full h-full object-cover object-center"
        >
        <!-- Overlays -->
        <div class="absolute inset-0 bg-slate-900/55"></div>
        <div class="absolute inset-0 bg-sky-900/35"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col justify-between h-full p-10">

            <!-- Logo -->
            <div class="flex items-center gap-3 fade-up">
                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 3l8 4-8 4-8-4 8-4Z"/>
                        <path d="M4 11l8 4 8-4"/>
                        <path d="M4 15l8 4 8-4"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-semibold text-white">{{ config('app.name', 'School Alert System') }}</div>
                    <div class="text-[10px] text-sky-300 font-medium">Records · Attendance · Behaviour · Alerts</div>
                </div>
            </div>

            <!-- Headline -->
            <div class="fade-up delay-1">
                <div class="inline-flex items-center gap-2 text-[11px] font-semibold tracking-widest uppercase text-sky-300 bg-white/10 border border-white/20 rounded-full px-3 py-1.5 mb-5 backdrop-blur-sm">
                    <span class="live-dot"></span> System active
                </div>
                <h2 class="font-serif text-4xl font-normal text-white leading-[1.15] tracking-tight mb-4">
                    Welcome back to your school dashboard.
                </h2>
                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Access academic records, attendance reports, behavioural observations, and automated alerts — all in one secure platform.
                </p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-3 fade-up delay-2">
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-sky-300">24/7</div>
                    <div class="text-xs text-slate-300 mt-1">Real-time monitoring</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-emerald-300">Auto</div>
                    <div class="text-xs text-slate-300 mt-1">Early warning alerts</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-sky-300">360°</div>
                    <div class="text-xs text-slate-300 mt-1">Student history</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-amber-300">92%</div>
                    <div class="text-xs text-slate-300 mt-1">Parent engagement</div>
                </div>
            </div>

        </div>
    </div>

    <!-- ── RIGHT PANEL (form) ── -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-white">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="flex lg:hidden items-center gap-2 mb-8 fade-up">
                <div class="w-8 h-8 rounded-lg bg-sky-500 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 3l8 4-8 4-8-4 8-4Z"/>
                        <path d="M4 11l8 4 8-4"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-slate-800">School Alert System</span>
            </div>
            
            <!-- Header -->
            <div class="mb-8 fade-up delay-1">
                <div class="inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-widest uppercase text-sky-600 bg-sky-50 border border-sky-100 rounded-full px-3 py-1 mb-4">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.105.895-2 2-2s2 .895 2 2-.895 2-2 2-2-.895-2-2zm0 0V7m0 4v6"/></svg>
                    Secure login
                </div>
                <h1 class="font-serif text-4xl font-normal text-slate-900 tracking-tight mb-2">Sign in</h1>
                <p class="text-sm text-slate-400">Enter your credentials to access your dashboard.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                :status="session('status')"
            />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5 fade-up delay-2" id="login-form">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email address')" class="block text-xs font-medium text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none">
                            <i class="ti ti-mail text-base"></i>
                        </span>
                        <x-text-input
                            id="email"
                            class="form-input pl-9"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus autocomplete="username"
                            placeholder="you@school.edu.ng"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <x-input-label for="password" :value="__('Password')" class="text-xs font-medium text-slate-500 uppercase tracking-widest" />
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-sky-500 hover:text-sky-700 font-medium transition-colors">Forgot password?</a>
                        @endif
                    </div>
                    <div class="pw-wrapper">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none z-10">
                            <i class="ti ti-lock text-base"></i>
                        </span>
                        <x-text-input
                            id="password"
                            class="form-input pl-9 pr-10"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Enter your password"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePassword()" id="pw-toggle-btn" aria-label="Toggle password visibility">
                            <i class="ti ti-eye" id="pw-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between border border-sky-100 bg-sky-50 rounded-xl px-4 py-3">
                    <label for="remember_me" class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input
                            id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-sky-200 text-sky-500 focus:ring-sky-400"
                        >
                        <span class="text-sm text-slate-600">Remember me</span>
                    </label>
                    <div class="flex items-center gap-1.5 text-xs text-slate-400">
                        <i class="ti ti-shield-check text-sky-400 text-sm"></i>
                        Secured
                    </div>
                </div>
                
                <!-- Submit -->
                <button type="submit" class="btn-primary" id="submit-btn">
                    <i class="ti ti-login text-sm"></i>
                    {{ __('Sign in to dashboard') }}
                </button>

                <!-- Register link -->
                <p class="text-center text-sm text-slate-400 pt-1">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-sky-500 hover:text-sky-700 font-medium transition-colors">Create account</a>
                </p>

            </form>

            <!-- Footer -->
            <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-center gap-4 text-[11px] text-slate-300 fade-up delay-3">
                <span class="flex items-center gap-1"><i class="ti ti-lock text-sky-300"></i> Encrypted</span>
                <span class="w-px h-3 bg-slate-200"></span>
                <span class="flex items-center gap-1"><i class="ti ti-shield text-sky-300"></i> Role-based access</span>
                <span class="w-px h-3 bg-slate-200"></span>
                <span class="flex items-center gap-1"><i class="ti ti-eye-off text-sky-300"></i> Private</span>
            </div>

        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<script>
    /* Password toggle */
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pw-icon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.className = isHidden ? 'ti ti-eye-off' : 'ti ti-eye';
    }

    /* Submit loading state */
    document.getElementById('login-form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-btn');
        btn.innerHTML = '<i class="ti ti-loader-2 text-sm animate-spin"></i> Signing in…';
        btn.disabled = true;
        btn.style.opacity = '0.8';
    });
</script>
</x-guest-layout>
