<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm'] == 'frmAddUsers'){
			$fullname = $pia->control($_POST['fullname'],'text');
			$phone = $pia->control($_POST['phone'],'text');
			$email = $pia->control($_POST['email'],'text');
			$password = $pia->control($pia->nirvana($_POST['password']),'text');
			$uniqid = $pia->control(uniqid(),'text');
			$status = $pia->control($_POST['status'],'int');
			

			if($pia->insert("INSERT INTO users(fullname, phone, email, password, uniqid, status) VALUES($fullname, $phone, $email, $password, $uniqid, $status)")){ 
				
					
				$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!', 'users.php');

				
			}else{ 

				$pia->alertify('error', 'Bir hata oluştu!');
				
			}	


		
	} 
?>