<?php 
	require('../_class/config.php');
	if(isset($_POST['frm']) and $_POST['frm'] == 'frmLogin'){

		$u_ip = $pia->control($pia->get_ip(),'text');

		$email = $pia->control($_POST['email'],'text');

		$password = $pia->control($pia->nirvana($_POST['password']),'text');

		$row = $pia->get_row("SELECT * FROM users WHERE email=$email and password=$password");

		if(isset($row->id)){


			setcookie('admin_id', $row->uniqid, time() + (60*60*24*30) ,'/'); 


			$pia->alertify('success', 'Başarıyla giriş yapıldı!');

		

		}else{


			$pia->alertify('error', 'Kullanıcı adı veya şifre yanlış girildi!');


		
		}
		
	} 
?>