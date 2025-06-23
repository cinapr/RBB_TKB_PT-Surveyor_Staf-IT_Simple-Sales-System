<?php include 'db.php';

// Tambah
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $conn->query("INSERT INTO sales (nama_sales, email, telepon) VALUES ('$nama', '$email', '$telepon')");
    header("Location: sales.php"); exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM sales WHERE Sales_ID = $id");
    header("Location: sales.php"); exit;
}

// Edit
$edit = false;
$data = [];
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $data = $conn->query("SELECT * FROM sales WHERE Sales_ID = $id")->fetch_assoc();
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $conn->query("UPDATE sales SET nama_sales='$_POST[nama]', email='$_POST[email]', telepon='$_POST[telepon]' WHERE Sales_ID=$id");
    header("Location: sales.php"); exit;
}
?>

<h2>Data Sales</h2>

<?php if ($edit): ?>
<form method="POST">
    <input type="hidden" name="id" value="<?= $data['Sales_ID'] ?>">
    Nama: <input name="nama" value="<?= $data['nama_sales'] ?>"><br>
    Email: <input name="email" value="<?= $data['email'] ?>"><br>
    Telepon: <input name="telepon" value="<?= $data['telepon'] ?>"><br>
    <button name="update">Update</button> <a href="sales.php">Batal</a>
</form>
<?php else: ?>
<form method="POST">
    Nama: <input name="nama"><br>
    Email: <input name="email"><br>
    Telepon: <input name="telepon"><br>
    <button name="tambah">Tambah</button>
</form>
<?php endif; ?>

<table border="1" cellpadding="5">
<tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Aksi</th></tr>
<?php
$q = $conn->query("SELECT * FROM sales");
while($r = $q->fetch_assoc()): ?>
<tr>
    <td><?= $r['Sales_ID'] ?></td>
    <td><?= $r['nama_sales'] ?></td>
    <td><?= $r['email'] ?></td>
    <td><?= $r['telepon'] ?></td>
    <td>
        <a href="sales.php?edit=<?= $r['Sales_ID'] ?>">Edit</a> |
        <a href="sales.php?hapus=<?= $r['Sales_ID'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
