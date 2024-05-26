<?php require('_class/config.php'); require('session.php');  ?>
<!DOCTYPE html>
<html>
     <head>
          <?php  require('_inc/head.php');    ?>
          <title>Kategoriler</title>
     </head>
     <body >
            <?php require('_inc/header.php'); ?>
            <section class="content">
             
                  

                  <?php if(isset($_GET['add'])){ ?>

                        <div class="modal active">
                                    <form class="panel-default modal-medium" method="post" action="_ajax/_ajaxAddCategories.php"  autocomplete="off">
                                          <div class="panel-title"><i class="fal fa-plus-circle"></i> Yeni ekle</div> 
                                          <div class="panel-body">
                                                      <input type="text" name="title" class="form-control" placeholder="Kategori adı" required />
                                          </div>
                                          <div class="panel-footer">
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                                <a href="categories.php" class="btn btn-danger">Vazgeç</a>
                                          </div>
                                          <input type="hidden" name="frm" value="frmAddCategories" />
                                    </form>
                        </div>
                           
                  <?php }elseif(isset($_GET['edit'])){ 
                              $edit_id = $pia->control($_GET['edit'],'int');
                              $edit_row = $pia->get_row("SELECT * FROM categories WHERE id=$edit_id");

                  ?>
                         <div class="modal active">
                                    <form class="panel-default modal-medium" action="_ajax/_ajaxEditCategories.php" method="post"  autocomplete="off">
                                          <div class="panel-title"><i class="fal fa-pen"></i> Düzenle</div> 
                                          <div class="panel-body">
                                                      <input type="text" name="title" class="form-control" value="<?=$edit_row->title;?>" placeholder="Kategori adı" required />
                                          </div>
                                          <div class="panel-footer">
                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                                <a href="categories.php" class="btn btn-danger">Vazgeç</a>
                                          </div>
                                                                   
                                          <input type="hidden" name="edit_id" value="<?=$edit_row->id;?>" />       
                                          <input type="hidden" name="frm" value="frmEditCategories" />    
                                    </form>
                        </div>
                              
                  <?php }?>

                        <div class="title">
                              <div class="left">
                                    <h1>Kategoriler</h1>
                                    <ul class="breadcrumb">
                                          <li><a href="main.php">Anasayfa</a></li>
                                          <li><a href="categories.php">Kategoriler</a></li>
                                    </ul>
                              </div>
                              <div class="right"><a href="categories.php?add" class="btn-success btn-sm">Yeni ekle</a></div>
                        </div>

                       
                        <table class="table">
                              <thead>
                                    <tr>
                                          <th width="50px">ID</th>
                                          <th>Kategori adı</th>
                                          <th>İşlemler</th>
                                    </tr>
                              </thead>
                              <tbody>
                                     <?php $list = $pia->query("SELECT * FROM categories"); foreach($list as $item){  ?>

                                    <tr>
                                          <td><?=$item->id;?></td>
                                          <td><?=$item->title;?></td>
                                          <td>
                                                      <a href="categories.php?edit=<?=$item->id;?>" class="btn-default btn-xs">Düzenle</a>
                                                      <a onclick="_delete('categories', <?=$item->id;?>);" class="btn-default btn-xs">Sil</a>
                                          </td>
                                    </tr>
                                   

                              <?php } ?>
                              </tbody>
                        </table>

               



           </section>
           <?php require('_inc/footer.php'); ?>
     </body>
</html>
