<?php include 'db.php'; ?>
<?php include 'menu.php'; ?>

<h2>Dodaj nowy samochód</h2>

<form method="POST">
    Marka: <input type="text" name="marka" required><br>
    Model: <input type="text" name="model" required><br>
    Cena: <input type="number" step="0.01" name="cena" required><br>
    Rok: <input type="number" name="rok" required><br>
    Opis: <textarea name="opis" required></textarea><br>
    <input type="submit" value="Dodaj">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marka = mysqli_real_escape_string($conn, $_POST['marka']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = mysqli_real_escape_string($conn, $_POST['opis']);

    $query = "INSERT INTO samochody (marka, model, cena, rok, opis)
              VALUES ('$marka', '$model', $cena, $rok, '$opis')";

    if (mysqli_query($conn, $query)) {
        echo "Nowy samochód został dodany!";
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
}
?>
