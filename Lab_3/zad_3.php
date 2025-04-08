<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja Hotelu</title>
    <script>
        function pokazFormularze() {
            const iloscOsob = document.getElementById('ilosc_osob').value;
            const kontener = document.getElementById('formularze_osob');
            kontener.innerHTML = '';

            for (let i = 1; i <= iloscOsob; i++) {
                kontener.innerHTML += `
                    <fieldset>
                        <legend>Dane osoby ${i}</legend>
                        <label>Imię: <input type="text" name="osoby[${i}][imie]" required></label><br>
                        <label>Nazwisko: <input type="text" name="osoby[${i}][nazwisko]" required></label><br>
                        <label>Email: <input type="email" name="osoby[${i}][email]" required></label><br>
                    </fieldset><br>
                `;
            }
        }
    </script>
</head>
<body>
<h2>Formularz Rezerwacji Hotelu</h2>
<form action="zad_3_rezerwacja.php" method="post">

    <label>Ilość osób:
        <select id="ilosc_osob" name="ilosc_osob" required onchange="pokazFormularze()">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </label><br><br>

    <div id="formularze_osob"></div>

    <label>Adres: <input type="text" name="adres" required></label><br><br>
    <label>Numer karty kredytowej: <input type="text" name="karta" pattern="\d{16}" required></label><br><br>

    <label>Data przyjazdu: <input type="date" name="data_przyjazdu" required></label><br><br>
    <label>Godzina przyjazdu: <input type="time" name="godzina_przyjazdu" required></label><br><br>

    <label><input type="checkbox" name="lozko_dziecko" value="tak"> Potrzebuję dostawki dla dziecka</label><br><br>

    <label>Udogodnienia:<br>
        <input type="checkbox" name="udogodnienia[]" value="klimatyzacja"> Klimatyzacja<br>
        <input type="checkbox" name="udogodnienia[]" value="popielniczka"> Popielniczka dla palacza<br>
    </label><br><br>

    <button type="submit" name="dzialanie" value="zapisz">Zarezerwuj</button>
</form>

<form action="zad_3_rezerwacja.php" method="post">
    <button type="submit" name="dzialanie" value="wczytaj">Wczytaj zapisane dane</button>
</form>

</body>
</html>
