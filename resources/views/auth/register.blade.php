<x-guest-layout>
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
    .btn-primary:disabled { opacity: 0.7; cursor: not-allowed; }

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
                    <span class="live-dot"></span> Join the platform
                </div>
                <h2 class="font-serif text-4xl font-normal text-white leading-[1.15] tracking-tight mb-4">
                    Set up your secure school account today.
                </h2>
                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Get instant access to academic records, attendance reports, behavioural observations, and automated parent alerts — all in one place.
                </p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-3 fade-up delay-2">
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-sky-300">Fast</div>
                    <div class="text-xs text-slate-300 mt-1">Quick 2-minute setup</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-emerald-300">Free</div>
                    <div class="text-xs text-slate-300 mt-1">No setup cost</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-sky-300">Role</div>
                    <div class="text-xs text-slate-300 mt-1">Based access control</div>
                </div>
                <div class="rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm p-4">
                    <div class="font-serif text-2xl text-amber-300">Safe</div>
                    <div class="text-xs text-slate-300 mt-1">End-to-end encrypted</div>
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
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    New account
                </div>
                <h1 class="font-serif text-4xl font-normal text-slate-900 tracking-tight mb-2">Create account</h1>
                <p class="text-sm text-slate-400">Fill in your details to get started.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5 fade-up delay-2" id="register-form">
                @csrf

                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="block text-xs font-medium text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none">
                            <i class="ti ti-user text-base"></i>
                        </span>
                        <x-text-input
                            id="name"
                            class="form-input pl-9"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required autofocus autocomplete="name"
                            placeholder="Enter your full name"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="block text-xs font-medium text-slate-500 uppercase tracking-widest mb-2" />
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
                            required autocomplete="username"
                            placeholder="you@school.edu.ng"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-xs font-medium text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="pw-wrapper">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none z-10">
                            <i class="ti ti-lock text-base"></i>
                        </span>
                        <x-text-input
                            id="password"
                            class="form-input pl-9 pr-10"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Create a strong password"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePassword('password','pw-icon')" aria-label="Toggle password visibility">
                            <i class="ti ti-eye" id="pw-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-xs font-medium text-slate-500 uppercase tracking-widest mb-2" />
                    <div class="pw-wrapper">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none z-10">
                            <i class="ti ti-lock-check text-base"></i>
                        </span>
                        <x-text-input
                            id="password_confirmation"
                            class="form-input pl-9 pr-10"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password"
                            placeholder="Confirm your password"
                        />
                        <button type="button" class="pw-toggle" onclick="togglePassword('password_confirmation','pw-confirm-icon')" aria-label="Toggle confirm password visibility">
                            <i class="ti ti-eye" id="pw-confirm-icon"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 border border-sky-100 bg-sky-50 rounded-xl px-4 py-3">
                    <input
                        id="terms" type="checkbox" required
                        class="mt-0.5 w-4 h-4 rounded border-sky-200 text-sky-500 focus:ring-sky-400 shrink-0"
                    >
                    <label for="terms" class="text-sm text-slate-600 leading-relaxed cursor-pointer select-none">
                        I agree to the platform's privacy policy, security policy, and responsible handling of student information.
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-primary" id="submit-btn">
                    <i class="ti ti-user-plus text-sm"></i>
                    {{ __('Create account') }}
                </button>

                <!-- Login link -->
                <p class="text-center text-sm text-slate-400 pt-1">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-sky-500 hover:text-sky-700 font-medium transition-colors">Sign in</a>
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
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.className = isHidden ? 'ti ti-eye-off' : 'ti ti-eye';
    }

    document.getElementById('register-form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-btn');
        btn.innerHTML = '<i class="ti ti-loader-2 text-sm animate-spin"></i> Creating account…';
        btn.disabled = true;
        btn.style.opacity = '0.8';
    });
</script>
</x-guest-layout>