<?php
session_start();
include 'cerez_kontrol.php';

if (isset($_SESSION["kulid"])) {
    $giris_class = "giris-basarili";
    $giris_yazi = "Hoşgeldiniz " . $_SESSION["adi"] . " " . $_SESSION["soyadi"] .
             ' <a href="cikis.php">Çıkış Yap</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Oturum Aç</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

	<form action="kontrol.php" method="POST" autocomplete="off">
		<fieldset class="login-form">
			<legend>
				<a href="kayit.php">Kayıt Ol</a>
			</legend>
			<h3>Oturum Aç</h3>
			<hr>
			<label class="input-label" for="email"><img
				src="img/ic_email_24px.svg" width="23px" height="23px"></label> <input
				type="text" id="email" name="email" placeholder="E-Mail" required> <label
				class="input-label" for="password"><img
				src="img/ic_lock_open_24px.svg" width="23px" height="23px"></label>
			<input type="password" id="password" name="password"
				placeholder="Şifre" required>
			<!--<input type="checkbox" name="cookie" id="cookie"><label for="cookie">Oturum Açık Kalsın</label>-->
			<input type="checkbox" name="hatirla" id="hatirla"
				class="css-checkbox" /><label for="hatirla" class="css-label">Beni
				Hatırla</label>
			<button type="submit" name="giris" value="giris" class="btn">Oturum
				Aç</button>
				<a class="btn" style="float:left;clear:left;" href="sifirla.php">Şifremi
			Unuttum</a>
			<div id="giris" class="giris <?php echo $giris_class; ?>"><?php echo $giris_yazi; ?></div>
		</fieldset>
	</form>
</body>
</html>