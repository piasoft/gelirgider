<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm']=='frmEditCustomers'){


			$edit_id = $pia->control($_POST['edit_id'], 'int'); 
			
			$title = $pia->control($_POST['title'], 'text');
			$phone = $pia->control($_POST['phone'], 'text');
			$email = $pia->control($_POST['email'], 'text');
			$tax_office = $pia->control($_POST['tax_office'], 'text');
			$tax_no = $pia->control($_POST['tax_no'], 'text');
			$address = $pia->control($_POST['address'], 'text');
			$status = $pia->control($_POST['status'], 'int');
			
			
			$pia->exec("UPDATE customers SET title=$title, phone=$phone, email=$email, tax_office=$tax_office, tax_no=$tax_no, address=$address, status=$status WHERE id=$edit_id");
			
			$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!');

			
		

	
	} 
?>