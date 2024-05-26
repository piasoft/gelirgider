<?php require('_class/config.php'); require('session.php');  ?>
<!DOCTYPE html>
<html>
      <head>
            <?php require('_inc/head.php'); ?>
            <title>Anasayfa</title>
            <style>
           		 .widget { margin-bottom:50px; }  .widget .title h1 { font-size:20px; } 


			.card { display: block;position: relative; background:#FFF;padding:30px;margin-bottom:30px;border-radius: 4px;overflow: hidden; }
			.card .card-title { display:block;font-size:13px;font-weight: 600;color: #A1A5B7;margin-bottom:15px; }

			.price { display:block; font-size: 1.50em;font-weight: 900;color:#666666; }
			.date { display:block;color:#A1A5B7;font-size: 1em; }
			
                          
             </style>
      </head>
      <body>
            <?php require('_inc/header.php'); ?>
            <section class="content">
            	 
				
		            	<div class="widget">
			      		<div class="title">
		        				<div class="left"><h1>Gelirler</h1></div>
		  				</div>
			        			
		        			<table class="table" data-ordering="false" data-paging="false" data-searching="false" data-info="false">
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
		                              	<?php 
		                              		$list = $pia->query("SELECT * FROM finances WHERE event_type=1 ORDER BY adddate DESC LIMIT 0,3");  
									foreach($list as $item){ 
										$methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $item->method_id");
										$customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $item->customer_id");
								            $categories_row = $pia->get_row("SELECT * FROM categories WHERE id=$item->category_id");
								?>	
									<tr>

										<td><?=$customers_row->title;?></td>
										<td><?=$categories_row->title;?></td>

										<td class="text-success">+ <?=$item->price;?> TRY</td>
										<td><?=$methods_row->title;?></td>
										
										<td><?=$pia->time_tr($item->adddate);?></td>


									</tr>

									
								<?php } ?>
							</tbody>
	                              </table>
					</div>
					<div class="widget">
					    
					      	<div class="title">
			        				<div class="left"><h1>Giderler</h1></div>
		        				</div>

					       
				        			
				        			<table class="table" data-ordering="false" data-paging="false" data-searching="false" data-info="false">
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
				                              	<?php 
				                              		$list = $pia->query("SELECT * FROM finances WHERE event_type=0 ORDER BY adddate DESC LIMIT 0,3");  
											foreach($list as $item){ 
												$methods_row = $pia->get_row("SELECT * FROM methods WHERE id = $item->method_id");
												$customers_row = $pia->get_row("SELECT * FROM customers WHERE id = $item->customer_id");
										            $categories_row = $pia->get_row("SELECT * FROM categories WHERE id=$item->category_id");

										?>	
											<tr>

												<td><?=@$customers_row->title;?></td>
												<td><?=@$categories_row->title;?></td>

												<td class="text-danger">- <?=$item->price;?> TL</td>

												<td><?=@$methods_row->title;?></td>
												
												<td><?=$pia->time_tr($item->adddate);?></td>


											</tr>

											
										<?php } ?>
									</tbody>
			                              </table>
					    </div>
						

			   
			    <div class="widget">
			        	
			        	<div class="title">
	        				<div class="left"><h1>Raporlar</h1></div>
        				</div>


                  		<div class="row">
                  			<div class="col-md-4 col-sm-4 col-xs-12">
		                  		<div class="card">
	                  				<div class="card-title">BUGÜN</div>
		                  			<div class="card-body">
		                  				<strong class="price"><?=$pia->get_today($admin->id);?></strong>
		                  				<span class="date"><?=$pia->time_tr(date('Y-m-d'),'date');?></span>
		                  			</div>
		                  		</div>
		                  	</div>
		                  	<div class="col-md-4 col-sm-4 col-xs-12">
		                  		<div class="card">
	                  				<div class="card-title">DÜN</div>
		                  			<div class="card-body">
		                  				<strong class="price"><?=$pia->get_yesterday($admin->id);?></strong>
		                  				<span class="date"><?=$pia->time_tr(date('Y-m-d', strtotime('-1 day')),'date'); ?></span>
		                  			</div>
		                  		</div>
		                  	</div>
		                  	<div class="col-md-4 col-sm-4 col-xs-12">
		                  		<div class="card b0 ">
	                  				<div class="card-title">SON 15 GÜN</div>
		                  			<div class="card-body">
		                  				<strong class="price"><?=$pia->get_last15day($admin->id);?></strong>
		                  				<span class="date">
		                  					<?=$pia->time_tr(date('Y-m-d', strtotime('today - 15 days')),'month');?> -
		                  					<?=$pia->time_tr(date('Y-m-d'),'date');?>
		                  				</span>
		                  			</div>
		                  		</div>
		                  	</div>
		                  	<div class="col-md-4 col-sm-4 col-xs-12">
		                  		<div class="card b0 ">
	                  				<div class="card-title">SON 30 GÜN</div>
		                  			<div class="card-body">
		                  				<strong class="price"><?=$pia->get_last30day($admin->id);?></strong>
		                  				<span class="date">
		                  					<?=$pia->time_tr(date('Y-m-d', strtotime('today - 30 days')),'month');?> -
		                  					<?=$pia->time_tr(date('Y-m-d'),'date');?>
		                  				</span>
		                  			</div>
		                  		</div>
		                  	</div>
                  			<div class="col-md-4 col-sm-4 col-xs-12">
                  				<?php 
            						$start = date('d', strtotime('monday this week')); 
            						$end = date('Y-m-d', strtotime('sunday this week')); 
							?>
		                  		<div class="card">
	                  				<div class="card-title">BU HAFTA</div>
		                  			<div class="card-body">
		                  				<strong class="price "><?=$pia->get_week($admin->id);?></strong>
		                  				<span class="date"><?=$start.' - '.$pia->time_tr($end,'date');?></span>
		                  			</div>
		                  		</div>
		                  	</div>
		                  	<div class="col-md-4 col-sm-4 col-xs-12">
		                  		<div class="card">
	                  				<div class="card-title">BU AY</div>
		                  			<div class="card-body">
		                  				<strong class="price">
		                  					<?=$pia->get_month($admin->id);?>
		                  				</strong>
		                  				<span class="date"><?=@$pia->time_tr(date('Y-m'),'date');?></span>
		                  			</div>
		                  		</div>
		                  	</div>
                  			
		                  </div>
                  	
				</div>


            </section>
            <?php require('_inc/footer.php'); ?>



      </body>
</html>
