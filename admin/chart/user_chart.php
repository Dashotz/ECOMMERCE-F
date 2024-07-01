<canvas id="userGrowthChart" width="400" height="200"></canvas>

<?php
    require("../inc/db.php");

    // Fetch monthly user growth data
    $sql = "SELECT COUNT(id) AS user_total, MONTH(date_register) AS month 
            FROM users 
            GROUP BY MONTH(date_register)";
    $results = mysqli_query($conn, $sql);

    $totalsale = array_fill(0, 12, 0);
    while ($row = mysqli_fetch_assoc($results)) {
        $month = (int)$row['month'];
        $totalsale[$month - 1] = (int)$row['user_total'];
    }

    mysqli_close($conn);
?>

<script>
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(userGrowthCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'New Users',
                data: <?php echo json_encode($totalsale); ?>,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
