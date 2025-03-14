<?php
$text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
galley of type and scrambled it to make a type specimen book. It has survived not only five
centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
and more recently with desktop publishing software like Aldus PageMaker including versions of
Lorem Ipsum.";

$array = explode(" ", $text);

for ($i = 0; $i < count($array); $i++) {
    $word = $array[$i];
    $clear_word = "";

    for ($j = 0; $j < strlen($word); $j++) {
        if (
            ($word[$j] >= 'A' && $word[$j] <= 'Z') ||
            ($word[$j] >= 'a' && $word[$j] <= 'z') ||
            ($word[$j] >= '0' && $word[$j] <= '9')
        ) {
            $clear_word .= $word[$j];
        }
    }

    $array[$i] = $clear_word;
}

$array = array_values(array_filter($array));

$associative = [];
for ($i = 0; $i < count($array) - 1; $i += 2) {
    $associative[$array[$i]] = $array[$i + 1];
}

foreach ($associative as $key => $value) {
    echo "$key => $value<br>";
}
?>
