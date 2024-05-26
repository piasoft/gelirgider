<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('mail/Exception.php');
require('mail/PHPMailer.php');
require('mail/SMTP.php');

          


class PIA {
	static $pdo = null;
	static $charset = 'UTF8';
	static $last_stmt = null;
	public static function instance(){
		return 
		self::$pdo == null ?
		self::init() :
		self::$pdo;
	}
	public static function init(){
		self::$pdo = new PDO(
			'mysql:host=' . MYSQL_HOST .';dbname=' . MYSQL_DB,
			MYSQL_USER,
			MYSQL_PASS
		);
		self::$pdo->exec('SET NAMES `' . self::$charset . '`');
		self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return self::$pdo;
	}
	public static function query($query, $bindings = null){
		if(is_null($bindings)){
			if(!self::$last_stmt = self::instance()->query($query))
			return false;
		}else{
			self::$last_stmt = self::prepare($query);
			if(!self::$last_stmt->execute($bindings))
			return false;
		}
		return self::$last_stmt;
	}
	public static function get_var($query, $bindings = null){
		if(!$stmt = self::query($query, $bindings))
		return false;
		
		return $stmt->fetchColumn();
	}
	public static function get_row($query, $bindings = null){
		if(!$stmt = self::query($query, $bindings))
		return false;
		return $stmt->fetch();
	}
	public static function get($query, $bindings = null){
		if(!$stmt = self::query($query, $bindings))
			return false;

		$result = array();
		foreach($stmt as $row)
			$result[] = $row;

		return $result;
	}


	public static function exec($query, $bindings = null){
		if(!$stmt = self::query($query, $bindings))
		return false;
		return $stmt->rowCount();
	}

	public static function insert($query, $bindings = null){
		if(!$stmt = self::query($query, $bindings))
		return false;
		
		return self::$pdo->lastInsertId();
	}

	public static function getLastError(){
		$error_info = self::$last_stmt->errorInfo();

		if($error_info[0] == 00000)
			return false;

		return $error_info;
	}


	public static function __callStatic($name, $arguments){
		return call_user_func_array(
			array(self::instance(), $name),
			$arguments
		);
	}


	public static function get_months($value){
		$array = array('01' => 'Ocak', '02' => 'Şubat', '03' => 'Mart', '04' => 'Nisan', '05' => 'Mayıs', '06' => 'Haziran', '07' => 'Temmuz', '08' => 'Ağustos', '09' => 'Eylül', '10' => 'Ekim', '11' => 'Kasım', '12' => 'Aralık');
		return $array[$value];
	}


	public static function nirvana($str){ return md5(md5(md5(trim($str)))); }

	public static function control($theValue, $theType, $strip_tags=false) {
		$theValue = addslashes(trim($theValue)) ;
		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
				$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
			break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
		}
		return $theValue;
		
	}
	public static function seo($title){
		$TR=array('ç','Ç','ı','İ','ş','Ş','ğ','Ğ','ö','Ö','ü','Ü');
		$EN=array('c','c','i','i','s','s','g','g','o','o','u','u');
		$title= str_replace($TR,$EN,$title);
		$title=mb_strtolower($title,'UTF-8');
		$title=preg_replace('#[^-a-zA-Z0-9_, ]#','',$title);
		$title=trim($title);
		$title= preg_replace('#[-_ ]+#','-',$title);
		return $title;
	}

	public static  function get_ip(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		  	return $_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		  	return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{  
			return $_SERVER['REMOTE_ADDR']; 
		}
	}

	public static function base_url($url=null){
	   

	    return ($url==null)? BASE_URL : BASE_URL.$url ;
	}

	
	
	public static function alertify($status, $description, $url=''){
		$alertify['status'] = $status;
		$alertify['description'] = $description;
		if(!empty($url)){ $alertify['url'] = $url; }

		echo json_encode($alertify);
	}




	public static function action($id,  $url){
		
		return '<a href="'.$url.'.php?edit='.$id.'" class="btn-default btn-xs">Düzenle</a><a onclick="_delete(\''.$url.'\', '.$id.');" class="btn-default btn-xs">Sil</a>';
		
	}



	public static function get_today($u_id){

      	
      	
		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=1 and DATE(adddate) = CURDATE()");

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE  event_type=0 and DATE(adddate) = CURDATE() "); 
		$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}
		

      }
      public static function get_yesterday($u_id){

  

		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=1 and DATE(adddate) = DATE(NOW() - INTERVAL 1 DAY) ");

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=0 and DATE(adddate) = DATE(NOW() - INTERVAL 1 DAY)"); 

		$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}

      }

      public static function get_week($u_id){


		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=1 and YEARWEEK(adddate)=YEARWEEK(NOW())"); 

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=0 and YEARWEEK(adddate)=YEARWEEK(NOW())"); 

		$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}

      }
      public static function get_month($u_id){



		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE  event_type=1 and MONTH(adddate) = MONTH(CURRENT_DATE())"); 

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=0 and MONTH(adddate) = MONTH(CURRENT_DATE())"); 

		$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}

      } 
      public static function get_last15day($u_id){


		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=1 and adddate >= ( CURDATE() - INTERVAL 15 DAY )"); 

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=0 and adddate >= ( CURDATE() - INTERVAL 15 DAY )"); 

		$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}

      }

      public static function get_last30day($u_id){


		$income_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=1 and adddate >= ( CURDATE() - INTERVAL 30 DAY )"); 

		$expense_row = self::get_row("SELECT SUM(price) as price FROM finances WHERE event_type=0 and adddate >= ( CURDATE() - INTERVAL 30 DAY )"); 

         $price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}

      }

      public static function get_last12month($u_id){


		$income_row = self::get_row("SELECT SUM(f.price) as price FROM finances WHERE event_type=1 and adddate >= ( CURDATE() - INTERVAL 365 DAY )"); 

		$expense_row = self::get_row("SELECT SUM(f.price) as price FROM finances WHERE event_type=0 and adddate >= ( CURDATE() - INTERVAL 365 DAY )"); 

     	$price = self::price_format($income_row->price-$expense_row->price);
     	if($price>0){
     		return '<span class="text-success">+ '.$price.' TRY</span>';
     	}elseif($price<0){
     		return '<span class="text-danger">'.$price.' TRY</span>';
     	}else{
     		return $price.' TRY';	
     	}
		
      }

     
      public static function price_format($price){

      	return number_format($price, 2, ',','');

      }



	public static function time_tr($adddate, $pattern='time, day month year'){

		$months = array('Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık');
		

		$time =  date('H:i',  strtotime($adddate));

		$day = date('j ', strtotime($adddate)); 

		$month = $months[date('m',  strtotime($adddate)) - 1];


		
		$year = date('Y',  strtotime($adddate));

		



		return str_replace(array('time', 'day', 'month', 'year'), array($time, $day, $month, $year), $pattern);



	}

public static function timeago($date) {
    $today = new DateTime('today');
    
    $target = new DateTime($date);
    $diff = $today->diff($target);
    
    $diff = $diff->invert ? -$diff->days : $diff->days;
    
    if($diff>0){ return '<label class="label-warning">'.$diff.' gün kaldı</label>'; }
    if($diff<0){ return '<label class="label-danger">'.$diff.' gün geçti</label>'; }
    if($diff==0){ return '<label class="label-primary">Bugün</label>'; }
    
}



	
	public static  function mail($email, $subject, $html){

	  
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->SMTPDebug = 2;
		$mail->XMailer = 'Gelir Gider Takip Programı';
		$mail->Host = SMTP_HOST;
		$mail->SMTPAuth = SMTP_AUTH;
		$mail->Username = SMTP_USERNAME;
		$mail->Password = SMTP_PASSWORD;
		$mail->SMTPSecure = SMTP_SECURE; 
		$mail->Port = SMTP_PORT; 
		$mail->SetFrom(SMTP_USERNAME, 'Gelir Gider Takip Programı');
		$mail->AddAddress($email);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = $subject;
		$mail->isHTML(true);    
		$mail->Body = $html;
		return $mail->send() ? true : false ;
	}
	

	

	public static function mail_reminder($reminder_id){


		$html = file_get_contents('mail/reminder.html', FILE_USE_INCLUDE_PATH);


            $reminders_row = self::get_row("SELECT * FROM reminders WHERE id=$reminder_id");
            $finances_row = self::get_row("SELECT * FROM finances WHERE id=$reminders_row->finance_id");
            $customers_row = self::get_row("SELECT * FROM customers WHERE id = $finances_row->customer_id");
            $categories_row = self::get_row("SELECT * FROM categories WHERE id = $finances_row->category_id");
            $methods_row = self::get_row("SELECT * FROM methods WHERE id = $finances_row->method_id");


           	$price = $finances_row->event_type==0?'<span class="text-danger">-'.$finances_row->price.' TRY</span>': '<span class="text-success">+'.$finances_row->price.' TRY</span>';

           	$body = null;

           	if(isset($customers_row->id)){ $body .= '<div><strong>Cari adı : </strong>'.$customers_row->title.'</div>'; 	}

       		if(isset($categories_row->id)){ $body .= '<div><strong>Kategoriler : </strong>'.$categories_row->title.'</div>'; 	}

            $body .= '<div><strong>Fiyat : </strong>'.$price.'</div>';

        	if(isset($methods_row->id)){ $body .= '<div><strong>Ödeme Yöntemi : </strong>'.$methods_row->title.'</div>'; }

			if(!empty($finances_row->description)){	$body .= '<div><strong>Notlar : </strong>'.$finances_row->description.'</div>'; }
            
            $body .= '<div><strong>Tarih : </strong> '.self::time_tr($finances_row->adddate).'</div>';



            $reminders_note = !empty($reminders_row->description)? $reminders_row->description : 'Yok';	 

            $html = str_replace('{REMINDER_NOTE}', $reminders_note, $html);
            $html = str_replace('{BODY}', $body, $html);

            $list = self::query("SELECT * FROM users WHERE status=1");
            foreach($list as $item){

    	       	$html = str_replace('{FULLNAME}', $item->fullname, $html);
        		self::mail($item->email, 'Hatırlatma!', $html);


            }
			
	}


	






} 

$pia = New PIA;


?>