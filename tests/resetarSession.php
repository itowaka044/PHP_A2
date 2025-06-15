<?php

var_dump($_SESSION);
$_SESSION = [];
session_abort();
var_dump($_SESSION);

?>