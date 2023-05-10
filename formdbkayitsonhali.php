<?php

$sifre = $_POST['sifre'];
$sifretekrar = $_POST['sifretekrar'];
$username = $_POST['kullaniciadi'];
$usernameLength = mb_strlen($_POST['kullaniciadi']);
$maxLength =8; 
$minLength =6;
$eposta = $_POST['eposta'];

if($usernameLength > $maxLength || $usernameLength < $minLength){ ?>
	<script type='text/javascript'> window.alert('Kullanıcı Adı 8 karakterden fazla 6 karakterden az olamaz!'); </script>	
   <?php  
     $geldigi_sayfa = $_SERVER['HTTP_REFERER'];      
     header("Refresh:2; url=".$geldigi_sayfa.""); 
	 die; } 

elseif(is_numeric($username)){?>
<script type='text/javascript'> window.alert('Kullanıcı Adı numerik değerlerden oluşamaz!'); </script>	
  <?php   
     $geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
    header("Refresh:2; url=".$geldigi_sayfa.""); 
	 die;
 } 
 
 elseif($sifre!=$sifretekrar){?>
  <script type='text/javascript'> window.alert('Şifre ile Şifre Tekrar alanlarına girilen değerler eşleşmedi!'); </script>	
  <?php 
  $geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
  header("Refresh:2; url=".$geldigi_sayfa.""); 
  die;
 } 
 
 elseif(is_numeric($eposta)){?>
	  <script type='text/javascript'> window.alert('E-Posta alanına girilen değer numerik olamaz!'); </script>	
  <?php 
  $geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
  header("Refresh:2; url=".$geldigi_sayfa.""); 
  die;
 } 

else{


$servername = "localhost";
$database = "";
$username = "root";
$password = "stajyerbidb";
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
<?php } mysqli_query($conn, "ALTER DATABASE formveritabani DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"); ?>

<?php
mysqli_select_db($conn, "formveritabani") or die ("Veritabanı Seçiminde Hata Oluştu");

//mysqli_query($conn, "drop table if exists kayitlar")  or die ("Veritabanı Tablo Oluşumunda Hata Oluştu");

//mysqli_query($conn,$tabloyarat)  //or die ("Veritabanı Tablo Oluşumunda Hata Oluştu");
$tabloyarat = "CREATE TABLE if not exists kayitlar(
    id INT(11) NOT NULL AUTO_INCREMENT,
    adi TEXT NOT NULL,
    soyadi TEXT NOT NULL,
    eposta VARCHAR(50) NOT NULL,
    mailsaglayici VARCHAR(50) NOT NULL,
    ulke VARCHAR(50) NOT NULL,
    kullaniciadi VARCHAR(15) NOT NULL,
    sifre VARCHAR(50) NOT NULL,
    sifretekrar VARCHAR(50) NOT NULL,
    soru VARCHAR(35) NOT NULL,
    scevabi VARCHAR(40) NOT NULL,
    cinsiyet VARCHAR(50) NOT NULL,
	dogumtarihi VARCHAR(50),
	kullanicimesaji TEXT NOT NULL,
	sozkabul VARCHAR(50),
	sozkabul2 VARCHAR(50),
	ikincieposta VARCHAR(50) NOT NULL,
	guvkod VARCHAR(50) NOT NULL,
    PRIMARY KEY(id))";
	
	// $sozkabul = (isset($_POST['sozkabul'])) ? 1 : 0;
	// $sozkabul2 = (isset($_POST['sozkabul2'])) ? 1 : 0;
	
	
	if (empty($_POST['adi']))
    $_POST['adi'] = 'girilmedi';

    if (empty($_POST['soyadi']))
    $_POST['soyadi'] = 'girilmedi';

    if (empty($_POST['eposta']))
    $_POST['eposta'] = 'girilmedi';

    if (empty($_POST['ikincieposta']))
    $_POST['ikincieposta'] = 'girilmedi';
    
	if (empty($_POST['guvkod']))
    $_POST['guvkod'] = 'girilmedi';
	
	if (empty($_POST['ulke']))
    $_POST['ulke'] = 'girilmedi';
	
	if (empty($_POST['dogumtarihi']))
    $_POST['dogumtarihi'] = 'girilmedi';

    if (empty($_POST['cinsiyet']))
    $_POST['cinsiyet'] = 'girilmedi';

    if (empty($_POST['kullaniciadi']))
    $_POST['kullaniciadi'] = 'girilmedi';

    if (empty($_POST['sifretekrar']))
    $_POST['sifretekrar'] = 'girilmedi';

    if (empty($_POST['soru']))
    $_POST['soru'] = 'girilmedi';
    
	if (empty($_POST['scevabi']))
    $_POST['scevabi'] = 'girilmedi';
			
	if (empty($_POST['sozkabul']))
	$_POST['sozkabul'] = 'kabul edilmedi';	
	
	if (empty($_POST['sozkabul2']))
    $_POST['sozkabul2'] = 'kabul edilmedi';

    // if (empty($_POST['kullanicimesaji']) || $_POST['kullanicimesaji']==null)
    // $_POST['kullanicimesaji'] = 'mesaj girilmedi';

mysqli_query($conn, $tabloyarat)  //or die ("Veritabanına Veri Kaydında Hata Oluştu");
?>
<?php 
mysqli_query($conn, "ALTER TABLE kayitlar CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
mysqli_query($conn, "SET CHARACTER SET 'utf8'");
mysqli_query($conn, "SET SESSION collation_connection ='utf8_unicode_ci'");
?>






<?php $veriekle = "INSERT INTO kayitlar (adi, soyadi, eposta, mailsaglayici, ulke, kullaniciadi, sifre, sifretekrar, soru, scevabi, cinsiyet, dogumtarihi, kullanicimesaji, sozkabul, sozkabul2, ikincieposta, guvkod) VALUES ('$_POST[adi]', '$_POST[soyadi]', '$_POST[eposta]', '$_POST[mailsaglayici]', '$_POST[ulke]', '$_POST[kullaniciadi]', '$_POST[sifre]', '$_POST[sifretekrar]', '$_POST[soru]', '$_POST[scevabi]', '$_POST[cinsiyet]', '$_POST[dogumtarihi]', '$_POST[kullanicimesaji]', '$_POST[sozkabul]', '$_POST[sozkabul2]', '$_POST[ikincieposta]', '$_POST[guvkod]')"; ?>
<?php if (mysqli_query($conn, $veriekle)) { ?>
       <script type='text/javascript'> window.alert('Veri Tabanına Veri Kaydı Başarı İle Gerçekleşti!'); </script>
<?php } else {  ?>
      <script type='text/javascript'> window.alert('Veri Tabanına Veri Kaydı Başarısız Oldu!'); </script> <?php echo "". $veriekle . "<br>" . mysqli_error($conn); ?>
<?php }?>

<?php
mysqli_close($conn);
$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
header("Refresh:2; url=".$geldigi_sayfa.""); 
}
?>



