    <canvas id="orderStatusChart" width="400" height="200"></canvas>

    <?php
        // Establish database connection
    require("../inc/db.php");

        // Query to fetch total orders with status 'success'
        $sql = "SELECT COUNT(id) AS total_order FROM orders WHERE status='success'";
        $result1 = mysqli_query($conn, $sql);
        $values1 = mysqli_fetch_assoc($result1);
        $total_order = $values1['total_order'];

        // Query to fetch total orders with status 'pending'
        $sql = "SELECT COUNT(id) AS total_pending FROM orders WHERE status='pending'";
        $result2 = mysqli_query($conn, $sql);
        $values2 = mysqli_fetch_assoc($result2);
        $order_pending = $values2['total_pending'];

        // Query to fetch total orders with status 'cancel'
        $sql = "SELECT COUNT(id) AS total_cancel FROM orders WHERE status='cancel'";
        $result3 = mysqli_query($conn, $sql);
        $values3 = mysqli_fetch_assoc($result3);
        $cancel_order = $values3['total_cancel'];

        // Close database connection
        mysqli_close($conn);
    ?>

    <script>
        // JavaScript to create and update the Chart.js pie chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Pending', 'Cancelled'],
                datasets: [{
                    label: 'Order Status',
                    data: [<?= $total_order ?>, <?= $order_pending ?>, <?= $cancel_order ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
