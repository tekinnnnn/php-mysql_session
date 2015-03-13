<?php
session_start();
session_destroy();
setcookie("kulid", "", time() - 1);
setcookie("adi", "", time() - 1);
setcookie("soyadi", "", time() - 1);
setcookie("mail", "", time() - 1);
echo "<script>window.location.href='index.php';</script>";

?>