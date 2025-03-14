<?php
function validatePrimeNumber($number) {
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i * $i <= $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }
    return true;
}

function enterPrimeNumber($first, $last) {
    echo "Liczby pierwsze w zakresie $first - $last:<br>";
    for ($i = $first; $i <= $last; $i++) {
        if (validatePrimeNumber($i)) {
            echo $i . " ";
        }
    }
}

$first = 10;
$last = 50;

enterPrimeNumber($first, $last);
?>
