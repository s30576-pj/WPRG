<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<!DOCTYPE html><html lang='pl'><head><meta charset='UTF-8'><title>Brak dostępu</title>";
    echo "<style>body { font-family: sans-serif; text-align: center; margin-top: 50px; }</style></head><body>";
    echo "<h1>Brak Dostępu</h1>";
    echo "<p>Nie masz uprawnień do przeglądania tej strony, ponieważ nie jesteś zalogowany/a.</p>";
    echo "<p>Aby uzyskać dostęp, musisz się najpierw <a href='login.php'>zalogować</a>.</p>";
    echo "</body></html>";
    exit;
}

function get_form_cookie_value($field_name, $default_value = '') {
    $cookie_name = FORM_DATA_COOKIE_PREFIX . $field_name;
    return isset($_COOKIE[$cookie_name]) ? htmlspecialchars($_COOKIE[$cookie_name]) : $default_value;
}

function set_form_cookie($field_name, $value) {
    setcookie(FORM_DATA_COOKIE_PREFIX . $field_name, $value, COOKIE_LIFETIME, COOKIE_PATH);
}

function clear_form_cookie($field_name) {
    setcookie(FORM_DATA_COOKIE_PREFIX . $field_name, '', time() - 3600, COOKIE_PATH);
}

if (isset($_POST['clear_form_cookies'])) {
    $fields_to_clear = [
        'ilosc_osob', 'adres', 'karta', 'data_przyjazdu', 'godzina_przyjazdu',
        'lozko_dziecko', 'udogodnienia_klimatyzacja', 'udogodnienia_popielniczka'
    ];
    for ($i = 1; $i <= 4; $i++) { // Max 4 people
        $fields_to_clear[] = "osoba_{$i}_imie";
        $fields_to_clear[] = "osoba_{$i}_nazwisko";
        $fields_to_clear[] = "osoba_{$i}_email";
    }
    foreach ($fields_to_clear as $field) {
        clear_form_cookie($field);
    }
    foreach ($_COOKIE as $key => $value) {
        if (strpos($key, FORM_DATA_COOKIE_PREFIX) === 0) {
            unset($_COOKIE[$key]);
        }
    }
    header("Location: rezerwacja.php");
    exit;
}

$submission_summary = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_reservation'])) {
    set_form_cookie('ilosc_osob', $_POST['ilosc_osob']);
    set_form_cookie('adres', $_POST['adres']);
    set_form_cookie('karta', $_POST['karta']);
    set_form_cookie('data_przyjazdu', $_POST['data_przyjazdu']);
    set_form_cookie('godzina_przyjazdu', $_POST['godzina_przyjazdu']);
    set_form_cookie('lozko_dziecko', isset($_POST['lozko_dziecko']) ? 'tak' : 'nie');

    set_form_cookie('udogodnienia_klimatyzacja', in_array('klimatyzacja', $_POST['udogodnienia'] ?? []) ? 'tak' : 'nie');
    set_form_cookie('udogodnienia_popielniczka', in_array('popielniczka', $_POST['udogodnienia'] ?? []) ? 'tak' : 'nie');

    if (isset($_POST['osoby'])) {
        foreach ($_POST['osoby'] as $nr => $osoba) {
            set_form_cookie("osoba_{$nr}_imie", $osoba['imie']);
            set_form_cookie("osoba_{$nr}_nazwisko", $osoba['nazwisko']);
            set_form_cookie("osoba_{$nr}_email", $osoba['email']);
        }
    }
    $current_ilosc_osob = intval($_POST['ilosc_osob']);
    for ($i = $current_ilosc_osob + 1; $i <= 4; $i++) {
        clear_form_cookie("osoba_{$i}_imie");
        clear_form_cookie("osoba_{$i}_nazwisko");
        clear_form_cookie("osoba_{$i}_email");
    }


    $ilosc_osob_sum = htmlspecialchars($_POST['ilosc_osob']);
    $adres_sum = htmlspecialchars($_POST['adres']);
    $karta_sum = htmlspecialchars($_POST['karta']);
    $data_przyjazdu_sum = htmlspecialchars($_POST['data_przyjazdu']);
    $godzina_przyjazdu_sum = htmlspecialchars($_POST['godzina_przyjazdu']);
    $lozko_dziecko_sum = isset($_POST['lozko_dziecko']) ? 'Tak' : 'Nie';
    $udogodnienia_sum = isset($_POST['udogodnienia']) ? implode(', ', array_map('htmlspecialchars', $_POST['udogodnienia'])) : 'Brak';

    $submission_summary .= "<h2>Podsumowanie Rezerwacji</h2>";
    $submission_summary .= "<p>Ilość osób: $ilosc_osob_sum</p>";

    if (isset($_POST['osoby'])) {
        foreach ($_POST['osoby'] as $nr => $osoba) {
            $imie_sum = htmlspecialchars($osoba['imie']);
            $nazwisko_sum = htmlspecialchars($osoba['nazwisko']);
            $email_sum = htmlspecialchars($osoba['email']);
            $submission_summary .= "<h3>Osoba $nr:</h3>";
            $submission_summary .= "<p>Imię: $imie_sum</p>";
            $submission_summary .= "<p>Nazwisko: $nazwisko_sum</p>";
            $submission_summary .= "<p>Email: $email_sum</p>";
        }
    }

    $submission_summary .= "<p>Adres: $adres_sum</p>";
    $submission_summary .= "<p>Numer karty kredytowej: ". substr($karta_sum, 0, 4) . str_repeat('*', 8) . substr($karta_sum, -4) ." (częściowo ukryty)</p>";
    $submission_summary .= "<p>Data przyjazdu: $data_przyjazdu_sum</p>";
    $submission_summary .= "<p>Godzina przyjazdu: $godzina_przyjazdu_sum</p>";
    $submission_summary .= "<p>Dostawka dla dziecka: $lozko_dziecko_sum</p>";
    $submission_summary .= "<p>Udogodnienia: $udogodnienia_sum</p>";
    $submission_summary .= '<p><a href="rezerwacja.php">Wróć do formularza</a></p>';
}

$ilosc_osob_cookie = get_form_cookie_value('ilosc_osob', '1');
$adres_cookie = get_form_cookie_value('adres');
$karta_cookie = get_form_cookie_value('karta');
$data_przyjazdu_cookie = get_form_cookie_value('data_przyjazdu');
$godzina_przyjazdu_cookie = get_form_cookie_value('godzina_przyjazdu');
$lozko_dziecko_cookie = get_form_cookie_value('lozko_dziecko') === 'tak';
$klimatyzacja_cookie = get_form_cookie_value('udogodnienia_klimatyzacja') === 'tak';
$popielniczka_cookie = get_form_cookie_value('udogodnienia_popielniczka') === 'tak';

$welcome_username = isset($_COOKIE[LOGGED_IN_USER_COOKIE_NAME]) ? htmlspecialchars($_COOKIE[LOGGED_IN_USER_COOKIE_NAME]) : 'Gościu';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja Hotelu</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2, h3 { color: #333; }
        fieldset { border: 1px solid #ccc; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        legend { font-weight: bold; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="date"], input[type="time"], select {
            width: calc(100% - 22px); padding: 8px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 3px;
        }
        input[type="checkbox"] { margin-right: 5px; vertical-align: middle; }
        button, .button-link {
            padding: 10px 15px; background-color: #007bff; color: white; border: none;
            border-radius: 3px; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 10px;
        }
        button:hover, .button-link:hover { background-color: #0056b3; }
        .button-danger { background-color: #dc3545; }
        .button-danger:hover { background-color: #c82333; }
        .user-info { float: right; }
        .summary { margin-top: 20px; padding: 15px; background-color: #f9f9f9; border: 1px solid #eee; border-radius: 4px;}
    </style>
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return decodeURIComponent(parts.pop().split(';').shift());
            return '';
        }

        function pokazFormularze() {
            const iloscOsob = document.getElementById('ilosc_osob').value;
            const kontener = document.getElementById('formularze_osob');
            kontener.innerHTML = ''; // Clear previous forms

            for (let i = 1; i <= iloscOsob; i++) {
                let imieVal = getCookie('<?php echo FORM_DATA_COOKIE_PREFIX; ?>osoba_' + i + '_imie');
                let nazwiskoVal = getCookie('<?php echo FORM_DATA_COOKIE_PREFIX; ?>osoba_' + i + '_nazwisko');
                let emailVal = getCookie('<?php echo FORM_DATA_COOKIE_PREFIX; ?>osoba_' + i + '_email');

                kontener.innerHTML += `
                    <fieldset>
                        <legend>Dane osoby ${i}</legend>
                        <label>Imię: <input type="text" name="osoby[${i}][imie]" value="${imieVal}" required></label><br>
                        <label>Nazwisko: <input type="text" name="osoby[${i}][nazwisko]" value="${nazwiskoVal}" required></label><br>
                        <label>Email: <input type="email" name="osoby[${i}][email]" value="${emailVal}" required></label><br>
                    </fieldset><br>
                `;
            }
        }

        window.onload = function() {
            const iloscOsobSelect = document.getElementById('ilosc_osob');
            if (iloscOsobSelect) {
                const iloscOsobCookieVal = getCookie('<?php echo FORM_DATA_COOKIE_PREFIX; ?>ilosc_osob');
                if (iloscOsobCookieVal) {
                    iloscOsobSelect.value = iloscOsobCookieVal;
                }
                pokazFormularze();
            }
        };
    </script>
</head>
<body>

<div class="user-info">
    Witaj, <?php echo $welcome_username; ?>!
    <a href="logout.php" class="button-link button-danger">Wyloguj</a>
</div>

<h2>Formularz Rezerwacji Hotelu</h2>

<?php if ($submission_summary): ?>
    <div class="summary">
        <?php echo $submission_summary; ?>
    </div>
<?php else:  ?>
    <form action="rezerwacja.php" method="post" id="reservationForm">

        <label>Ilość osób:
            <select id="ilosc_osob" name="ilosc_osob" required onchange="pokazFormularze()">
                <option value="1" <?php if ($ilosc_osob_cookie == '1') echo 'selected'; ?>>1</option>
                <option value="2" <?php if ($ilosc_osob_cookie == '2') echo 'selected'; ?>>2</option>
                <option value="3" <?php if ($ilosc_osob_cookie == '3') echo 'selected'; ?>>3</option>
                <option value="4" <?php if ($ilosc_osob_cookie == '4') echo 'selected'; ?>>4</option>
            </select>
        </label><br><br>

        <div id="formularze_osob">
        </div>

        <label>Adres: <input type="text" name="adres" value="<?php echo $adres_cookie; ?>" required></label><br><br>
        <label>Numer karty kredytowej: <input type="text" name="karta" pattern="\d{16}" title="Podaj 16 cyfr numeru karty" value="<?php echo $karta_cookie; ?>" required></label><br><br>

        <label>Data przyjazdu: <input type="date" name="data_przyjazdu" value="<?php echo $data_przyjazdu_cookie; ?>" required></label><br><br>
        <label>Godzina przyjazdu: <input type="time" name="godzina_przyjazdu" value="<?php echo $godzina_przyjazdu_cookie; ?>" required></label><br><br>

        <label><input type="checkbox" name="lozko_dziecko" value="tak" <?php if ($lozko_dziecko_cookie) echo 'checked'; ?>> Potrzebuję dostawki dla dziecka</label><br><br>

        <label>Udogodnienia:<br>
            <input type="checkbox" name="udogodnienia[]" value="klimatyzacja" <?php if ($klimatyzacja_cookie) echo 'checked'; ?>> Klimatyzacja<br>
            <input type="checkbox" name="udogodnienia[]" value="popielniczka" <?php if ($popielniczka_cookie) echo 'checked'; ?>> Popielniczka dla palacza<br>
        </label><br><br>

        <button type="submit" name="submit_reservation">Zarezerwuj</button>
        <button type="submit" name="clear_form_cookies" formnovalidate class="button-danger">Wyczyść Formularz (usuń ciasteczka)</button>
    </form>
<?php endif; ?>

</body>
</html>