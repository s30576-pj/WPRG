<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja Hotelu</title>
</head>
<body>
<h2>Formularz Rezerwacji Hotelu</h2>
<form action="zad_2_rezerwacja.php" method="post">

    <label>Ilość osób:
        <select name="ilosc_osob" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </label><br><br>

    <label>Imię: <input type="text" name="imie" required></label><br><br>
    <label>Nazwisko: <input type="text" name="nazwisko" required></label><br><br>
    <label>Adres: <input type="text" name="adres" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Numer karty kredytowej: <input type="text" name="karta" pattern="\d{16}" required></label><br><br>

    <label>Data przyjazdu: <input type="date" name="data_przyjazdu" required></label><br><br>
    <label>Godzina przyjazdu: <input type="time" name="godzina_przyjazdu" required></label><br><br>

    <label><input type="checkbox" name="lozko_dziecko" value="tak"> Potrzebuję dostawki dla dziecka</label><br><br>

    <label>Udogodnienia:<br>
        <input type="checkbox" name="udogodnienia[]" value="klimatyzacja"> Klimatyzacja<br>
        <input type="checkbox" name="udogodnienia[]" value="popielniczka"> Popielniczka dla palacza<br>
    </label><br><br>

    <button type="submit">Zarezerwuj</button>
</form>
</body>
</html>