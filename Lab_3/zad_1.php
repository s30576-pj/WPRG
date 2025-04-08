<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator</title>
</head>
<body>
<h2>Kalkulator</h2>
<form action="zad_1_calculate.php" method="post">
    <label>Podaj pierwszą liczbę: <input type="number" name="liczba1" required></label><br><br>
    <label>Podaj drugą liczbę: <input type="number" name="liczba2" required></label><br><br>
    <label>Wybierz działanie:
        <select name="dzialanie">
            <option value="dodawanie">Dodawanie (+)</option>
            <option value="odejmowanie">Odejmowanie (-)</option>
            <option value="mnozenie">Mnożenie (*)</option>
            <option value="dzielenie">Dzielenie (/)</option>
        </select>
    </label><br><br>
    <button type="submit">Oblicz</button>
</form>
</body>
</html>