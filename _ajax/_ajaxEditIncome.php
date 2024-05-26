<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm']=='frmEditIncome'){
		
	
			$edit_id = $pia->control($_POST['edit_id'], 'int');
			
			$category_id = $pia->control($_POST['category_id'], 'int');
			$customer_id = $pia->control($_POST['customer_id'], 'int');
			$method_id = $pia->control($_POST['method_id'], 'int');
			$price = $pia->control($_POST['price'], 'text');
			$description = $pia->control($_POST['description'], 'text');
			$adddate = $pia->control($_POST['adddate'], 'text');
			

			$pia->exec("UPDATE finances SET category_id=$category_id, customer_id=$customer_id, price=$price, method_id=$method_id, description=$description, adddate=$adddate WHERE id=$edit_id");
		

			$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!');


		
		
	} 
?>