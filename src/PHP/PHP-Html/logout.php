<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["UID"]);
session_destroy();

header("location:./login.php");
