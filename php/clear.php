<?php
session_start();
if (!isset($_SESSION['arr'])) {
    $_SESSION['arr'] = [];
}
$_SESSION['arr'] = [];
echo '';
