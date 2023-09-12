<?php
session_start();
if (!isset($_SESSION['arr'])) {
   $_SESSION['arr'] = [];
}
foreach ($_SESSION['arr'] as $el) {
    $greenRed = null;
    if ($el['hit'] === 'Попал') $greenRed = 'table-response-right';
    else $greenRed = 'table-response-wrong';

    echo '<tr class="'.$greenRed.'">
                        <th>'.$el['x'].'</th>
                        <th>'.$el['y'].'</th>
                        <th>'.$el['r'].'</th>
                        <th>'.$el['time'].'</th>
                        <th>'.$el['dif']. ' мс</th>
                        <th>'.$el['hit'].'</th>
                    </tr>';
} // добавить проверку на попадание и в зависимости от этого менять класс
