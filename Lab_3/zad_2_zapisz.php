<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = trim($_POST['imie']);
    $nazwisko = trim($_POST['nazwisko']);
    $email = trim($_POST['email']);

    $linia = "$imie $nazwisko, $email" . PHP_EOL;

    $plik = 'dane.txt';

    // Dopisz do pliku
    if (file_put_contents($plik, $linia, FILE_APPEND)) {
        echo "<p>Dane zostały zapisane poprawnie!</p>";
    } else {
        echo "<p>Wystąpił błąd podczas zapisu.</p>";
    }

    echo '<p><a href="zad_2.php">Wróć do formularza</a></p>';
}
?>
