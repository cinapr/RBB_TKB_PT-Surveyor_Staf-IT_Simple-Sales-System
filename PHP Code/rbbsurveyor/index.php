<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h1>Dashboard Penjualan</h1>

<nav>
    <a href="penjualan.php">+ Input Penjualan</a> |
    <a href="produk.php">Produk</a> |
    <a href="sales.php">Sales</a> |
    <a href="klien.php">Klien</a> |
    <a href="aktivitas_sales.php">Aktivitas Sales</a>
</nav>

<hr>

<h2>Total Penjualan Hari Ini per Sales</h2>
<canvas id="salesChart" height="100"></canvas>

<?php
$sales = $conn->query("SELECT Sales_ID, nama_sales FROM sales");
$salesLabels = [];
$salesData = [];

while ($s = $sales->fetch_assoc()) {
    $salesLabels[] = $s['nama_sales'];
    $result = $conn->query("SELECT TotalPenjualanSales({$s['Sales_ID']}) AS total")->fetch_assoc();
    $salesData[] = $result['total'];
}
?>

<script>
const ctx1 = document.getElementById('salesChart').getContext('2d');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?= json_encode($salesLabels) ?>,
        datasets: [{
            label: 'Total Hari Ini (Rp)',
            data: <?= json_encode($salesData) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

<hr>

<h2>Jumlah Penjualan per Produk (Sepanjang Waktu)</h2>
<canvas id="produkChart" height="100"></canvas>

<?php
$produk = $conn->query("SELECT p.nama_produk, SUM(jumlah) AS total FROM penjualan pj
                        JOIN produk p ON p.produk_id = pj.produk_id
                        GROUP BY p.produk_id");
$produkLabels = [];
$produkData = [];
while ($p = $produk->fetch_assoc()) {
    $produkLabels[] = $p['nama_produk'];
    $produkData[] = $p['total'];
}
?>

<script>
const ctx2 = document.getElementById('produkChart').getContext('2d');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?= json_encode($produkLabels) ?>,
        datasets: [{
            label: 'Jumlah Terjual',
            data: <?= json_encode($produkData) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

</body>
</html>
