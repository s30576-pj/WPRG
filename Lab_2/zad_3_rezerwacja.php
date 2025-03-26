<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ilosc_osob = htmlspecialchars($_POST['ilosc_osob']);
    $adres = htmlspecialchars($_POST['adres']);
    $karta = htmlspecialchars($_POST['karta']);
    $data_przyjazdu = htmlspecialchars($_POST['data_przyjazdu']);
    $godzina_przyjazdu = htmlspecialchars($_POST['godzina_przyjazdu']);
    $lozko_dziecko = isset($_POST['lozko_dziecko']) ? 'Tak' : 'Nie';
    $udogodnienia = isset($_POST['udogodnienia']) ? implode(', ', $_POST['udogodnienia']) : 'Brak';

    echo "<h2>Podsumowanie Rezerwacji</h2>";
    echo "<p>Ilość osób: $ilosc_osob</p>";

    if (isset($_POST['osoby'])) {
        foreach ($_POST['osoby'] as $nr => $osoba) {
            $imie = htmlspecialchars($osoba['imie']);
            $nazwisko = htmlspecialchars($osoba['nazwisko']);
            $email = htmlspecialchars($osoba['email']);
            echo "<h3>Osoba $nr:</h3>";
            echo "<p>Imię: $imie</p>";
            echo "<p>Nazwisko: $nazwisko</p>";
            echo "<p>Email: $email</p>";
        }
    }

    echo "<p>Adres: $adres</p>";
    echo "<p>Numer karty kredytowej: $karta</p>";
    echo "<p>Data przyjazdu: $data_przyjazdu</p>";
    echo "<p>Godzina przyjazdu: $godzina_przyjazdu</p>";
    echo "<p>Dostawka dla dziecka: $lozko_dziecko</p>";
    echo "<p>Udogodnienia: $udogodnienia</p>";

    echo '<p><a href="zad_3.php">Wróć do formularza</a></p>';
}
?>
