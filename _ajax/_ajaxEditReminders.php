<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm']=='frmEditReminders'){
		
	
			$edit_id = $pia->control($_POST['edit_id'], 'int');
			
			$description = $pia->control($_POST['description'], 'text');
			$reminder_date = $pia->control($_POST['reminder_date'], 'text');
			$status = $pia->control($_POST['status'], 'int');
			

			$pia->exec("UPDATE reminders SET description=$description, reminder_date=$reminder_date, status=$status WHERE id=$edit_id");
		

			$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!');


		
		
	} 
?>