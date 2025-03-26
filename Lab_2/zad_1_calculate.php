<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba1 = (float)$_POST['liczba1'];
    $liczba2 = (float)$_POST['liczba2'];
    $dzialanie = $_POST['dzialanie'];
    $wynik = 0;

    switch ($dzialanie) {
        case 'dodawanie':
            $wynik = $liczba1 + $liczba2;
            echo "<p>Wynik: $liczba1 + $liczba2 = $wynik</p>";
            break;
        case 'odejmowanie':
            $wynik = $liczba1 - $liczba2;
            echo "<p>Wynik: $liczba1 - $liczba2 = $wynik</p>";
            break;
        case 'mnozenie':
            $wynik = $liczba1 * $liczba2;
            echo "<p>Wynik: $liczba1 * $liczba2 = $wynik</p>";
            break;
        case 'dzielenie':
            if ($liczba2 != 0) {
                $wynik = $liczba1 / $liczba2;
                echo "<p>Wynik: $liczba1 / $liczba2 = $wynik</p>";
            } else {
                echo "<p>Błąd: Nie można dzielić przez zero!</p>";
            }
            break;
        default:
            echo "<p>Nieznane działanie!</p>";
    }
    echo '<p><a href="zad_1.php">Wróć do kalkulatora</a></p>';
}
?>

