<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['frm']) and $_POST['frm']=='frmEditCategories' ){



			$id = $pia->control($_POST['edit_id'], 'int'); 
			
			$title = $pia->control($_POST['title'],'text');
			

			$pia->exec("UPDATE categories SET title=$title WHERE id=$id");


			$pia->alertify('success', 'İşlem başarıyla gerçekleştirildi!','categories.php');

		
		
	
	} 
?>