<?php require('_class/config.php'); require('session.php');  ?>
<!DOCTYPE html >
<html>
      <head>
            <?php require('_inc/head.php');  ?>
            <title>Raporlar</title>
            <style>

                  .table tfoot tr th { text-align:left; padding-top: 1.25rem;  color: #7E8299;font-weight:600; }

                  .table tbody tr:last-child td{  border-bottom: 1px dashed #eff2f5; }



                   @media print {


                        .content { padding:0px; }
                        .header, .sidebar, .left, .title .right{ display: none; }
                        .reports .right { margin:0;padding:0;width:100%; }
                        .reports .table { border:1px solid #F5F5F5;border-bottom:0px; }
                        .reports .table tr th, .reports .table tr td {padding:10px;color:#222222;font-size:12px; }
                        [class*=label-] { background:none;padding:0px;color:#222222;font-size:12px; }

                        .reports .table tr th:first-child, .reports .table tr td:first-child { display:table-cell; }
                     
                  }

            </style>
      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">

                   <div class="title">
                        <div class="left">
                              <h1>Raporlar</h1>
                              <ul class="breadcrumb">
                                    <li><a href="main.php">Anasayfa</a></li>
                                    <li><a href="reports.php">Raporlar</a></li>
                              </ul>
                        </div>
                        <div class="right">
                        </div>
                  </div>
                  <div class="reports">
                        <div class="row">
                              <div class="col-md-3 col-xs-12 left">
                                    <form class="panel-default no" method="post" action="reports.php">
                                                <div class="form-group">
                                                      <label>Tarih Aralığı</label>
                                                                  <input type="date" name="startdate" class="form-control" value="<?=date('Y-m-d', strtotime('-30 days'));?>" />
                                                                  <input type="date" name="enddate" class="form-control" value="<?=date('Y-m-d');?>" />
                                                </div>
                                                 <div class="form-group">
                                                      <label>Cariler</label>
                                                      <select name="customers[]" class="form-control selectpicker" multiple data-selected-text-format="count" data-none-selected-text="Tümü" >
                                                            <?php $list = $pia->query("SELECT * FROM customers ORDER BY title ASC"); foreach($list as $item){ ?>
                                                                  <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>

                                                <div class="form-group">
                                                      <label>Kategoriler </label>
                                                      <select name="categories[]" class="form-control selectpicker" multiple data-selected-text-format="count" data-none-selected-text="Tümü" >
                                                            <?php $list = $pia->query("SELECT * FROM categories ORDER BY title ASC"); foreach($list as $item){ ?>
                                                                  <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                               
                                              
                                                <div class="form-group">
                                                      <label>Ödeme Yöntemi </label>
                                                      <select name="methods[]" class="form-control selectpicker" multiple data-selected-text-format="count"  data-none-selected-text="Tümü">
                                                            <?php $list = $pia->query("SELECT * FROM methods ORDER BY title DESC"); foreach($list as $item){ ?>
                                                                  <option value="<?=$item->id;?>" ><?=$item->title;?></option>
                                                            <?php } ?>
                                                      </select>
                                                </div>
                                               
                                                <button type="submit" class="btn-success btn-sm">Raporla</button>
                                          <input type="hidden" name="frm" value="frmReports" />
                                    </form>
                              </div>
                              <div class="col-md-9 col-xs-12 right">

                                    <?php 
      
      
      if(isset($_POST['frm']) and $_POST['frm']=='frmReports'){



                  $startdate = $pia->control($_POST['startdate'],'text');
                  $enddate = $pia->control($_POST['enddate'],'text');
            

                  $sql = null;
                  $customers_sql = null;
                  $categories_sql = null;
                  $methods_sql = null;
                  $date_sql = null;

                  $table = null;
                  $income_total = 0;
                  $expense_total = 0;
      

                  if(isset($_POST['customers'])){

                        $customers = $_POST['customers'];

                        foreach($customers as $item ){

                              $customer_id = $pia->control($item,'int');
                              $customers_sql[] = "customer_id=$customer_id";

                        }

                        $sql[] = ' ( '.implode(' or ', $customers_sql).' ) ';


                  }


                  if(isset($_POST['categories'])){

                        $categories = $_POST['categories'];

                        foreach($categories as $item ){

                              $category_id = $pia->control($item,'int');

                              $categories_sql[] =  "category_id=$category_id";

                        }

                        $sql[] = ' ( '.implode(' or ', $categories_sql).' ) ';


                  }


                  if(isset($_POST['methods'])){

                        $methods = $_POST['methods'];

                        foreach($methods as $item ){

                              $method_id = $pia->control($item,'int');

                              $methods_sql[] =  "method_id=$item";

                        }

                        $sql[] = ' ( '.implode(' or ', $methods_sql).' ) ';

                  }

                  
                  if(isset($_POST['startdate'])){

                        $startdate = $pia->control($_POST['startdate'],'text');

                        $date_sql[] = "DATE(adddate) >= $startdate ";

                  }

                  if(isset($_POST['enddate'])){

                        $enddate = $pia->control($_POST['enddate'],'text');

                        $date_sql[] = "DATE(adddate) <= $enddate";

                  }

                  $sql[] = implode(' and ', $date_sql);



                  


                  $sql = implode(' and ', $sql);

                  $row = $pia->get_row("SELECT * FROM finances WHERE $sql ORDER BY adddate DESC");
                  if(isset($row->id)){
                        $list = $pia->query("SELECT * FROM finances WHERE $sql ORDER BY adddate DESC");
                        foreach($list as $item){

                              $customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $item->customer_id");
                              $category_row = $pia->get_row("SELECT * FROM categories WHERE id = $item->category_id");
                              $methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $item->method_id");

                              if($item->event_type==1){

                                    $income_total += $item->price;
                                    $price = '<span class="text-success">+'.$item->price.' TRY</span>';

                              }elseif($item->event_type==0){

                                    $expense_total += $item->price;
                                    $price = '<span class="text-danger">-'.$item->price.' TRY</span>';

                              }


                              $table .= '<tr>
                                    <td>'.@$customers_row->title.'</td>
                                    <td>'.@$category_row->title.'</td>
                                    <td>'.$price.'</td>
                                    <td>'.@$methods_row->title.'</td>
                                    <td>'.$pia->time_tr($item->adddate).'</td>
                              </tr>';

                        }

                  }else{
                        $table .= '<tr><td colspan="2">Geliriniz bulunmuyor.</td></tr>';
                  }
                  


                  $price = $pia->price_format($income_total-$expense_total);

            if($price>0){
                  $price = '<span class="text-success">+'.$price.' TRY</span>';
            }elseif($price<0){
                  $price = '<span class="text-danger">'.$price.' TRY</span>';
            }else{
                  $price = $price; 
            }

             }
?>
  <table class="table" data-searching="false" data-ordering="false" data-paging="false" data-info="false">
                              <thead>
                                    <tr>
                                          <th>Cari adı</th>
                                          <th>Kategoriler</th>
                                          <th>Fiyat</th>
                                          <th>Ödeme Y.</th>
                                          <th>Tarih</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?=@$table;?>
                            
                                    <tr >
                                          <td></td>
                                          <td>Toplam Gelir</td>
                                          <td><?=@$income_total;?> TRY</td>
                                          <td></td>
                                          <td></td>
                                    </tr>
                                    <tr>
                                          <td></td>
                                          <td>Toplam Gider</td>
                                          <td><?=@$expense_total;?> TRY</td>
                                          <td></td>
                                          <td></td>
                                    </tr>
                                    <tr>
                                          <td></td>
                                          <td>Genel Toplam</td>
                                          <td><?=@$price;?></td>
                                          <td></td>
                                          <td></td>
                                    </tr>
                              </tfoot>
                        </table>
      





                              </div>      
                        </div>
                  </div>
                 
                  
                        

           </section>
           <?php require('_inc/footer.php'); ?>
           

           

     </body>
</html>
