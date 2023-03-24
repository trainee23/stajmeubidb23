<?php

$servername = "localhost";
$database = "";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Veritabanı Bağlantısı Başarısız " . mysqli_connect_error());
	  ?>
<?php } ?>
 
 <script type='text/javascript'> window.alert('Veri Tabanına Bağlantı Başarılı!'); </script>
 
<?php $dbcreate = "create database if not exists formveritabani"; ?>
<?php if (mysqli_query($conn, $dbcreate)) { ?>
      <script type='text/javascript'> window.alert('Veri Tabanı Başarıyla Oluşturuldu!'); </script>
<?php } else { ?>
        <script type='text/javascript'> window.alert('Veri Tabanı Oluşumunda Hata Oluştu!'); </script> <?php echo "" . $dbcreate . "<br>" . mysqli_error($conn); ?>
<?php } ?>

<?php
mysqli_select_db($conn, "formveritabani") or die ("Veritabanı Seçiminde Hata Oluştu");

mysqli_query($conn, "drop table if exists kayitlar")  or die ("Veritabanı Tablo Oluşumunda Hata Oluştu");

$tabloyarat = "CREATE TABLE kayitlar(
    id INT(11) NOT NULL AUTO_INCREMENT,
    adi VARCHAR(50) NOT NULL,
    soyadi VARCHAR(50) NOT NULL,
    eposta VARCHAR(50) NOT NULL,
    mailsaglayici VARCHAR(50) NOT NULL,
    ulke VARCHAR(50) NOT NULL,
    kullaniciadi VARCHAR(15) NOT NULL,
    sifre VARCHAR(50) NOT NULL,
    sifretekrar VARCHAR(50) NOT NULL,
    soru VARCHAR(35) NOT NULL,
    scevabi VARCHAR(40) NOT NULL,
    cinsiyet VARCHAR(50) NOT NULL,
	dogumtarihigun VARCHAR(50) NOT NULL,
	dogumtarihiay VARCHAR(50) NOT NULL,
	dogumtarihiyil VARCHAR(50) NOT NULL,
	sozkabul VARCHAR(50),
	sozkabul2 VARCHAR(50),
	ikincieposta VARCHAR(50) NOT NULL,
	guvkod VARCHAR(50) NOT NULL,
    PRIMARY KEY(id))";

mysqli_query($conn, $tabloyarat)  or die ("Veritabanına Veri Kaydında Hata Oluştu");
?>

<?php $veriekle = "INSERT INTO kayitlar (adi, soyadi, eposta, mailsaglayici, ulke, kullaniciadi, sifre, sifretekrar, soru, scevabi, cinsiyet, dogumtarihigun, dogumtarihiay, dogumtarihiyil, sozkabul, sozkabul2, ikincieposta, guvkod) VALUES ('$_POST[adi]', '$_POST[soyadi]', '$_POST[eposta]', '$_POST[mailsaglayici]', '$_POST[ulke]', '$_POST[kullaniciadi]', '$_POST[sifre]', '$_POST[sifretekrar]', '$_POST[soru]', '$_POST[scevabi]', '$_POST[cinsiyet]', '$_POST[dogumtarihigun]', '$_POST[dogumtarihiay]', '$_POST[dogumtarihiyil]', '$_POST[sozkabul]', '$_POST[sozkabul2]', '$_POST[ikincieposta]', '$_POST[guvkod]')"; ?>
<?php if (mysqli_query($conn, $veriekle)) { ?>
       <script type='text/javascript'> window.alert('Veri Tabanına Veri Kaydı Başarı İle Gerçekleşti!'); </script>
<?php } else {  ?>
      <script type='text/javascript'> window.alert('Veri Tabanına Veri Kaydı Başarısız Oldu!'); </script> <?php echo "". $veriekle . "<br>" . mysqli_error($conn); ?>
<?php }?>

<?php
mysqli_close($conn);

?>



