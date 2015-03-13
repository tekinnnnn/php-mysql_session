<?php
session_start();

if (isset($_SESSION["kulid"])) {} else {
    echo "<script>window.location.href = './';</script>";
}

include 'ayar.php';
?>