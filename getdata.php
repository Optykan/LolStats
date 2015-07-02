<?php
$json = "champions.json";
$decoded = json_decode($json);
$users = $decoded->result;
function my_sort($a, $b)
    
{
    if ($a->credits > $b->credits) {
        return -1;
    } else if ($a->credits < $b->credits) {
        return 1;
    } else {
        return 0; 
    }
}

usort($users, 'my_sort');

?>