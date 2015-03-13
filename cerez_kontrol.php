<?php
session_start();

if (isset($_COOKIE["kulid"])) {
    $_SESSION["kulid"] = $_COOKIE["kulid"];
    $_SESSION["adi"] = $_COOKIE["adi"];
    $_SESSION["soyadi"] = $_COOKIE["soyadi"];
    $_SESSION["mail"] = $_COOKIE["mail"];
    echo "<script>window.location.href = 'admin.php';</script>";
}

?>