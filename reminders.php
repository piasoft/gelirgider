<?php require('_class/config.php'); require('session.php');   ?>
<!DOCTYPE html>
<html>
      <head>
            <?php require('_inc/head.php'); ?>

            <title>Hatırlatmalar</title>

      </head>
      <body>
            <?php require('_inc/header.php'); ?>


            <section class="content">

                   <div class="title">
                        <div class="left">
                              <h1>Hatırlatmalar</h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="reminders.php">Hatırlatmalar</a></li>
                              </ul>
                        </div>
                        <div class="right">
                        </div>
                  </div>
       

     
              <?php if(isset($_GET['edit'])){ 

                        $edit_id = $pia->control($_GET['edit'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM reminders WHERE id=$edit_id");
                        $finances_row = $pia->get_row("SELECT * FROM finances WHERE id=$edit_row->finance_id");
                        $customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $finances_row->customer_id");
                        $categories_row = $pia->get_row("SELECT * FROM categories WHERE id = $finances_row->category_id");
                        $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $finances_row->method_id");


                  ?>

                       
                        
                        <div class="modal active">
                                    <form class="panel-default modal-medium" method="post" action="_ajax/_ajaxEditReminders.php" >
                                          <div class="panel-title"><i class="fal fa-pen"></i> Düzenle</div> 

                                          <a class="panel-close" href="reminders.php" ><i class="fal fa-times"></i></a>
                                          <div class="panel-body">
                                                      
                                                      <?php if(isset($customers_row->id)){ ?>

                                                      <div class="form-group">
                                                            <strong>Cari adı : </strong>
                                                            <?=$customers_row->title;?>
                                                      </div>

                                                      <?php } ?>

                                                      <?php if(isset($categories_row->id)){ ?>
                                                            <div class="form-group">
                                                                  <strong>Kategoriler : </strong>
                                                                  <?=$categories_row->title;?>
                                                            </div>
                                                      <?php } ?>
                                                      <div class="form-group">
                                                            <strong>Fiyat : </strong>
                                                           <?=$finances_row->event_type==0?'<span class="text-danger">-'.$finances_row->price.' TRY</span>': '<span class="text-success">+'.$finances_row->price.' TRY</span>';?>
                                                      </div>

                                                      <?php if(isset($methods_row->id)){ ?>
                                                            <div class="form-group">
                                                                  <strong>Ödeme Yöntemi : </strong>
                                                                  <?=$methods_row->title;?>
                                                            </div>
                                                      <?php } ?>
                                                      

                                                      <?php if(!empty($finances_row->description)){ ?>
                                                            <div class="form-group">
                                                                  <strong>Notlar : </strong>
                                                                   <?=$finances_row->description;?>
                                                            </div>
                                                      <?php } ?>
                                                      <div class="form-group">
                                                            <strong>Tarih : </strong>
                                                            <?=$pia->time_tr($finances_row->adddate,'day month year');?>
                                                      </div>
                                                      <div class="form-group" style="border-top:1px solid #EEE;padding-top:20px;">
                                                            <label>Hatırlatma notu</label>
                                                            <textarea name="description" class="form-control"><?=$edit_row->description;?></textarea>
                                                      </div>
                                                      <div class="form-group">
                                                            <label>Hatırlatma tarihi</label>
                                                            <input type="date" name="reminder_date" class="form-control" value="<?=date('Y-m-d', strtotime($edit_row->reminder_date));?>" required>
                                                      </div>
                                                      <div class="form-group">
                                                            <label>Durum</label>
                                                            <select name="status" class="form-control">
                                                                  <option value="0" <?=$edit_row->status==0?'selected':'';?>>Hatırlatma bekliyor</option>
                                                                  <option value="1" <?=$edit_row->status==1?'selected':'';?>>Hatırlatma yapıldı</option>
                                                            </select>
                                                      </div>

                                                      <button type="submit" class="btn-primary btn-block">Kaydet</button>
                                                
                                                 
                                                  
                                          </div>


                                          <input type="hidden" name="edit_id" value="<?=$edit_row->id;?>"/>
                                          <input type="hidden" name="frm" value="frmEditReminders"/>
                                           
                              </form>
                        </div>
                 
              <?php } ?>



                              <table class="table">
                                    <thead>
                                         <tr>
                                          <th width="50px">ID</th>
                                                <th>İşlem özeti</th>
                                                <th>Hatırlatma notu</th>
                                                <th>Hatırlatma tarihi</th>
                                                <th>Durum</th>
                                                <th width="150px">İşlemler</th>
                                          </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                                       
                                                $list = $pia->query("SELECT * FROM reminders");  
                                                foreach($list as $item){ 
                                                      $finances_row = $pia->get_row("SELECT * FROM finances WHERE id = $item->finance_id");
                                                      $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $finances_row->method_id");
                                                      $customers_row = $pia->get_row("SELECT * FROM customers WHERE id=$finances_row->customer_id");
                                                      $categories_row = $pia->get_row("SELECT * FROM categories WHERE id=$finances_row->category_id");
                                                     
                  
                                          ?>

                                                <tr>
                                                      <td><?=$item->id;?></td>
                                                      <td>  
                                                            <a href="<?=$finances_row->event_type==0?'expense':'income';?>.php?view_id=<?=$finances_row->id;?>" target="_blank">
                                                                  <?=$customers_row->title;?> - <?=$categories_row->title;?> - <?=$methods_row->title;?></br>
                                                                  <?=$finances_row->event_type==0?'<span class="text-danger">-'.$finances_row->price.' TRY</span>': '<span class="text-success">+'.$finances_row->price.' TRY</span>';?>
                                                            </a>
                                                      </td>
                                                      <td style="max-width: 500px;"><?=$item->description;?></td>
                                                      <td>
                                                            <?=$item->reminder_date;?>
                                                           
                                                                  
                                                            </td>
                                                      <td>
                                                             <?=$pia->timeago($item->reminder_date);?>
                                                            <?=$item->status==1?'<label class="label-success">Hatırlatma yapıldı</label>':'<label class="label-info">Hatırlatma bekliyor</label>';?>
                                                                  
                                                            </td>
                                                      <td width="150px">
                                                            <a href="reminders.php?edit=<?=$item->id;?>" class="btn-default btn-xs">Düzenle</a>
                                                            <a onclick="_delete('reminders', <?=$item->id;?>);" class="btn-default btn-xs">Sil</a>
                                                      </td>
                                                </tr>

                                          <?php } ?>

                                    </tbody>

                              </table>
                             

                
                       


           </section>


                  





           <?php require('_inc/footer.php'); ?>
            <script>
                  $('.selectpicker').selectpicker({
                        noneResultsText: '<a onclick="new_client(this);" >Yeni cari kartı oluştur</a>'
                  });  

                  function new_client(elm){
                        $('.old_client').addClass('hide');
                        $('.new_client').removeClass('hide');
                  }
            </script>

     </body>

</html>

