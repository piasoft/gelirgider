<?php 
	require('../_class/config.php'); require('../session.php');

	if(isset($_POST['frm']) and $_POST['frm']=='frmAddIncome'){
		

		
			$category_id = $pia->control($_POST['category_id'], 'int');


			$customer_id = $pia->control($_POST['customer_id'], 'int');

			$method_id = $pia->control($_POST['method_id'], 'int');
			$price = $pia->control($_POST['price'], 'text');
			$event_type = $pia->control(1, 'int');
			$description = $pia->control($_POST['description'], 'text');
			$adddate = $pia->control($_POST['adddate'], 'text');

			if($pia->insert("INSERT INTO finances(u_id, category_id, customer_id, method_id,  price, event_type, description, adddate) VALUES($admin->id, $category_id, $customer_id, $method_id, $price, $event_type, $description, $adddate)")){
				

			
				$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!', 'income.php');

			}else{

				$pia->alertify('error', 'Bir hata oluştu!');

			}

		


		
	} 
?>