<?php
session_start();
session_unset();
session_destroy();
header("Location: login2.php");
exit();
?>
