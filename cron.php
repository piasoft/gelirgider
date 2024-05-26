<?php 

      require('_class/config.php'); 


      $list = $pia->query("SELECT * FROM reminders WHERE reminder_date=CURDATE() and status=0");

      foreach($list as $item){
                $pia->mail_reminder($item->id);
                $pia->exec("UPDATE reminders SET status=1 WHERE id =$item->id");
      }
  



 ?>
