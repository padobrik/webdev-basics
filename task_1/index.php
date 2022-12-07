<?php
    $counter = 1;
    $path = $_SERVER['PHP_SELF'];
    echo "<br>";
    $filename = basename($path, ".php")."-page_counter.txt";

    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        $count_actual = fgets($file) + 1;
        fclose($file);
    }
    else {
        $count_actual = $counter;
    }
$file = fopen($filename, "w");
fwrite($file, $count_actual);
fclose($file);
echo "You have visited this page $count_actual times";
?>