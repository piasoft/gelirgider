<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm'] == 'frmEditUsers'){
		
			$edit_id = $pia->control($_POST['edit_id'],'int');
			$edit_row = $pia->get_row("SELECT * FROM users WHERE id=$edit_id");

			$fullname = $pia->control($_POST['fullname'],'text');
			$phone = $pia->control($_POST['phone'],'text');
			$email = $pia->control($_POST['email'],'text');
			$password = (!empty($_POST['password'])) ? $pia->control($pia->nirvana($_POST['password']),'text') : $pia->control($edit_row->password,'text');
			$status = $pia->control($_POST['status'],'int');

			$pia->exec("UPDATE users SET fullname=$fullname, phone=$phone, email=$email, password=$password, status=$status WHERE id=$edit_row->id");
			

			$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!', 'users.php');

			
		
	} 
?>