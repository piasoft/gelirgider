<header class="header">
         <a href="https://www.piasoft.com.tr" class="copyright">Piasoft V1.2</a>
         <a class="toggle"><i class="fal fa-bars"></i> Menü</a>

            <a href="users.php?edit=<?=$admin->id;?>"><i class="fal fa-user"></i> <?=$admin->fullname;?></a>
            <a href="logout.php"><i class="fal fa-sign-out"></i> Çıkış Yap</a>
         
</header>


<?php $count = $pia->get_var("SELECT COUNT(*) as count FROM reminders WHERE status=0"); ?>

<div class="sidebar">
      <ul>
          
            <li class="hidden-xs hidden-sm"><a href="main.php" ><i class="far fa-home"></i>  <span>Anasayfa</span></a> </li>

            <li><a href="income.php"> <i class="far fa-plus-circle"></i>  Gelirler </a> </li>

            <li><a href="expense.php"><i class="far fa-minus-circle"></i> Giderler </a>  </li>
    
            <li> <a href="customers.php"><i class="far fa-handshake"></i> Cariler</a> </li> 

            <li><a href="categories.php"><i class="far fa-sitemap"></i> Kategoriler</a></li>

 
            <li><a href="reminders.php"><i class="far fa-clock"></i>  Hatırlatmalar <?php if($count>0){ ?><span class="count"><?=$count;?></span><?php } ?> </a>  </li>
            <li><a href="reports.php"><i class="far fa-chart-pie"></i> Raporlar</a>  </li>
  
            <li><a href="users.php"><i class="far fa-users-cog"></i> Kullanıcılar</a></li>

            <li><a href="logout.php"><i class="far fa-sign-out"></i> Çıkış Yap</a></li>
            
                 

      </ul>
</div>





<div class="loader"><i class="fal fa-fw fa-spinner fa-spin"></i></div>

