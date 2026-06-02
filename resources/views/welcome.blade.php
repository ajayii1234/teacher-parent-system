<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School Alert System</title>
  <meta name="description" content="A secure, intuitive, and scalable school information system for academic records, attendance tracking, behavior monitoring, and automated alerts.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            sky: {
              50:  '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          },
          fontFamily: {
            sans: ['DM Sans', 'sans-serif'],
            serif: ['DM Serif Display', 'serif'],
          }
        }
      }
    }
  </script>
  <style>
    html { scroll-behavior: smooth; }

    .live-dot {
      display: inline-block;
      width: 7px; height: 7px;
      border-radius: 50%;
      background: #16a34a;
      margin-right: 5px;
      vertical-align: middle;
      animation: livepulse 2s ease-in-out infinite;
    }
    @keyframes livepulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.25; }
    }

    /* Counter animation */
    .counter { transition: all 0.4s ease; }

    /* Fade-in on scroll */
    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.55s ease, transform 0.55s ease;
    }
    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Tab underline */
    .tab-btn { position: relative; }
    .tab-btn::after {
      content: '';
      position: absolute;
      bottom: -1px; left: 0; right: 0;
      height: 2px;
      background: #0ea5e9;
      transform: scaleX(0);
      transition: transform 0.25s ease;
      border-radius: 2px;
    }
    .tab-btn.active::after { transform: scaleX(1); }
    .tab-btn.active { color: #0284c7; font-weight: 500; }

    /* Alert row hover */
    .alert-row { transition: background 0.2s ease; }
    .alert-row:hover { background: #f0f9ff; }

    /* Floating nav shadow on scroll */
    #main-nav { transition: box-shadow 0.3s ease, background 0.3s ease; }
    #main-nav.scrolled {
      box-shadow: 0 1px 24px 0 rgba(14,165,233,0.07);
      background: rgba(255,255,255,0.97);
      backdrop-filter: blur(8px);
    }

    /* Mobile menu */
    #mobile-menu { transition: max-height 0.3s ease, opacity 0.3s ease; max-height: 0; overflow: hidden; opacity: 0; }
    #mobile-menu.open { max-height: 300px; opacity: 1; }

    /* Accordion */
    .accordion-body { max-height: 0; overflow: hidden; transition: max-height 0.35s ease, padding 0.25s ease; }
    .accordion-body.open { max-height: 200px; }
    .accordion-icon { transition: transform 0.3s ease; }
    .accordion-btn.open .accordion-icon { transform: rotate(180deg); }

    /* Stat counter */
    .stat-count { font-family: 'DM Serif Display', serif; }

    /* Notification toast */
    #toast {
      position: fixed; bottom: 2rem; right: 2rem;
      background: #0284c7; color: white;
      padding: 0.75rem 1.25rem;
      border-radius: 10px;
      font-size: 13px; font-weight: 500;
      box-shadow: 0 8px 24px rgba(2,132,199,0.25);
      transform: translateY(80px); opacity: 0;
      transition: transform 0.35s cubic-bezier(.4,0,.2,1), opacity 0.35s ease;
      z-index: 9999;
      display: flex; align-items: center; gap: 8px;
    }
    #toast.show { transform: translateY(0); opacity: 1; }
  </style>
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased font-sans font-light">

  <!-- TOAST -->
  <div id="toast">
    <i class="ti ti-check text-sm"></i>
    <span id="toast-msg">Demo alert sent!</span>
  </div>

  <!-- NAV -->
  <header id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-sky-100">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-sky-500 flex items-center justify-center shadow-sm">
          <i class="ti ti-stack-2 text-white text-base" aria-hidden="true"></i>
        </div>
        <div>
          <div class="text-sm font-semibold tracking-tight text-slate-900">School Alert System</div>
          <div class="text-[10px] text-sky-500 font-medium">Records · Attendance · Behaviour · Alerts</div>
        </div>
      </div>
      <!-- Desktop nav -->
      <nav class="hidden md:flex items-center gap-6 text-sm text-slate-500">
        <a href="#features" class="hover:text-sky-600 transition-colors">Features</a>
        <a href="#why" class="hover:text-sky-600 transition-colors">Why us</a>
        <a href="#security" class="hover:text-sky-600 transition-colors">Security</a>
      </nav>
      <div class="hidden md:flex items-center gap-2">
        <a href="{{ route('login') }}" class="text-sm text-slate-500 border border-slate-200 rounded-lg px-4 py-2 hover:border-sky-300 hover:text-sky-600 transition-colors">Log in</a>
        <a href="{{ route('register') }}" class="text-sm font-semibold bg-sky-500 text-white rounded-lg px-4 py-2 hover:bg-sky-600 transition-colors shadow-sm">Get started</a>
      </div>
      <!-- Mobile hamburger -->
      <button id="hamburger" class="md:hidden text-slate-500 hover:text-sky-600 transition-colors" aria-label="Open menu">
        <i class="ti ti-menu-2 text-2xl"></i>
      </button>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden border-t border-sky-50">
      <div class="px-6 py-4 flex flex-col gap-3">
        <a href="#features" class="text-sm text-slate-600 hover:text-sky-600 transition-colors mobile-link">Features</a>
        <a href="#why" class="text-sm text-slate-600 hover:text-sky-600 transition-colors mobile-link">Why us</a>
        <a href="#security" class="text-sm text-slate-600 hover:text-sky-600 transition-colors mobile-link">Security</a>
        <hr class="border-sky-50">
        <a href="{{ route('login') }}" class="text-sm text-slate-500 border border-slate-200 rounded-lg px-4 py-2 text-center hover:border-sky-300 transition-colors">Log in</a>
        <a href="{{ route('register') }}" class="text-sm font-semibold bg-sky-500 text-white rounded-lg px-4 py-2 text-center hover:bg-sky-600 transition-colors">Get started</a>
      </div>
    </div>
  </header>

  <div class="pt-[73px]">

    <!-- HERO -->
    <section class="relative overflow-hidden min-h-[88vh] flex items-center justify-center">

      <!-- Background image -->
      <!-- <img
        src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80"
        alt="Students in a school classroom"
        class="absolute inset-0 w-full h-full object-cover object-center"
      > -->

      <img src="{{ asset('images/hero.png') }}" alt="Students in a school classroom"
        class="absolute inset-0 w-full h-full object-cover object-center">

      <!-- Layered overlays: dark base + sky blue tint -->
      <div class="absolute inset-0 bg-slate-900/60"></div>
      <div class="absolute inset-0 bg-sky-900/40"></div>

      <!-- Subtle radial glow behind the heading -->
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[600px] h-[600px] rounded-full bg-sky-500/10 blur-3xl"></div>
      </div>

      <!-- Content — centred -->
      <div class="relative z-10 max-w-4xl mx-auto px-6 py-28 flex flex-col items-center text-center">

        <div class="inline-flex items-center gap-2 text-[11px] font-semibold tracking-widest uppercase text-sky-300 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 mb-7 backdrop-blur-sm">
          <i class="ti ti-shield-check text-xs"></i>
          School intelligence platform
        </div>

        <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-normal leading-[1.1] tracking-tight text-white mb-6">
          Faster interventions.<br>
          <em class="text-sky-300 not-italic">Better outcomes.</em>
        </h1>

        <p class="text-base md:text-lg text-slate-200 leading-relaxed mb-10 max-w-xl">
          One platform for academic records, attendance, behaviour, and automated alerts — built so schools can act on information before it becomes a problem.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
          <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm font-semibold bg-sky-500 text-white rounded-xl px-7 py-3.5 hover:bg-sky-400 transition-colors shadow-lg shadow-sky-900/40">
            Create an account <i class="ti ti-arrow-right"></i>
          </a>
          <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-medium text-white bg-white/10 border border-white/20 rounded-xl px-7 py-3.5 hover:bg-white/20 transition-colors backdrop-blur-sm">
            Sign in <i class="ti ti-arrow-right text-xs"></i>
          </a>
        </div>

        <!-- Trust indicators -->
        <div class="mt-14 flex flex-col sm:flex-row items-center gap-6 text-xs text-slate-300">
          <div class="flex items-center gap-2">
            <i class="ti ti-lock text-sky-400"></i>
            End-to-end encrypted
          </div>
          <div class="hidden sm:block w-px h-4 bg-white/20"></div>
          <div class="flex items-center gap-2">
            <i class="ti ti-clock text-sky-400"></i>
            Real-time alerts
          </div>
          <div class="hidden sm:block w-px h-4 bg-white/20"></div>
          <div class="flex items-center gap-2">
            <i class="ti ti-users text-sky-400"></i>
            Role-based access control
          </div>
        </div>

      </div>

      <!-- Bottom fade into page -->
      <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>

    </section>

    <!-- ANIMATED STATS -->
    <section class="border-y border-sky-100 bg-white">
      <div class="max-w-6xl mx-auto grid grid-cols-3">
        <div class="px-8 py-10 border-r border-sky-100 text-center reveal">
          <div class="font-serif text-5xl font-normal text-sky-500 tracking-tight" id="stat-1">24/7</div>
          <div class="text-[11px] text-slate-400 uppercase tracking-widest mt-2 font-medium">Real-time monitoring</div>
        </div>
        <div class="px-8 py-10 border-r border-sky-100 text-center reveal">
          <div class="font-serif text-5xl font-normal text-sky-500 tracking-tight"><span id="stat-2">0</span>+</div>
          <div class="text-[11px] text-slate-400 uppercase tracking-widest mt-2 font-medium">Schools onboarded</div>
        </div>
        <div class="px-8 py-10 text-center reveal">
          <div class="font-serif text-5xl font-normal text-sky-500 tracking-tight">360°</div>
          <div class="text-[11px] text-slate-400 uppercase tracking-widest mt-2 font-medium">Student history</div>
        </div>
      </div>
    </section>

    <!-- LIVE PANEL -->
    <section class="max-w-6xl mx-auto px-6 py-16" id="features">
      <div class="reveal">
        <div class="text-[11px] font-semibold tracking-widest uppercase text-sky-500 mb-2">Live dashboard</div>
        <h2 class="font-serif text-3xl font-normal text-slate-900 tracking-tight mb-8 max-w-lg leading-snug">
          A real-time view of every student that needs attention
        </h2>
      </div>

      <!-- Tabs -->
      <div class="border-b border-slate-100 mb-6 flex gap-6 reveal">
        <button class="tab-btn active pb-3 text-sm text-slate-500 transition-colors" data-tab="attendance">Attendance</button>
        <button class="tab-btn pb-3 text-sm text-slate-500 transition-colors" data-tab="behaviour">Behaviour</button>
        <button class="tab-btn pb-3 text-sm text-slate-500 transition-colors" data-tab="academics">Academics</button>
      </div>

      <!-- Tab panels -->
      <div id="tab-attendance" class="tab-panel reveal">
        <div class="border border-sky-100 rounded-2xl overflow-hidden">
          <div class="flex items-center justify-between px-6 py-4 bg-sky-50 border-b border-sky-100">
            <div>
              <div class="text-sm font-semibold text-slate-800">Attendance Risk Monitor</div>
              <div class="text-xs text-slate-400 mt-0.5">Students with 3+ consecutive absences</div>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs font-semibold text-green-600"><span class="live-dot"></span>Live</span>
              <button onclick="sendDemoAlert()" class="text-xs font-semibold bg-sky-500 text-white px-3 py-1.5 rounded-lg hover:bg-sky-600 transition-colors flex items-center gap-1">
                <i class="ti ti-send text-xs"></i> Send demo alert
              </button>
            </div>
          </div>
          <div class="divide-y divide-slate-50">
            <div class="alert-row flex items-center justify-between px-6 py-4 cursor-pointer" onclick="toggleStudent(this)">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 font-semibold text-xs">AO</div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Adaeze Okonkwo</div>
                  <div class="text-xs text-slate-400">JSS 2B · 7 absences</div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-red-500 bg-red-50 px-2.5 py-1 rounded-full">High risk</span>
                <i class="ti ti-chevron-down text-slate-300 expand-icon transition-transform"></i>
              </div>
            </div>
            <div class="student-detail hidden px-6 py-4 bg-sky-50 text-xs text-slate-500 border-t border-sky-100">
              Last seen: Monday 13 May · Parent notified: Yes · Teacher: Mr. Eze · <button class="text-sky-500 font-medium hover:underline" onclick="sendDemoAlert()">Send follow-up alert →</button>
            </div>
            <div class="alert-row flex items-center justify-between px-6 py-4 cursor-pointer" onclick="toggleStudent(this)">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-semibold text-xs">EB</div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Emeka Babatunde</div>
                  <div class="text-xs text-slate-400">SS 1A · 4 absences</div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">Medium risk</span>
                <i class="ti ti-chevron-down text-slate-300 expand-icon transition-transform"></i>
              </div>
            </div>
            <div class="student-detail hidden px-6 py-4 bg-sky-50 text-xs text-slate-500 border-t border-sky-100">
              Last seen: Wednesday 15 May · Parent notified: Pending · Teacher: Mrs. Obi · <button class="text-sky-500 font-medium hover:underline" onclick="sendDemoAlert()">Send follow-up alert →</button>
            </div>
            <div class="alert-row flex items-center justify-between px-6 py-4 cursor-pointer" onclick="toggleStudent(this)">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-semibold text-xs">FI</div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Fatima Ibrahim</div>
                  <div class="text-xs text-slate-400">JSS 3C · 3 absences</div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-sky-600 bg-sky-50 px-2.5 py-1 rounded-full">Watch list</span>
                <i class="ti ti-chevron-down text-slate-300 expand-icon transition-transform"></i>
              </div>
            </div>
            <div class="student-detail hidden px-6 py-4 bg-sky-50 text-xs text-slate-500 border-t border-sky-100">
              Last seen: Thursday 16 May · Parent notified: Yes · Teacher: Mr. Aliyu · <button class="text-sky-500 font-medium hover:underline" onclick="sendDemoAlert()">Send follow-up alert →</button>
            </div>
          </div>
          <div class="grid grid-cols-4 border-t border-sky-100">
            <div class="px-6 py-5 border-r border-sky-100">
              <div class="text-[10px] text-slate-400 uppercase tracking-widest">At risk</div>
              <div class="font-serif text-3xl text-red-500 mt-1">12</div>
              <div class="text-[10px] font-semibold text-red-400 mt-0.5">Needs follow-up</div>
            </div>
            <div class="px-6 py-5 border-r border-sky-100">
              <div class="text-[10px] text-slate-400 uppercase tracking-widest">Behaviour flags</div>
              <div class="font-serif text-3xl text-amber-500 mt-1">8</div>
              <div class="text-[10px] font-semibold text-amber-400 mt-0.5">Review pending</div>
            </div>
            <div class="px-6 py-5 border-r border-sky-100">
              <div class="text-[10px] text-slate-400 uppercase tracking-widest">Academic alerts</div>
              <div class="font-serif text-3xl text-sky-500 mt-1">5</div>
              <div class="text-[10px] font-semibold text-sky-400 mt-0.5">Alert sent</div>
            </div>
            <div class="px-6 py-5">
              <div class="text-[10px] text-slate-400 uppercase tracking-widest">Parent response</div>
              <div class="font-serif text-3xl text-green-500 mt-1">92%</div>
              <div class="text-[10px] font-semibold text-green-400 mt-0.5">Engaged</div>
            </div>
          </div>
        </div>
      </div>

      <div id="tab-behaviour" class="tab-panel hidden reveal">
        <div class="border border-sky-100 rounded-2xl overflow-hidden">
          <div class="px-6 py-4 bg-sky-50 border-b border-sky-100">
            <div class="text-sm font-semibold text-slate-800">Behaviour Flag Log</div>
            <div class="text-xs text-slate-400 mt-0.5">Recent behavioural observations requiring review</div>
          </div>
          <div class="divide-y divide-slate-50">
            <div class="alert-row flex items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center"><i class="ti ti-alert-triangle text-orange-400 text-sm"></i></div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Disruption in class</div>
                  <div class="text-xs text-slate-400">Chukwuemeka Nwodo · SS 2A · Today</div>
                </div>
              </div>
              <span class="text-xs font-semibold text-orange-500 bg-orange-50 px-2.5 py-1 rounded-full">Warning</span>
            </div>
            <div class="alert-row flex items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center"><i class="ti ti-x text-red-400 text-sm"></i></div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Physical altercation</div>
                  <div class="text-xs text-slate-400">Yusuf Abdullahi · JSS 1B · Yesterday</div>
                </div>
              </div>
              <span class="text-xs font-semibold text-red-500 bg-red-50 px-2.5 py-1 rounded-full">Referral</span>
            </div>
            <div class="alert-row flex items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center"><i class="ti ti-star text-green-500 text-sm"></i></div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Outstanding conduct award</div>
                  <div class="text-xs text-slate-400">Ngozi Okafor · SS 3C · Today</div>
                </div>
              </div>
              <span class="text-xs font-semibold text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Positive</span>
            </div>
          </div>
        </div>
      </div>

      <div id="tab-academics" class="tab-panel hidden reveal">
        <div class="border border-sky-100 rounded-2xl overflow-hidden">
          <div class="px-6 py-4 bg-sky-50 border-b border-sky-100">
            <div class="text-sm font-semibold text-slate-800">Academic Decline Monitor</div>
            <div class="text-xs text-slate-400 mt-0.5">Students with a 15%+ drop from last term</div>
          </div>
          <div class="divide-y divide-slate-50">
            <div class="alert-row flex items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 font-semibold text-xs">TJ</div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Tunde Johnson</div>
                  <div class="text-xs text-slate-400">SS 1B · Maths: 78% → 51%</div>
                </div>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-red-500">-27%</span>
                <span class="text-xs font-semibold text-red-500 bg-red-50 px-2.5 py-1 rounded-full">Alert sent</span>
              </div>
            </div>
            <div class="alert-row flex items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-semibold text-xs">AM</div>
                <div>
                  <div class="text-sm font-medium text-slate-800">Amina Mohammed</div>
                  <div class="text-xs text-slate-400">JSS 3A · English: 82% → 64%</div>
                </div>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-amber-500">-18%</span>
                <span class="text-xs font-semibold text-amber-500 bg-amber-50 px-2.5 py-1 rounded-full">Monitoring</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- MODULES GRID -->
    <section class="bg-sky-50 border-y border-sky-100 py-16">
      <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
          <div class="text-[11px] font-semibold tracking-widest uppercase text-sky-500 mb-2">Core modules</div>
          <h2 class="font-serif text-3xl font-normal text-slate-900 tracking-tight mb-10 max-w-lg leading-snug">
            Everything a school needs in a single, coherent system
          </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-report-analytics text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Academic records</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Term results, CA scores, subject trends, and performance history — all in one place.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-calendar-check text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Attendance intelligence</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Daily logs, lateness tracking, absence streaks, and auto-escalation rules.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-notes text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Behaviour log</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Discipline notes, positive records, referrals, and support plans per learner.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-bell-ringing text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Automated alerts</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Targeted notifications to teachers, admins, and parents the moment a threshold is crossed.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-users text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Student profile</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">A 360° view of each student's academic journey, behaviour, and attendance history.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-device-mobile text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Parent portal</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Real-time updates, alert responses, and direct communication with the school.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-chart-bar text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">Reports & analytics</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Class-level, term-level, and longitudinal reports with export and print support.</p>
          </div>
          <div class="reveal bg-white rounded-2xl p-6 border border-sky-100 hover:border-sky-300 hover:shadow-md hover:shadow-sky-50 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center mb-4">
              <i class="ti ti-settings text-sky-600 text-xl"></i>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1.5">User management</h3>
            <p class="text-[12px] text-slate-400 leading-relaxed">Role-based access control for admins, teachers, staff, and parents.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- WHY + SECURITY with accordion -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12" id="why">
      <div class="reveal">
        <div class="text-[11px] font-semibold tracking-widest uppercase text-sky-500 mb-2">Why it works</div>
        <h2 class="font-serif text-2xl font-normal text-slate-900 tracking-tight leading-snug mb-6">
          Designed to close the gap between an event and a response
        </h2>
        <div class="flex flex-col gap-1">
          <div class="border border-slate-100 rounded-xl overflow-hidden">
            <button class="accordion-btn w-full flex items-center justify-between px-5 py-4 text-left text-sm font-medium text-slate-800 hover:bg-sky-50 transition-colors" onclick="toggleAccordion(this)">
              Reduces information lag
              <i class="ti ti-chevron-down text-slate-300 accordion-icon text-base"></i>
            </button>
            <div class="accordion-body px-5 text-[13px] text-slate-400 leading-relaxed">
              <div class="pb-4">Teachers and administrators see issues as they happen, not weeks later. Every change is logged and surfaced immediately.</div>
            </div>
          </div>
          <div class="border border-slate-100 rounded-xl overflow-hidden">
            <button class="accordion-btn w-full flex items-center justify-between px-5 py-4 text-left text-sm font-medium text-slate-800 hover:bg-sky-50 transition-colors" onclick="toggleAccordion(this)">
              Improves records accuracy
              <i class="ti ti-chevron-down text-slate-300 accordion-icon text-base"></i>
            </button>
            <div class="accordion-body px-5 text-[13px] text-slate-400 leading-relaxed">
              <div class="pb-4">Centralised capture removes duplication, manual errors, and lost files — giving you one source of truth.</div>
            </div>
          </div>
          <div class="border border-slate-100 rounded-xl overflow-hidden">
            <button class="accordion-btn w-full flex items-center justify-between px-5 py-4 text-left text-sm font-medium text-slate-800 hover:bg-sky-50 transition-colors" onclick="toggleAccordion(this)">
              Strengthens parent communication
              <i class="ti ti-chevron-down text-slate-300 accordion-icon text-base"></i>
            </button>
            <div class="accordion-body px-5 text-[13px] text-slate-400 leading-relaxed">
              <div class="pb-4">Alerts, messages, and updates keep parents involved in real time, improving intervention outcomes significantly.</div>
            </div>
          </div>
          <div class="border border-slate-100 rounded-xl overflow-hidden">
            <button class="accordion-btn w-full flex items-center justify-between px-5 py-4 text-left text-sm font-medium text-slate-800 hover:bg-sky-50 transition-colors" onclick="toggleAccordion(this)">
              Supports longitudinal tracking
              <i class="ti ti-chevron-down text-slate-300 accordion-icon text-base"></i>
            </button>
            <div class="accordion-body px-5 text-[13px] text-slate-400 leading-relaxed">
              <div class="pb-4">Historical trends reveal progress, regression, and intervention effectiveness over time — enabling smarter planning.</div>
            </div>
          </div>
        </div>
      </div>

      <div class="reveal" id="security">
        <div class="text-[11px] font-semibold tracking-widest uppercase text-sky-500 mb-2">Security and access</div>
        <h2 class="font-serif text-2xl font-normal text-slate-900 tracking-tight leading-snug mb-6">
          Built with the right controls from the ground up
        </h2>
        <div class="grid grid-cols-2 gap-3">
          <div class="bg-sky-50 border border-sky-100 rounded-xl p-4">
            <i class="ti ti-users text-sky-500 text-xl mb-2"></i>
            <div class="text-[13px] font-semibold text-slate-800 mb-1">Role-based access</div>
            <div class="text-[12px] text-slate-400 leading-relaxed">Staff only see what they are permitted to view.</div>
          </div>
          <div class="bg-sky-50 border border-sky-100 rounded-xl p-4">
            <i class="ti ti-file-search text-sky-500 text-xl mb-2"></i>
            <div class="text-[13px] font-semibold text-slate-800 mb-1">Audit logging</div>
            <div class="text-[12px] text-slate-400 leading-relaxed">Every action is traceable for compliance.</div>
          </div>
          <div class="bg-sky-50 border border-sky-100 rounded-xl p-4">
            <i class="ti ti-lock text-sky-500 text-xl mb-2"></i>
            <div class="text-[13px] font-semibold text-slate-800 mb-1">Encrypted data</div>
            <div class="text-[12px] text-slate-400 leading-relaxed">Protected at rest and in transit.</div>
          </div>
          <div class="bg-sky-50 border border-sky-100 rounded-xl p-4">
            <i class="ti ti-arrows-maximize text-sky-500 text-xl mb-2"></i>
            <div class="text-[13px] font-semibold text-slate-800 mb-1">Scalable</div>
            <div class="text-[12px] text-slate-400 leading-relaxed">From one school to a multi-campus network.</div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="bg-sky-500 py-20">
      <div class="max-w-3xl mx-auto px-6 text-center reveal">
        <h2 class="font-serif text-4xl font-normal text-white tracking-tight mb-4">
          Built for faster decisions<br>and better student outcomes
        </h2>
        <p class="text-sky-100 text-sm leading-relaxed max-w-xl mx-auto mb-8">
          A single source of truth for student performance, behaviour, and attendance — with timely interventions that improve accountability and long-term success.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
          <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm font-semibold bg-white text-sky-600 rounded-xl px-6 py-3 hover:bg-sky-50 transition-colors shadow-lg">
            Create an account <i class="ti ti-arrow-right"></i>
          </a>
          <a href="{{ route('login') }}" class="text-sm text-sky-100 hover:text-white transition-colors">Sign in</a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-sky-100 bg-white">
      <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4 text-[12px] text-slate-400">
        <div class="flex items-center gap-2">
          <div class="w-6 h-6 rounded-lg bg-sky-500 flex items-center justify-center">
            <i class="ti ti-stack-2 text-white text-xs"></i>
          </div>
          <span>© {{ date('Y') }} School Alert System. All rights reserved.</span>
        </div>
        <span class="text-sky-400 font-medium">Secure · Intuitive · Scalable</span>
      </div>
    </footer>

  </div><!-- end pt-wrapper -->

  <script>
    /* ── Sticky nav shadow ── */
    window.addEventListener('scroll', () => {
      document.getElementById('main-nav').classList.toggle('scrolled', window.scrollY > 10);
    });

    /* ── Mobile hamburger ── */
    document.getElementById('hamburger').addEventListener('click', () => {
      const menu = document.getElementById('mobile-menu');
      const icon = document.querySelector('#hamburger i');
      menu.classList.toggle('open');
      icon.classList.toggle('ti-menu-2');
      icon.classList.toggle('ti-x');
    });
    document.querySelectorAll('.mobile-link').forEach(l => {
      l.addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.remove('open');
        const icon = document.querySelector('#hamburger i');
        icon.classList.add('ti-menu-2');
        icon.classList.remove('ti-x');
      });
    });

    /* ── Reveal on scroll ── */
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((e, i) => {
        if (e.isIntersecting) {
          setTimeout(() => e.target.classList.add('visible'), i * 80);
          observer.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });
    revealEls.forEach(el => observer.observe(el));

    /* ── Animated counter ── */
    function animateCounter(el, target, duration = 1800) {
      let start = 0;
      const step = target / (duration / 16);
      const interval = setInterval(() => {
        start = Math.min(start + step, target);
        el.textContent = Math.floor(start);
        if (start >= target) clearInterval(interval);
      }, 16);
    }
    const stat2 = document.getElementById('stat-2');
    const statObserver = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        animateCounter(stat2, 340);
        statObserver.disconnect();
      }
    }, { threshold: 0.5 });
    statObserver.observe(stat2);

    /* ── Tabs ── */
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
      });
    });

    /* ── Student row expand ── */
    function toggleStudent(row) {
      const detail = row.nextElementSibling;
      const icon = row.querySelector('.expand-icon');
      const isOpen = !detail.classList.contains('hidden');
      document.querySelectorAll('.student-detail').forEach(d => d.classList.add('hidden'));
      document.querySelectorAll('.expand-icon').forEach(i => i.style.transform = '');
      if (!isOpen) {
        detail.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      }
    }

    /* ── Accordion ── */
    function toggleAccordion(btn) {
      const body = btn.nextElementSibling;
      const isOpen = body.classList.contains('open');
      document.querySelectorAll('.accordion-body').forEach(b => b.classList.remove('open'));
      document.querySelectorAll('.accordion-btn').forEach(b => b.classList.remove('open'));
      if (!isOpen) {
        body.classList.add('open');
        btn.classList.add('open');
      }
    }

    /* ── Toast ── */
    function showToast(msg) {
      const toast = document.getElementById('toast');
      document.getElementById('toast-msg').textContent = msg;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 3200);
    }
    function sendDemoAlert() {
      const messages = [
        'Alert sent to parent and class teacher!',
        'Follow-up notification dispatched!',
        'Intervention logged successfully!',
        'Parent notified via SMS and email!',
      ];
      showToast(messages[Math.floor(Math.random() * messages.length)]);
    }
  </script>
</body>
</html>
