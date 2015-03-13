<?php
session_start();
include 'ayar.php';

if (isset($_POST["giris"])) {
    $mail = trim($_POST["email"]);
    $sifre = trim(md5($_POST["password"]));
    $hatirla = $_POST["hatirla"] == on ? true : false;
    
    $kontrol = mysql_query(
            "SELECT * FROM kullanicilar WHERE mail = '$mail' and sifre = '$sifre'");
    $satir_sayi = mysql_num_rows($kontrol);
    if ($satir_sayi > 0) {
        $row = mysql_fetch_array($kontrol);
        $_SESSION["kulid"] = $row["id"];
        $_SESSION["adi"] = $row["adi"];
        $_SESSION["soyadi"] = $row["soyadi"];
        $_SESSION["mail"] = $row["mail"];
        
        if (isset($_POST["hatirla"])) {
            setcookie("kulid", $row["id"], time() + (60 * 60 * 24 * 7));
            setcookie("adi", $row["adi"], time() + (60 * 60 * 24 * 7));
            setcookie("soyadi", $row["soyadi"], time() + (60 * 60 * 24 * 7));
            setcookie("mail", $row["mail"], time() + (60 * 60 * 24 * 7));
        }
        
        echo "<script>window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Mail ya da Şifre hatalı!');</script>";
        echo "<script>window.location.href = 'giris.php';</script>";
    }
}

if (isset($_POST["kayit"])) {
    $mail = trim($_POST["email"]);
    $sifre = trim(md5($_POST["sifre"]));
    $adi = trim($_POST["adi"]);
    $soyadi = trim($_POST["soyadi"]);
    
    $mailKontrol = mysql_query(
            "SELECT * FROM kullanicilar WHERE mail = '$mail'");
    $mailSayi = mysql_num_rows($mailKontrol);
    if ($mailSayi > 0) {
        echo "<script>alert('Bu mail adresi ile daha önceden kayıt yapılmış');</script>";
        echo "<script>window.location.href = 'kayit.php';</script>";
    } else {
        $kayit = mysql_query(
                "INSERT INTO kullanicilar VALUES (null,'$mail','$sifre','$adi','$soyadi',now())");
        // now() fonksiyonu mysql fonksiyonudur
        if ($kayit) {
            $data = mysql_fetch_array(
                    mysql_query(
                            "SELECT * FROM kullanicilar WHERE mail = '$mail' LIMIT 0,1"));
            $_SESSION["kulid"] = $data["id"];
            $_SESSION["adi"] = $data["adi"];
            $_SESSION["soyadi"] = $data["soyadi"];
            $_SESSION["mail"] = $data["mail"];
            echo "<script>window.location.href = 'admin.php';</script>";
        } else {
            echo "<script>alert('Kayıt işlemi hatalı!');</script>";
            echo "<script>window.location.href = 'kayit.php';</script>";
        }
    }
}

if (isset($_POST["sifirla"]) && isset($_POST["gsoru"]) && isset($_POST["email"])) {
    $gsoru = $_POST["gsoru"];
    $email = $_POST["email"];
    $sifirla = mysql_query(
            "SELECT * FROM kullanicilar WHERE mail = '$email' and gsoru = '$gsoru'");
    $sifirla_sayi = mysql_num_rows($sifirla);
    $sifirla_fetch = mysql_fetch_assoc($sifirla);
    if ($sifirla_sayi > 0) {
        setcookie("sifirla", $sifirla_fetch["id"], time() + 60 * 3);
        echo "<script>window.location.href = 'sreset.php';</script>";
    } else {
                echo "<script>alert('E-Mail ve gizli cevap uyuşmuyor!');</script>";
        echo "<script>window.location.href = 'sifirla.php';</script>";
    }
}

if (isset($_POST["ssifirla"]) && isset($_POST["password"]) &&
         isset($_POST["repassword"])) {
    if (isset($_COOKIE["sifirla"])) {
        if ($_POST["password"] == $_POST["repassword"]) {
            $pass = md5($_POST["password"]);
            $query = mysql_query(
                    "UPDATE `kullanicilar` SET `sifre`='" . $pass .
                             "' WHERE `id` = '" . $_COOKIE["sifirla"] . "'");
            if ($query) {
                setcookie("sifirla", "", time() - 1);
                echo "<script>alert('Tebrikler, şifreniz sıfırlandı! Yeni şifrenizle giriş yapabilirsiniz..');</script>";
                echo "<script>window.location.href = 'giris.php';</script>";
            } else {
                echo "<script>alert('Hata!');</script>";
            }
        } else {
            echo "<script>alert('Girilen şifreler uyuşmuyor!');</script>";
            echo "<script>window.location.href = 'sreset.php';</script>";
        }
    } else {
        echo "<script>alert('3 dakika içerisinde işlem yapmadınız. Tekrar gizli soru doğrulama sayfasına yönlendiriliyorsunuz...');</script>";
        echo "<script>window.location.href = 'sifirla.php';</script>";
    }
}

?>