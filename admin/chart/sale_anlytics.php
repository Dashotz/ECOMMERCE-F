
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <select id="timeFrame" style="
    position: absolute; left: 0; right: 0; top: 0;
     margin-top: 21%; width: 100px; font-weight: bold;
     font-size: 18px;
     margin-left: 30%;


     ">
        <option value="daily">Per Day</option>
        <option value="weekly">Weekly</option>
        <option value="monthly" selected>Monthly</option>
        <option value="yearly">Per Year</option>
    </select>
    <canvas id="salesChart" width="400" height="200"></canvas>

    <?php
        // Your PHP code for data retrieval
        include("../inc/db.php");

        // Daily sales data
        $sql_daily = "SELECT DATE(date_order) AS date, SUM(total) AS totalsales FROM orders WHERE status='success' GROUP BY DATE(date_order)";
        $results_daily = mysqli_query($conn, $sql_daily);
        $dailySales = [];
        while ($row = mysqli_fetch_assoc($results_daily)) {
            $dailySales[] = ['date' => $row['date'], 'sales' => (int)$row['totalsales']];
        }

        // Weekly sales data
        $sql_weekly = "SELECT YEARWEEK(date_order) AS week, SUM(total) AS totalsales FROM orders WHERE status='success' GROUP BY YEARWEEK(date_order)";
        $results_weekly = mysqli_query($conn, $sql_weekly);
        $weeklySales = [];
        while ($row = mysqli_fetch_assoc($results_weekly)) {
            $weeklySales[] = ['week' => $row['week'], 'sales' => (int)$row['totalsales']];
        }

        // Monthly sales data
        $sql_monthly = "SELECT MONTH(date_order) AS month, SUM(total) AS totalsales FROM orders WHERE status='success' GROUP BY MONTH(date_order)";
        $results_monthly = mysqli_query($conn, $sql_monthly);
        $monthlySales = array_fill(0, 12, 0);
        while ($row = mysqli_fetch_assoc($results_monthly)) {
            $monthlySales[(int)$row['month'] - 1] = (int)$row['totalsales'];
        }

        // Yearly sales data
        $sql_yearly = "SELECT YEAR(date_order) AS year, SUM(total) AS totalsales FROM orders WHERE status='success' GROUP BY YEAR(date_order)";
        $results_yearly = mysqli_query($conn, $sql_yearly);
        $yearlySales = [];
        while ($row = mysqli_fetch_assoc($results_yearly)) {
            $yearlySales[] = ['year' => $row['year'], 'sales' => (int)$row['totalsales']];
        }

        // Close connection
        mysqli_close($conn);

        // Encode data to JSON
        echo "<script>
                var dailySales = " . json_encode($dailySales) . ";
                var weeklySales = " . json_encode($weeklySales) . ";
                var monthlySales = " . json_encode($monthlySales) . ";
                var yearlySales = " . json_encode($yearlySales) . ";
            </script>";
    ?>

    <script>
        // JavaScript for Chart.js initialization and functionality
        document.getElementById('timeFrame').addEventListener('change', function () {
            var selectedTimeFrame = this.value;
            updateChart(selectedTimeFrame);
        });

        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function updateChart(timeFrame) {
            var labels = [];
            var data = [];
            switch (timeFrame) {
                case 'daily':
                    labels = dailySales.map(item => item.date);
                    data = dailySales.map(item => item.sales);
                    break;
                case 'weekly':
                    labels = weeklySales.map(item => item.week);
                    data = weeklySales.map(item => item.sales);
                    break;
                case 'monthly':
                    labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                    data = monthlySales;
                    break;
                case 'yearly':
                    labels = yearlySales.map(item => item.year);
                    data = yearlySales.map(item => item.sales);
                    break;
            }
            salesChart.data.labels = labels;
            salesChart.data.datasets[0].data = data;
            salesChart.update();
        }

        // Initialize chart with monthly sales
        updateChart('monthly');
    </script>
