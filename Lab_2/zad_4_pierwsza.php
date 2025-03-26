<?php
function czyLiczbaPierwsza($liczba, &$iteracje) {
    if ($liczba < 2) return false;
    if ($liczba == 2) return true;

    if ($liczba % 2 == 0) return false;

    $granica = sqrt($liczba);
    for ($i = 3; $i <= $granica; $i += 2) {
        $iteracje++;
        if ($liczba % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $liczba = filter_input(INPUT_POST, 'liczba', FILTER_VALIDATE_INT);

    if ($liczba === false || $liczba < 1) {
        echo "<p>Podaj poprawną, dodatnią liczbę całkowitą.</p>";
        echo '<p><a href="zad_4.php">Wróć do formularza</a></p>';
        exit;
    }

    $iteracje = 0;
    $wynik = czyLiczbaPierwsza($liczba, $iteracje);

    echo "<h2>Wynik</h2>";
    echo "<p>Podana liczba: $liczba</p>";
    echo "<p>Czy liczba jest pierwsza? " . ($wynik ? 'Tak' : 'Nie') . "</p>";
    echo "<p>Liczba iteracji: $iteracje</p>";
    echo '<p><a href="zad_4.php">Wróć do formularza</a></p>';
}
?>
