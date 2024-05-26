<?php require('_class/config.php'); require('session.php');   ?>
<!DOCTYPE html>
<html>
      <head>
            <?php require('_inc/head.php'); ?>
            <title>Giderler</title>
            

      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">
                  


                   <div class="title">
                        <div class="left">
                              <h1>Giderler</h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="expense.php">Giderler</a></li>
                              </ul>
                        </div>
                        <div class="right">
                              <a href="expense.php?add" class="btn-success btn-sm">Yeni ekle</a>
                        </div>
                  </div>


                  <?php if(isset($_GET['add'])){ ?>
                     
                        <div class="modal active">
                                    <form method="post" action="_ajax/_ajaxAddExpense.php" class="panel-default modal-medium">
                                          <div class="panel-title"><i class="fal fa-plus-circle"></i> DÜzenle</div> 
                                          <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label>Cariler</label>
                                                            <select name="customer_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-title="Lütfen seçiniz" >
                                                                  <?php $list = $pia->query("SELECT * FROM customers ORDER BY title ASC"); foreach($list as $item){  ?>
                                                                  <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                                  <?php } ?>
                                                            </select>
                                                      </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Kategoriler </label>
                                                              <select name="category_id" class="form-control">
                                                                    <?php $list = $pia->query("SELECT * FROM categories ORDER BY title ASC"); foreach($list as $item){  ?>
                                                                    <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                                    <?php } ?>
                                                              </select>
                                                        </div>
                                                      </div>
                                                </div>
                                               
                                                
                                                <div class="row">
                                                      <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label>Tutar</label>
                                                                  <input type="text" name="price" class="form-control" />
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label>Ödeme Yöntemi</label>
                                                                  <select name="method_id" class="form-control">
                                                                        <?php $list = $pia->query("SELECT * FROM methods ORDER BY title DESC"); foreach($list as $item){  ?>
                                                                        <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                                        <?php } ?>
                                                                  </select>
                                                            </div>
                                                      </div>
                                                     </div>
                                                      
                                               
                                                <div class="form-group">
                                                      <label>Notlar</label>
                                                      <textarea name="description" class="form-control"></textarea>
                                                </div>
                                                 <div class="form-group">
                                                      <label>Tarih&Saat</label>
                                                      <input type="datetime-local" name="adddate" class="form-control" value="<?=date('Y-m-d H:i:s');?>" />
                                                </div>
                                         
                                                <button type="submit" class="btn-primary">Kaydet</button>
                                                <a href="expense.php" class="btn-danger">Vazgeç</a>
                                        
                                          </div>
                                          <input type="hidden" name="frm" value="frmAddExpense" />
                                    </form>
                        </div>


                        

                  <?php }elseif(isset($_GET['edit'])){ 

                        $edit_id = $pia->control($_GET['edit'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM finances WHERE id=$edit_id");
                  ?>

                        
                        <div class="modal active">
                                    <form method="post" action="_ajax/_ajaxEditExpense.php" class="panel-default modal-medium">
                                           <div class="panel-title"><i class="fal fa-pen"></i> Yeni ekle</div> 
                                          <div class="panel-body">
                                                <div class="form-group">
                                                      <label>Cariler</label>
                                                      <select name="customer_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-title="Lütfen seçiniz" >
                                                            <?php $list = $pia->query("SELECT * FROM customers ORDER BY title ASC"); foreach($list as $item){  ?>
                                                            <option value="<?=$item->id;?>" <?=$edit_row->customer_id==$item->id?'selected':'';?>><?=$item->title;?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                      <label>Kategoriler</label>
                                                      <select name="category_id" class="form-control">
                                                            <?php $list = $pia->query("SELECT * FROM categories ORDER BY title ASC"); foreach($list as $item){  ?>
                                                            <option value="<?=$item->id;?>" <?=$edit_row->category_id==$item->id?'selected':'';?>><?=$item->title;?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-6">
                                                            <div class="form-group">
                                                                  <label>Tutar</label>
                                                                  <input type="text" name="price" class="form-control" value="<?=$edit_row->price;?>" />
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6">

                                                            <div class="form-group">
                                                                  <label>Ödeme Yöntemi</label>
                                                                  <select name="method_id" class="form-control">
                                                                        <?php $list = $pia->query("SELECT * FROM methods ORDER BY title DESC"); foreach($list as $item){  ?>
                                                                        <option value="<?=$item->id;?>" <?=$edit_row->method_id==$item->id?'selected':'';?>><?=$item->title;?></option>
                                                                        <?php } ?>
                                                                  </select>
                                                            </div>
                                                      </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                      <label>Notlar</label>
                                                      <textarea name="description" class="form-control"><?=$edit_row->description;?></textarea>
                                                </div>
                                              

                                             
                                                     
                                               
                                                <button type="submit" class="btn-primary">Kaydet</button>
                                                <a href="expense.php" class="btn-danger">Vazgeç</a>
                                                   
                                          </div>
                                          <input type="hidden" name="edit_id" value="<?=$edit_row->id;?>" />
                                          <input type="hidden" name="frm" value="frmEditExpense" />
                                    </form>
                        </div>
                 
              <?php }elseif(isset($_GET['view_id'])){ 

                        $edit_id = $pia->control($_GET['view_id'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM finances WHERE id=$edit_id");
                        $customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $edit_row->customer_id");
                        $categories_row = $pia->get_row("SELECT * FROM categories WHERE id = $edit_row->category_id");
                        $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $edit_row->method_id");


                  ?>

                       
                        
                        <div class="modal active">
                                    <div class="panel-default modal-medium">
                                          <div class="panel-title">#<?=$edit_row->id;?> numaralı işlem özeti</div>

                                          <a class="panel-close" href="expense.php" ><i class="fal fa-times"></i></a>
                                          <div class="panel-body">
                                                    
                                                      <div class="form-group">
                                                            <strong>Cari adı : </strong>
                                                            <?=$customers_row->title;?>
                                                      </div>
                                                      <div class="form-group">
                                                            <strong>Kategoriler : </strong>
                                                            <?=$categories_row->title;?>
                                                      </div>
                                                      <div class="form-group">
                                                            <strong>Tutar : </strong>
                                                           <span class="text-danger">-<?=$edit_row->price;?> TRY</span>
                                                      </div>

                                                      <div class="form-group">
                                                            <strong>Ödeme Yöntemi : </strong>
                                                            <?=$methods_row->title;?>
                                                      </div>
                                                      <?php if(!empty($edit_row->description)){ ?>
                                                      <div class="form-group">
                                                     
                                                            <strong>Notlar : </strong>
                                                             <?=$edit_row->description;?>
                                                      </div>
                                                <?php } ?>
                                                      <div class="form-group m0">
                                                            <strong>Tarih : </strong>
                                                            <?=$pia->time_tr($edit_row->adddate);?>
                                                      </div>
                                                           
                                                 
                                                  
                                          </div>
                                           
                              </div>
                        </div>
                 
              <?php }elseif(isset($_GET['add_reminder'])){ 

                        $edit_id = $pia->control($_GET['add_reminder'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM finances WHERE id=$edit_id");
                        $customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $edit_row->customer_id");
                        $categories_row = $pia->get_row("SELECT * FROM categories WHERE id = $edit_row->category_id");
                        $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $edit_row->method_id");


                  ?>

                       
                        
                        <div class="modal active">
                                    <form class="panel-default modal-medium" method="post" action="_ajax/_ajaxAddReminders.php" >
                                          <div class="panel-title">#<?=$edit_row->id;?> numaralı işleme hatırlatma ekle</div>

                                          <a class="panel-close" href="expense.php" ><i class="fal fa-times"></i></a>
                                          <div class="panel-body">
                                                    
                                                      <div class="form-group">
                                                            <strong>Cari adı : </strong>
                                                            <?=$customers_row->title;?>
                                                      </div>
                                                      <div class="form-group">
                                                            <strong>Kategoriler : </strong>
                                                            <?=$categories_row->title;?>
                                                      </div>
                                                      <div class="form-group">
                                                            <strong>Tutar : </strong>
                                                           <span class="text-danger">-<?=$edit_row->price;?> TRY</span>
                                                      </div>

                                                      <div class="form-group">
                                                            <strong>Ödeme Yöntemi : </strong>
                                                            <?=$methods_row->title;?>
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                     
                                                            <strong>Notlar : </strong>
                                                             <?=$edit_row->description;?>
                                                      </div>
                                                      <div class="form-group">
                                                            <strong>Tarih : </strong>
                                                            <?=$pia->time_tr($edit_row->adddate);?>
                                                      </div>
                                                      <div class="form-group" style="border-top:1px solid #EEE;padding-top:20px;">
                                                            <label>Hatırlatma notu</label>
                                                            <textarea name="description" class="form-control"></textarea>
                                                      </div>
                                                      <div class="form-group">
                                                            <label>Hatırlatma tarihi</label>
                                                            <input type="date" name="reminder_date" class="form-control" value="<?=date('Y-m-d', strtotime('-1 day'));?>" required>
                                                      </div>
                                                      <button type="submit" class="btn-primary btn-block">Gönder</button>
                                                
                                                 
                                                  
                                          </div>


                                          <input type="hidden" name="finance_id" value="<?=$edit_row->id;?>"/>
                                          <input type="hidden" name="frm" value="frmAddReminders"/>
                                           
                              </form>
                        </div>
                 
              <?php } ?>



                       <table class="table">
                                    <thead>
                                          <tr>
                                          <th width="50px">ID</th>
                                                <th>Cari adı</th>
                                                <th>Kategoriler</th>
                                                <th>Tutar</th>
                                                <th>Ödeme Y.</th>
                                                <th width="150px">Tarih</th>
                                                <th width="150px">İşlemler</th>
                                          </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                                                $list = $pia->query("SELECT * FROM finances WHERE event_type=0");  
                                                foreach($list as $item){ 
                                                      $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $item->method_id");
                                                      $customers_row = $pia->get_row("SELECT * FROM customers WHERE id=$item->customer_id");
                                                      $categories_row = $pia->get_row("SELECT * FROM categories WHERE id=$item->category_id");
                  
                                          ?>

                                                <tr>
                                                      <td><?=$item->id;?></td>
                                                      <td><?=@$customers_row->title;?></td>
                                                      <td><?=@$categories_row->title;?></td>
                                                      <td class="text-danger">-<?=$item->price.' TRY';?></td>
                                                      <td><?=@$methods_row->title;?></td>
                                                     <td width="200px"><?=$item->adddate;?></td>
                                                      <td width="250px">

                                                            <a href="expense.php?add_reminder=<?=$item->id;?>" class="btn-warning btn-xs">Hatırlatma ekle</a>
                                                              <a href="expense.php?view_id=<?=$item->id;?>" class="btn-default btn-xs">İncele</a>

                                                            <a href="expense.php?edit=<?=$item->id;?>" class="btn-default btn-xs">Düzenle</a>
                                                            <a onclick="_delete('finances', <?=$item->id;?>);" class="btn-default btn-xs">Sil</a>
                                                      </td>
                                                </tr>

                                          <?php } ?>

                                    </tbody>

                              </table>

                  </section>




           <?php require('_inc/footer.php'); ?>

     </body>

</html>

