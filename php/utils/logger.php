<?php

const LOGS_DIR = __DIR__ . "/../../logs/";

function logRequest($url): void
{
    $log = fopen(LOGS_DIR . "requests.log", "a");
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $logMessage = "$date - $ip - $uri - $method\n";
    fwrite($log, $logMessage);
    fclose($log);
}

function logHeaders($url): void
{
    $log = fopen(LOGS_DIR . "headers.log", "a");
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $headers = getallheaders();
    $logMessage = "$date - $ip - $uri - $method\n";
    foreach ($headers as $key => $value) {
        $logMessage .= "$key: $value\n";
    }
    $logMessage .= "=============================================\n";
    fwrite($log, $logMessage);
    fclose($log);
}
