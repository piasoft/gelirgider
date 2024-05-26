<?php 
	require('../_class/config.php'); require('../session.php');
	if(isset($_POST['table']) and isset($_POST['value'])){
		
		$delete_id = $pia->control($_POST['value'], 'int'); 
		
		$table = trim($pia->control($_POST['table'], 'text'),"'"); 


	
		$pia->exec("DELETE FROM $table WHERE id=$delete_id");
		
			$pia->alertify('success', 'Veri başarıyla silindi!');

	
		

	} 
?>