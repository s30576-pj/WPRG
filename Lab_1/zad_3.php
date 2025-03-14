<?php
function fibonacci($n) {
    $fib = [0, 1];

    for ($i = 2; $i < $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }

    return $fib;
}

function enterOdd($fib) {
    $index = 1;

    foreach ($fib as $number) {
        if ($number % 2 != 0) {
            echo "$index: $number<br>";
            $index++;
        }
    }
}

$N = 15;
$fibArray = fibonacci($N);
enterOdd($fibArray);

?>
