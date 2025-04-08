<?php
$plik_csv = "rezerwacje.csv";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['dzialanie'] === "zapisz") {
        $ilosc_osob = $_POST['ilosc_osob'];
        $adres = $_POST['adres'];
        $karta = $_POST['karta'];
        $data_przyjazdu = $_POST['data_przyjazdu'];
        $godzina_przyjazdu = $_POST['godzina_przyjazdu'];
        $lozko_dziecko = isset($_POST['lozko_dziecko']) ? 'Tak' : 'Nie';
        $udogodnienia = isset($_POST['udogodnienia']) ? implode(',', $_POST['udogodnienia']) : 'Brak';

        $osoby = [];
        if (isset($_POST['osoby'])) {
            foreach ($_POST['osoby'] as $nr => $osoba) {
                $osoby[] = $osoba['imie'] . ' ' . $osoba['nazwisko'] . ' (' . $osoba['email'] . ')';
            }
        }
        $osoby_str = implode(" | ", $osoby);

        $dane = [
            $ilosc_osob,
            $osoby_str,
            $adres,
            $karta,
            $data_przyjazdu,
            $godzina_przyjazdu,
            $lozko_dziecko,
            $udogodnienia
        ];

        if (!file_exists($plik_csv) || filesize($plik_csv) == 0) {
            $naglowki = [
                "Ilość osób", "Dane osób", "Adres", "Karta", "Data przyjazdu",
                "Godzina przyjazdu", "Dostawka dla dziecka", "Udogodnienia"
            ];
            file_put_contents($plik_csv, implode(";", $naglowki) . PHP_EOL, FILE_APPEND);
        }

        file_put_contents($plik_csv, implode(";", $dane) . PHP_EOL, FILE_APPEND);

        echo "<p><strong>Rezerwacja została zapisana!</strong></p>";
        echo '<p><a href="zad_3.php">Powrót</a></p>';

    } elseif ($_POST['dzialanie'] === "wczytaj") {
        echo "<h2>Zapisane Rezerwacje:</h2>";
        if (file_exists($plik_csv) && filesize($plik_csv) > 0) {
            $plik = fopen($plik_csv, "r");
            echo "<table border='1' cellpadding='5'>";
            while (($wiersz = fgetcsv($plik, 1000, ";")) !== false) {
                echo "<tr>";
                foreach ($wiersz as $pole) {
                    echo "<td>" . htmlspecialchars($pole) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            fclose($plik);
        } else {
            echo "<p>Brak zapisanych danych.</p>";
        }

        echo '<p><a href="zad_3.php">Powrót</a></p>';
    }
}
?>
