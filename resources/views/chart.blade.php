<!DOCTYPE html>
<html>
<head>
    <title>Laravel ChartJS Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Laravel ChartJS Chart Example</h1>
    <canvas id="myChart"></canvas>

    <script type="text/javascript">
        var labels =  {!! json_encode($monthNames) !!};
        var data =  {!! json_encode($data) !!};

        const chartData = {
            labels: labels,
            datasets: [{
                label: 'Number of Events',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months of 2023'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Events'
                        },
                        beginAtZero: true
                    }
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>
</body>
</html>
