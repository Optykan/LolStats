<?php
$lines = file('loading.txt');
echo $lines[array_rand($lines)];
?>