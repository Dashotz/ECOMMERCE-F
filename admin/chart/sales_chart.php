<?php
include '../inc/db.php'; // Include your database connection file

// Sample PHP code to fetch monthly sales data
$sql = "SELECT MONTH(date_order) AS month, SUM(total) AS totalsales FROM orders WHERE status='Success' GROUP BY MONTH(date_order)";
$results = mysqli_query($conn, $sql);
$monthlySales = array_fill(0, 12, 0);

while ($row = mysqli_fetch_assoc($results)) {
    $month = (int)$row['month'];
    $monthlySales[$month - 1] = (int)$row['totalsales'];
}

// Close the result set, not the connection
mysqli_free_result($results);

// Do not close the connection here, as data is still being used below

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="salesChart" width="400" height="200"></canvas>

    <script>
        // JavaScript to create and update the Chart.js line chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Sales',
                    data: <?= json_encode($monthlySales) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
