<?php include 'db.php'; ?>
<?php include 'menu.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM samochody WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<h2>Szczegóły samochodu</h2>
<ul>
    <li><strong>ID:</strong> <?= $row['id'] ?></li>
    <li><strong>Marka:</strong> <?= $row['marka'] ?></li>
    <li><strong>Model:</strong> <?= $row['model'] ?></li>
    <li><strong>Cena:</strong> <?= $row['cena'] ?></li>
    <li><strong>Rok:</strong> <?= $row['rok'] ?></li>
    <li><strong>Opis:</strong> <?= $row['opis'] ?></li>
</ul>
<a href="index.php">Powrót do strony głównej</a>
