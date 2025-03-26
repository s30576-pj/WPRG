<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ilosc_osob = htmlspecialchars($_POST['ilosc_osob']);
    $imie = htmlspecialchars($_POST['imie']);
    $nazwisko = htmlspecialchars($_POST['nazwisko']);
    $adres = htmlspecialchars($_POST['adres']);
    $email = htmlspecialchars($_POST['email']);
    $karta = htmlspecialchars($_POST['karta']);
    $data_przyjazdu = htmlspecialchars($_POST['data_przyjazdu']);
    $godzina_przyjazdu = htmlspecialchars($_POST['godzina_przyjazdu']);
    $lozko_dziecko = isset($_POST['lozko_dziecko']) ? 'Tak' : 'Nie';
    $udogodnienia = isset($_POST['udogodnienia']) ? implode(', ', $_POST['udogodnienia']) : 'Brak';

    echo "<h2>Podsumowanie Rezerwacji</h2>";
    echo "<p>Ilość osób: $ilosc_osob</p>";
    echo "<p>Imię: $imie</p>";
    echo "<p>Nazwisko: $nazwisko</p>";
    echo "<p>Adres: $adres</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Numer karty kredytowej: $karta</p>";
    echo "<p>Data przyjazdu: $data_przyjazdu</p>";
    echo "<p>Godzina przyjazdu: $godzina_przyjazdu</p>";
    echo "<p>Dostawka dla dziecka: $lozko_dziecko</p>";
    echo "<p>Udogodnienia: $udogodnienia</p>";

    echo '<p><a href="zad_2.php">Wróć do formularza</a></p>';
}
?>
