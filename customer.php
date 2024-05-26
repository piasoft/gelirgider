<?php require('_class/config.php');  require('session.php');   ?>
<!DOCTYPE html>
<html>
      <head>
            <?php 
                  require('_inc/head.php');  
                  $customer_id = $pia->control($_GET['id'],'int');
                  $customers_row = $pia->get_row("SELECT * FROM customers WHERE id=$customer_id");

            ?>
            <title><?=$customers_row->title;?> / Cariler</title>
           
      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">
                
                  <div class="title">
                        <div class="left">
                              <h1><?=$customers_row->title;?></h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="customers.php">Cariler</a></li>
                                    <li><a href="customers.php?id=<?=$customers_row->id;?>"><?=$customers_row->title;?></a></li>
                              </ul>
                        </div>
                        <div class="right ">
                        </div>
                  </div>
                   <?php if(isset($_GET['view_id'])){ 

                        $edit_id = $pia->control($_GET['view_id'],'int');
                        $edit_row = $pia->get_row("SELECT * FROM finances WHERE id=$edit_id");
                        $customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $edit_row->customer_id");
                        $categories_row = $pia->get_row("SELECT * FROM categories WHERE id = $edit_row->category_id");
                        $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $edit_row->method_id");


                  ?>

                    
                        <div class="modal active printable">
                                    <div class="panel-default modal-medium">
                                          <div class="panel-title">#<?=$edit_row->id;?> numaralı işlem özeti</div> 
                                          <a href="customer.php?id=<?=$customers_row->id;?>" class="panel-close"><i class="fal fa-times"></i></a>
                                               
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
                                                      <?=$edit_row->event_type==0 ? '<span class="text-danger">- '.$edit_row->price.' TRY</span>' : '<span class="text-success">+ '.$edit_row->price.' TRY</span>' ;?>
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
                                                <div class="form-group">
                                                     <strong>Tarih : </strong> 
                                                     <?=$pia->time_tr($edit_row->adddate);?>
                                                </div>
                                                     
                                             

                                          </div>
                                                     
                                               
                              <a class="btn-primary" onClick="print();"><i class="far fa-print"></i> Yazdır</a>

                                          <a href="customer.php?id=<?=$customers_row->id;?>" class="btn-danger">Vazgeç</a>
                                               
                                                   
                                    </div>
                        </div>
                 
              <?php } ?>

                  	<div class="row reports">
                  		
                  		<div class="col-md-9 col-xs-12 left xs-mb-30">
            						<table class="table"  data-ordering="false" data-paging="false">
            							<thead>
            								<tr>
                                                                  <th>Kategoriler</th>
                                                                  <th>Tutar</th>
            									<th>Ödeme Y.</th>
            									<th>Tarih</th>
            								</tr>
            							</thead>
            							<tbody>
            								<?php 
            									
      										$list = $pia->query("SELECT * FROM finances WHERE customer_id=$customers_row->id ORDER BY adddate DESC");
      										foreach($list as $item){
      											$category_row = $pia->get_row("SELECT * FROM categories WHERE id=$item->category_id");
      										      $methods_row = $pia->get_row("SELECT * FROM methods WHERE id=$item->method_id");
                                                                        $price = $item->event_type==0 ? '<span class="text-danger">- '.$item->price.' TRY</span>' : '<span class="text-success">+ '.$item->price.' TRY</span>' ; 
            								?>
            								<tr>
                                                                  <td><a href="customer.php?id=<?=$customers_row->id;?>&view_id=<?=$item->id;?>"><?=$category_row->title;?></a></td>
            									<td><?=$price;?></td>
                                                                  <td><?=$methods_row->title;?></td>
            									<td width="200" class="text-right"><?=$pia->time_tr($item->adddate);?></td>
            								</tr>
            							
            								<?php } ?>
            							</tbody>
            						</table>
            					
					</div>
                              <div class="col-md-3 col-xs-12 right ">
                                    <div class="panel-default">
                                               
                                          <div class="panel-body">
                                                <div class="form-group">
                                                      <label>Ad Soyad / Firma Adı : </label> <?=@$customers_row->title;?>
                                                </div>
                                          
                                               <div class="form-group">
                                                      <label>Telefon : </label><?=@$customers_row->phone;?>
                                                </div>
                                                <div class="form-group">
                                                      <label>Email : </label><?=@$customers_row->email;?>
                                                </div>
                                                 
                                                <div class="form-group">
                                                      <label>Adres :</label> <?=@$customers_row->address;?>
                                                </div>
                                                
                                                <?php if(!empty($customers_row->tax_no)){ ?>
                                                      <div class="form-group">
                                                            <label>TC / Vergi no : </label> <?=@$customers_row->tax_no;?>
                                                      </div> 
                                                <?php } ?>

                                                <?php if(!empty($customers_row->tax_office)){ ?>
                                                       <div class="form-group" >
                                                      <label>Vergi Dairesi : </label> <?=@$customers_row->tax_office;?>
                                                </div>
                                                <?php } ?>
                                                <a href="customers.php?edit=<?=$customers_row->id;?>" class="btn-primary" target="_blank">Düzenle</a>
                                                            <a onclick="_delete('customers', <?=$customers_row->id;?>);" target="_blank" class="btn-danger">Sil</a>
                                          </div>

                                              
                                    </div>
                              </div>
				</div>
		
                





           </section>
           <?php require('_inc/footer.php'); ?>

           
           
     </body>
</html>
