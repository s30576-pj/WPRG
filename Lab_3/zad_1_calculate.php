<?php
require('zad_1_funkcje.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba1 = (float)$_POST['liczba1'];
    $liczba2 = (float)$_POST['liczba2'];
    $dzialanie = $_POST['dzialanie'];
    $wynik = "";

    switch ($dzialanie) {
        case 'dodawanie':
            $wynik = dodawanie($liczba1, $liczba2);
            echo "<p>Wynik: $liczba1 + $liczba2 = $wynik</p>";
            break;
        case 'odejmowanie':
            $wynik = odejmowanie($liczba1, $liczba2);
            echo "<p>Wynik: $liczba1 - $liczba2 = $wynik</p>";
            break;
        case 'mnozenie':
            $wynik = mnozenie($liczba1, $liczba2);
            echo "<p>Wynik: $liczba1 * $liczba2 = $wynik</p>";
            break;
        case 'dzielenie':
            $wynik = dzielenie($liczba1, $liczba2);
            if (is_string($wynik)) {
                echo "<p>$wynik</p>";
            } else {
                echo "<p>Wynik: $liczba1 / $liczba2 = $wynik</p>";
            }
            break;
        default:
            echo "<p>Nieznane działanie!</p>";
    }
    echo '<p><a href="zad_1.php">Wróć do kalkulatora</a></p>';
}
?>

