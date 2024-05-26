<?php require('_class/config.php'); require('session.php'); ?>
<!DOCTYPE html>
<html>
      <head>
            <?php require('_inc/head.php');   ?>
            <title>Kullanıcılar</title>
      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">

                  <div class="title">
                        <div class="left">
                              <h1>Kullanıcılar</h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="users.php">Kullanıcılar</a></li>
                              </ul>
                        </div>
                        <div class="right ">
                                    <a href="users.php?add" class="btn-success btn-sm">Yeni ekle</a>
                            
                        </div>
                  </div>
    
                  <?php if(isset($_GET['add'])){ ?>

                        <div class="modal active">
                              <form class="panel-default modal-medium" method="post" action="_ajax/_ajaxAddUsers.php" autocomplete="off">
                                    <div class="panel-title"><i class="fal fa-plus-circle"></i> Yeni ekle</div>
                                    <div class="panel-body">
                                          
                                          <div class="row">
                                                <div class="col-md-6 col-xs-12">

                                                      <div class="form-group">
                                                            <label>Ad Soyad </label>
                                                            <input type="text" name="fullname" class="form-control" required />
                                                      </div>
                                                </div>
                                                 <div class="col-md-6 col-xs-12">
                                                      <div class="form-group">
                                                            <label>Telefon </label>
                                                            <input type="tel" name="phone" class="form-control" required />
                                                      </div>
                                                </div>
                                          </div>

                                          <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                      <div class="form-group">
                                                            <label>Email </label>
                                                            <input type="email" name="email" class="form-control"  required/>
                                                      </div> 
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                      <div class="form-group">
                                                            <label>Şifre </label>
                                                            <input type="password" name="password" class="form-control" required />
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group m0">
                                                <label>Durum</label>
                                                <div>
                                                            <label class="radio" ><input type="radio" name="status" value="1" required /> Aktif</label>
                                                            <label class="radio" ><input type="radio" name="status" value="0" required /> Pasif</label>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="panel-footer">
                                          <button type="submit" class="btn-primary">Kaydet</button>
                                          <a href="users.php" class="btn-danger">Vazgeç</a>
                                    </div>
                                    <input type="hidden" name="frm" value="frmAddUsers" />
                              </form>
                        </div>
                  <?php }elseif(isset($_GET['edit'])){ 
                        $edit_id = $pia->control($_GET['edit'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM users WHERE id=$edit_id");
                  ?>
                        <div class="modal active">
                              <form class="panel-default modal-medium" action="_ajax/_ajaxEditUsers.php" method="post"  autocomplete="off">
                                    <div class="panel-title"><i class="fal fa-pen"></i> Düzenle</div> 
                                    <div class="panel-body">

                                          <div class="row">
                                                <div class="col-md-6 col-xs-12">

                                                      <div class="form-group">
                                                            <label>Ad soyad </label>
                                                            <input type="text" name="fullname" class="form-control" value="<?=$edit_row->fullname;?>" />
                                                      </div>

                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                      <div class="form-group">
                                                            <label>Telefon </label>
                                                            <input type="tel" name="phone" class="form-control" value="<?=$edit_row->phone;?>" />
                                                      </div>
                                                </div>
                                          </div>

                                          <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                      <div class="form-group">
                                                            <label>Email </label>
                                                            <input type="email" name="email" class="form-control" value="<?=$edit_row->email;?>"  />
                                                      </div>

                                                </div>
                                                <div class="col-md-6 col-xs-12">

                                                      <div class="form-group">
                                                            <label>Şifre </label>
                                                            <input type="password" name="password" class="form-control"  />
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group m0">
                                                <label>Durum</label>
                                                <div >
                                                            <label class="radio" ><input type="radio" name="status" <?=($edit_row->status==1)?'checked':'';?> value="1" required /> Aktif</label>

                                                            <label class="radio"  ><input type="radio" name="status" <?=($edit_row->status==0)?'checked':'';?> value="0" required /> Pasif</label>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="panel-footer">
                                          <button type="submit" class="btn-primary">Kaydet</button>
                                          <a href="users.php" class="btn-danger">Vazgeç</a>
                                    </div>            
                                    <input type="hidden" name="edit_id" value="<?=$edit_row->id;?>" />       
                                    <input type="hidden" name="frm" value="frmEditUsers" />    
                              </form>
                        </div>
                  
                  <?php } ?>
                        
                  <table class="table">
                        <thead>
                             <tr>
                                          <th width="50px">ID</th>
                                  <th>Ad soyad</th>
                                  <th>Telefon</th>
                                  <th>Email</th>
                                  <th>Durum</th>
                                  <th>İşlemler</th>
                             </tr>
                        </thead>
                       <tbody>
                              <?php $list = $pia->query("SELECT * FROM users WHERE status>=0"); foreach($list as $item){  ?>

                                    <tr>
                                          <td><?=$item->id;?></td>
                                          <td><?=$item->fullname;?></td>
                                          <td><?=$item->phone;?></td>
                                          <td><?=$item->email;?></td>
                                          <td><?=$item->status==1?'<label class="label-success">Aktif</label>':'<label class="label-danger">Pasif</label>';?></td>
                                          <td>
                                                <a href="users.php?edit=<?=$item->id;?>" class="btn-default btn-xs">Düzenle</a>
                                                <a onclick="_delete('users', <?=$item->id;?>);" class="btn-default btn-xs">Sil</a>
                                          </td>
                                    </tr>
                                   

                              <?php } ?>
                       </tbody>
                  </table>
           



           </section>
           <?php require('_inc/footer.php'); ?>

        
     </body>
</html>
