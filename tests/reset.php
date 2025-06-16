<?php

session_start();

$_SESSION = [];
session_destroy();
session_abort();
session_unset();
var_dump($_SESSION);


?>