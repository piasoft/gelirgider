<?php 

error_reporting(E_ALL);

ini_set('display_errors', E_ALL);

header('Content-Type: text/html; Charset=UTF-8');

setlocale(LC_TIME, 'tr_TR');

date_default_timezone_set('Europe/Istanbul');

define('SMTP_HOST',	'mail.siteadresi.com'); // email sunucu adresinizi yazınız.

define('SMTP_AUTH',	true); // true veya false olmalıdır.

define('SMTP_USERNAME',	'ornek@email.com'); // email adresinizi yazınız.

define('SMTP_PASSWORD',	'1234567890**'); // email şifrenizi giriniz.

define('SMTP_SECURE',	'BURAYA_YAZINIZ'); // SSL veya TLS

define('SMTP_PORT',	'BURAYA_YAZINIZ'); // 465 veya 587


define('BASE_URL',	'https://www.siteadresiniz.com/');

define('MYSQL_HOST',	'localhost');

define('MYSQL_DB',	'veritabani_adi');

define('MYSQL_USER',	'veritabani_kullanici');

define('MYSQL_PASS',	'veritabani_sifre');


require('class.php');



if(isset($_COOKIE['admin_id'])){ 

	$uniqid =  $pia->control($_COOKIE['admin_id'],'text');

	$admin = $pia->get_row("SELECT * FROM users WHERE uniqid=$uniqid");


}

?>