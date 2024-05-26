<?php 
	require('../_class/config.php'); require('../session.php');

	if(isset($_POST['frm']) and $_POST['frm']=='frmAddCategories'){
		

			$title = $pia->control($_POST['title'], 'text');
		
		
			if($pia->insert("INSERT INTO categories(title) VALUES($title)")){
			
				$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!','categories.php');

			}else{

				$pia->alertify('error', 'Bir hata oluştu!');

			}

	

	} 
?>