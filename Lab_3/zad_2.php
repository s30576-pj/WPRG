<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz zapisu do pliku</title>
</head>
<body>
<h2>Formularz zapisu danych</h2>
<form action="zad_2_zapisz.php" method="post">
    <label>Imię: <input type="text" name="imie" required></label><br><br>
    <label>Nazwisko: <input type="text" name="nazwisko" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <button type="submit">Zapisz</button>
</form>
</body>
</html>
