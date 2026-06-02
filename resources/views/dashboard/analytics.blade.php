

    <h2>Performance Dashboard</h2>

    {{-- ALERT: Weak Students --}}
    <h3 style="color:red;">⚠ Weak Students</h3>
    @foreach($weakStudents as $student)
        <p>{{ $student['name'] }} - Avg: {{ $student['average'] }}</p>
    @endforeach

    <canvas id="performanceChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const data = {
            labels: {!! json_encode(array_column($studentPerformance, 'name')) !!},
            datasets: [{
                label: 'Average Score',
                data: {!! json_encode(array_column($studentPerformance, 'average')) !!},
                borderWidth: 2
            }]
        };

        new Chart(document.getElementById('performanceChart'), {
            type: 'bar',
            data: data
        });
    </script>

