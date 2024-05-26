<?php 
	require('../_class/config.php'); require('../session.php');

	if(isset($_POST['frm']) and $_POST['frm']=='frmAddReminders'){
		

		
			$finance_id = $pia->control($_POST['finance_id'], 'int');

			$description = $pia->control($_POST['description'], 'text');
			$reminder_date = $pia->control($_POST['reminder_date'], 'text');

			if($pia->insert("INSERT INTO reminders(finance_id, description, reminder_date) VALUES($finance_id, $description, $reminder_date)")){
				

				$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!');

			}else{

				$pia->alertify('error', 'Bir hata oluştu!');

			}

		


		
	} 
?>