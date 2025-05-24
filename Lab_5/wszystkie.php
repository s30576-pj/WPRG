<?php include 'db.php'; ?>
<?php include 'menu.php'; ?>

<h2>Wszystkie samochody</h2>
<table border="1">
<tr><th>ID</th><th>Marka</th><th>Model</th><th>Cena</th><th>Szczegóły</th></tr>

<?php
$query = "SELECT * FROM samochody ORDER BY rok DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['marka']}</td>
        <td>{$row['model']}</td>
        <td>{$row['cena']}</td>
        <td><a href='szczegoly.php?id={$row['id']}'>Szczegóły</a></td>
    </tr>";
}
?>
</table>
