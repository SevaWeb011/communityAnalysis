<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function startTime()
{
    return microtime(true);
}

function printTime($time, $msg = "")
{
    echo "<br> Время $msg - ".round(microtime(true) - $time, 4).' сек.';
}
?>