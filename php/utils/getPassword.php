<?php
include "functions.php";

$length = $_GET['length'] ?? 8;
$numbers = $_GET['numbers'] === "true";
$uppercase = $_GET['uppercase'] === "true";
$specialChars = $_GET['specialChars'] === "true";
$apple = $_GET['apple'] === "true";

echo generatePassword($length, $numbers, $uppercase, $specialChars, $apple);