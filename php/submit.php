<?php
function validate_num($num, $a, $b) {
    return isset($num) && is_numeric($num) && $num >= $a && $num <= $b;
}

function check_rectangle($x, $y, $r) { //проверка попадания в прямоугольник
    return $x>=0 && $y >= 0 && $x <= $r/2 && $y <= $r;
}

function check_triangle($x, $y, $r) { // треугольник
    return $x<=0 && $y<=0 && $x<=$r && $y<=$r && $x*$y <= $r*$r;
}

function check_circle($x, $y, $r) { // четверть круга
    return $x<=0 && $y>=0 && sqrt($x*$x+$y*$y)<=abs($r)/2;
}

session_start();
if (!isset($_SESSION['arr'])) {
    $_SESSION['arr'] = [];
}
$start = microtime(true);
date_default_timezone_set('Europe/Moscow');


$x = @$_GET['x'];
$y = @$_GET['y'];
$r = @$_GET['r'];

// добавить время

if (validate_num($x, -3, 5) && validate_num($y, -5, 5) && validate_num($r, 1, 4)) {
    $hit = check_rectangle($x, $y, $r) || check_triangle($x, $y, $r) || check_circle($x, $y, $r) ? 'Попал' : 'Мимо';
    $time = date('H:i:s');
    $diffTime = number_format(microtime(true) - $start, 10, '.', '')*1000000;
    array_push($_SESSION['arr'], ['x'=>$x, 'y'=>$y, 'r'=>$r, 'time'=>$time, 'dif'=> $diffTime, 'hit'=>$hit]);
}

foreach($_SESSION['arr'] as $el) {
    $greenRed = null;
    if ($el['hit'] === 'Попал') $greenRed = 'table-response-right';
    else $greenRed = 'table-response-wrong';

    echo '<tr class="'.$greenRed.'">
                        <th>'. $el['x'] .'</th>
                        <th>'. $el['y'] .'</th>
                        <th>'. $el['r'] .'</th>
                        <th>'.$el['time'].'</th>
                        <th>'.$el['dif']. ' мс</th>
                        <th>'. @$el['hit'] .'</th>
                    </tr>';
}

