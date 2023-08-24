<!DOCTYPE html>
<html>
<head>
    <title>System Stats Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <canvas id="statsChart"></canvas>

    <script>
        var ctx = document.getElementById('statsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'CPU Percent',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'second',
                            displayFormats: {
                                second: 'HH:mm:ss'
                            }
                        }
                    }
                }
            }
        });

        function fetchData() {
            fetch('data.php')
                .then(response => response.json())
                .then(data => {
                    data.forEach(entry => {
                        chart.data.labels.push(entry.insertion_time);
                        chart.data.datasets[0].data.push(entry.cpu_percent);
                    });
                    chart.update();
                });
        }

        fetchData();
        setInterval(fetchData, 5000); // Update every 5 seconds
    </script>
</body>
</html>
