<?php
$fruits = ["jablko", "banan", "pomarancza"];

foreach ($fruits as $fruit) {
    $inverted = "";
    for ($i = strlen($fruit) - 1; $i >= 0; $i--) {
        $inverted .= $fruit[$i];
    }

    $if_p = ($fruit[0] === 'p') ? "Tak" : "Nie";

    echo "Odwrocony: $inverted, Czy zaczyna się na 'p'?: $if_p<br>";
}
?>

