<?php require('_class/config.php');  require('session.php');   ?>
<!DOCTYPE html>
<html>
      <head>
            <?php require('_inc/head.php');   ?>
            <title>Cariler</title>
           
      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">
                
                  <div class="title">
                        <div class="left">
                              <h1>Cariler</h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="customers.php">Cariler</a></li>
                              </ul>
                        </div>
                        <div class="right"> <a href="customers.php?add" class="btn-success btn-sm">Yeni ekle</a> </div>
                  </div>


                  <?php if(isset($_GET['add'])){ ?>

                        <div class="modal active">
                                    <form class="panel-default modal-medium" method="post" action="_ajax/_ajaxAddCustomers.php"  autocomplete="off">
                                          <div class="panel-title"><i class="fal fa-plus-circle"></i> Yeni ekle</div> 
                                          <div class="panel-body">
                                                <div class="form-group">
                                                      <label>Ad Soyad / Firma Adı</label>
                                                      <input type="text" name="title" class="form-control" required  />
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Telefon</label>
                                                                  <input type="text" name="phone" class="form-control"  />
                                                            </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Email</label>
                                                                  <input type="email" name="email" class="form-control"  />
                                                            </div> 
                                                      </div>
                                                </div>
                                              
                                                <div class="form-group">
                                                      <label>Adres : </label>
                                                      <textarea name="address" class="form-control" ></textarea>
                                                </div>
                                                 <div class="row ">
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>TC / Vergi No</label>
                                                                  <input type="text" name="tax_no"  class="form-control"  />
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Vergi Dairesi</label>
                                                                  <input type="text" name="tax_office" class="form-control"  />
                                                            </div>
                                                      </div>
                                                </div>

                                                <div class="form-group m0">
                                                      <label>Durum</label>
                                                      <div>
                                                            <label class="radio"><input type="radio" name="status" value="1" checked /> Aktif</label>
                                                            <label class="radio"><input type="radio" name="status" value="0" /> Pasif</label>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="panel-footer">
                                            
                                                <button type="submit" class="btn-primary">Kaydet</button>
                                                <a href="customers.php" class="btn-danger">Vazgeç</a>
                                                      
                                          </div>
                                          <input type="hidden" name="frm" value="frmAddCustomers" />
                                    </form>
                        </div>
                      

                  <?php }elseif(isset($_GET['edit'])){ 
                              $edit_id = $pia->control($_GET['edit'],'int');
                              $edit_row = $pia->get_row("SELECT * FROM customers WHERE id=$edit_id");

                  ?>
                        <div class="modal active">

                                    <form class="panel-default modal-medium" action="_ajax/_ajaxEditCustomers.php" method="post" autocomplete="off">
                                          <div class="panel-title"><i class="fal fa-pen"></i> Düzenle</div> 
                                          <div class="panel-body">
                                              
                                                <div class="form-group">
                                                      <label>Ad Soyad / Firma Adı</label>
                                                      <input type="text" name="title" class="form-control" value="<?=$edit_row->title;?>" required  />
                                                </div>
                                                <div class="row">
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Telefon</label>
                                                                  <input type="text" name="phone" class="form-control" value="<?=$edit_row->phone;?>" />
                                                            </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Email</label>
                                                                  <input type="email" name="email" class="form-control" value="<?=$edit_row->email;?>" />
                                                            </div> 
                                                      </div>
                                                </div>
                                                

                                               
                                                <div class="form-group">
                                                      <label>Adres : </label>
                                                      <textarea name="address" class="form-control"><?=$edit_row->address;?></textarea>
                                                </div>
                                                <div class="row ">
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>TC / Vergi No</label>
                                                                  <input type="text" name="tax_no"  class="form-control" value="<?=$edit_row->tax_no;?>"  />
                                                            </div>
                                                      </div>
                                                      <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                  <label>Vergi Dairesi</label>
                                                                  <input type="text" name="tax_office" class="form-control" value="<?=$edit_row->tax_office;?>"  />
                                                            </div>
                                                      </div>
                                                </div>
                                                <div class="form-group m0">
                                                      <label>Durum</label>
                                                      <div>
                                                            <label class="radio"><input type="radio" name="status" value="1" <?=($edit_row->status==1)?'checked':'';?> /> Aktif</label>
                                                            <label class="radio"><input type="radio" name="status" value="0" <?=($edit_row->status==0)?'checked':'';?> /> Pasif</label>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="panel-footer">
                                             
                                                <button type="submit" class="btn-primary">Kaydet</button>
                                                <a href="customers.php" class="btn-danger">Vazgeç</a>
                                                     
                                          </div>            
                                          <input type="hidden" name="edit_id" value="<?=$edit_row->id;?>" />       
                                          <input type="hidden" name="frm" value="frmEditCustomers" />    
                                    </form>
                        </div>
               
                  <?php } ?>

                          
                        <table class="table">
                              <thead>
                                    <tr>
                                          <th width="50px">ID</th>
                                          <th>Ad soyad / Ünvan</th>
                                          <th>Telefon</th>
                                          <th>Adres</th>
                                          <th>Durum</th>
                                          <th>İncele</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php $list = $pia->query("SELECT * FROM customers WHERE status>=0"); foreach($list as $item){  ?>

                                          <tr>
                                                <td><?=$item->id;?></td>
                                                <td><a href="customer.php?id=<?=$item->id;?>"><?=$item->title;?></a></td>
                                                <td><?=$item->phone;?></td>
                                                <td><?=$item->address;?></td>
                                                <td><?=$item->status==1?'<label class="label-success">Aktif</label>':'<label class="label-danger">Pasif</label>';?></td>
                                                <td>
                                                      <a href="customers.php?edit=<?=$item->id;?>" class="btn-default btn-xs">Düzenle</a>
                                                      <a onclick="_delete('customers', <?=$item->id;?>);" class="btn-default btn-xs">Sil</a>
                                                </td>
                                          </tr>
                                         

                                    <?php } ?>
                              </tbody>
                        </table>
                       

                





           </section>
           <?php require('_inc/footer.php'); ?>

      
           
     </body>
</html>
