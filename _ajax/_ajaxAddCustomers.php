<?php 
	require('../_class/config.php'); require('../session.php');

	if(isset($_POST['frm']) and $_POST['frm']=='frmAddCustomers'){
		

			$title = $pia->control($_POST['title'], 'text');
			$phone = $pia->control($_POST['phone'], 'text');
			$email = $pia->control($_POST['email'], 'text');
			$tax_office = $pia->control($_POST['tax_office'], 'text');
			$tax_no = $pia->control($_POST['tax_no'], 'text');
			$address = $pia->control($_POST['address'], 'text');
			$status = $pia->control($_POST['status'], 'int');
			

			if($pia->insert("INSERT INTO customers(title, phone, email, tax_no, tax_office, address, status) VALUES($title, $phone, $email, $tax_office, $tax_no, $address, $status)")){

				$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!');

			}else{

				$pia->alertify('error', 'Bir hata oluştu!');

			}

		
		
	} 
?>