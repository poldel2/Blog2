<?php

$password = "qweqwe";
$password1 = "qweqwe1";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
var_dump(password_verify($password1, $hash)); // должно выводить bool(true)
