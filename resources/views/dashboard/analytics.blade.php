<div style="max-width: 580px; font-family: 'DM Sans', sans-serif; padding: 40px;">

    {{-- Header --}}
    <div style="margin-bottom: 28px;">
        <h2 style="font-family: 'DM Serif Display', serif; font-size: 1.8rem; font-weight: 500;
                   color: #0c4a6e; margin-bottom: 6px;">
            Performance Dashboard
        </h2>
        <p style="color: #94a3b8; font-size: 13px;">
            View student performance, average scores, and weak students at a glance.
        </p>
    </div>

    {{-- Weak Students Card --}}
    <div style="background:#f0f9ff; border:1px solid #e0f2fe; border-radius:14px; padding:20px; margin-bottom:24px;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:14px;">
            <div style="width:34px; height:34px; border-radius:10px; background:#fee2e2; display:flex; align-items:center; justify-content:center;">
                <span style="color:#dc2626; font-size:16px;">⚠</span>
            </div>
            <h3 style="margin:0; color:#dc2626; font-size:16px; font-weight:600;">
                Weak Students
            </h3>
        </div>

        @if(!empty($weakStudents) && count($weakStudents) > 0)
            <div style="display:grid; gap:10px;">
                @foreach($weakStudents as $student)
                    <div style="display:flex; justify-content:space-between; align-items:center;
                                background:white; border:1px solid #e0f2fe; border-radius:10px;
                                padding:12px 14px; color:#0c4a6e;">
                        <span style="font-weight:500;">{{ $student['name'] }}</span>
                        <span style="font-size:13px; color:#dc2626; font-weight:600;">
                            Avg: {{ $student['average'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div style="background:white; border:1px dashed #bae6fd; border-radius:10px; padding:14px; color:#94a3b8; font-size:13px;">
                No weak students found.
            </div>
        @endif
    </div>

    {{-- Performance Chart Card --}}
    <div style="background:#ffffff; border:1px solid #e0f2fe; border-radius:14px; padding:20px;
                box-shadow:0 4px 12px rgba(14,165,233,0.06);">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
            <h3 style="margin:0; color:#0c4a6e; font-size:16px; font-weight:600;">
                Student Performance Chart
            </h3>
            <span style="font-size:11px; color:#94a3b8; text-transform:uppercase; letter-spacing:1px;">
                Average Score
            </span>
        </div>

        <div style="position:relative; height:320px;">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>

</div>

<style>
    #performanceChart {
        width: 100% !important;
        height: 100% !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const performanceData = {
        labels: {!! json_encode(array_column($studentPerformance, 'name')) !!},
        datasets: [{
            label: 'Average Score',
            data: {!! json_encode(array_column($studentPerformance, 'average')) !!},
            borderWidth: 2,
            backgroundColor: 'rgba(14, 165, 233, 0.75)',
            borderColor: 'rgba(14, 165, 233, 1)',
            borderRadius: 8,
            hoverBackgroundColor: 'rgba(6, 182, 212, 0.85)'
        }]
    };

    new Chart(document.getElementById('performanceChart'), {
        type: 'bar',
        data: performanceData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#0c4a6e',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#e0f2fe',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            family: "'DM Sans', sans-serif"
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    suggestedMax: 100,
                    grid: {
                        color: '#e0f2fe'
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            family: "'DM Sans', sans-serif"
                        }
                    }
                }
            }
        }
    });
</script>