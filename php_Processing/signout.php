<?php
session_start();

session_destroy();

header("Location: http://localhost/lab4/Html_Views/MySitePage.php");

exit;
?>