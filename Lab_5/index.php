<?php include 'db.php'; ?>
<?php include 'menu.php'; ?>

<h2>5 najtańszych samochodów</h2>
<table border="1">
<tr><th>Marka</th><th>Model</th><th>Cena</th></tr>

<?php
$query = "SELECT marka, model, cena FROM samochody ORDER BY cena ASC LIMIT 5";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['marka']}</td>
        <td>{$row['model']}</td>
        <td>{$row['cena']}</td>
    </tr>";
}
?>
</table>
