<?php

// veritabanı bağlantsı için değişkenler oluşturuluyor
$host = "localhost";
$vtAdi = "kullanici_giris";
$kullaniciAdi = "root";
$sifre = "";

// bağlantı gerçekleştiriliyor
$baglan = @mysql_connect($host, $kullaniciAdi, $sifre);
if ($baglan) {
    // bağlantı başarılı database seçimini yap
    $db_sec = @mysql_select_db($vtAdi, $baglan);
    if ($db_sec) {
        // işlem başarılı
    } else {
        echo "MySQL DB seçimi başarısız : " . mysql_error();
    }
} else {
    echo "MySQL bağlantısı başarısız. " . mysql_error();
}

?>