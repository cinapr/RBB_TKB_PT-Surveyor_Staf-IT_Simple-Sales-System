<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produk_id'])) {
    $sales_id = $_POST['sales_id'];
    $klien_id = $_POST['klien_id'];
    $jumlah_rows = count($_POST['produk_id']);

    for ($i = 0; $i < $jumlah_rows; $i++) {
        $produk_id = $_POST['produk_id'][$i];
        $jumlah = $_POST['jumlah'][$i];

        // Ambil harga dari tabel produk
        $produk = $conn->query("SELECT harga FROM produk WHERE produk_id = $produk_id")->fetch_assoc();
        $harga = $produk['harga'];
        $total = $harga * $jumlah;

        $conn->query("INSERT INTO penjualan (produk_id, sales_id, klien_id, tanggal, jumlah, total_harga, notes)
                      VALUES ($produk_id, $sales_id, $klien_id, CURDATE(), $jumlah, $total, NULL)");
    }

    echo "<script>alert('Data berhasil disimpan'); location.href='penjualan.php';</script>";
    exit;
}

// Ambil produk untuk dropdown
$produkList = $conn->query("SELECT * FROM produk");
$produkOptions = "";
while ($row = $produkList->fetch_assoc()) {
    $produkOptions .= "<option value='{$row['produk_id']}' data-harga='{$row['harga']}'>{$row['nama_produk']}</option>";
}
?>

<h2>Form Penjualan</h2>

<form method="POST">
    Sales ID: <input type="number" name="sales_id" required><br>
    Klien ID: <input type="number" name="klien_id" required><br><br>

    <table border="1" cellpadding="5" id="penjualan-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="penjualan-body">
            <tr>
                <td>
                    <select name="produk_id[]" onchange="updateHarga(this)">
                        <?= $produkOptions ?>
                    </select>
                </td>
                <td><input type="number" name="jumlah[]" value="1" oninput="hitungTotal(this)"></td>
                <td><input type="text" name="harga[]" readonly></td>
                <td><input type="text" name="total[]" readonly></td>
                <td><button type="button" onclick="hapusBaris(this)">Hapus</button></td>
            </tr>
        </tbody>
    </table>

    <br>
    <button type="button" onclick="tambahBaris()">Tambah Baris</button>
    <button type="submit">Simpan Semua</button>
</form>

<script>
function updateHarga(selectElem) {
    const harga = selectElem.options[selectElem.selectedIndex].getAttribute('data-harga');
    const row = selectElem.closest('tr');
    row.querySelector('[name="harga[]"]').value = harga;
    const jumlah = row.querySelector('[name="jumlah[]"]').value || 0;
    row.querySelector('[name="total[]"]').value = harga * jumlah;
}

function hitungTotal(input) {
    const row = input.closest('tr');
    const harga = row.querySelector('[name="harga[]"]').value || 0;
    const jumlah = input.value || 0;
    row.querySelector('[name="total[]"]').value = harga * jumlah;
}

function tambahBaris() {
    const tableBody = document.getElementById('penjualan-body');
    const newRow = tableBody.rows[0].cloneNode(true);

    newRow.querySelector('select').selectedIndex = 0;
    newRow.querySelector('[name="jumlah[]"]').value = 1;
    newRow.querySelector('[name="harga[]"]').value = '';
    newRow.querySelector('[name="total[]"]').value = '';

    tableBody.appendChild(newRow);
}

function hapusBaris(button) {
    const row = button.closest('tr');
    const tableBody = document.getElementById('penjualan-body');
    if (tableBody.rows.length > 1) {
        row.remove();
    } else {
        alert("Minimal 1 baris harus ada.");
    }
}
</script>
