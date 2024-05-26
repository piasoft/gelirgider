<?php require('_class/config.php'); if(isset($admin->id)){ echo '<script>window.location.href="main.php";</script>'; }  ?>
<!DOCTYPE html>
<html>
  	<head>
    	     <?php require('_inc/head.php'); ?>
           <title>Giriş Yap</title>
      </head>
  	<body >
            <form class="login" action="_ajax/_ajaxLogin.php" method="post" autocomplete="off">
                        <div class="left">
                              <div class="logo"><img src="https://www.piasoft.com.tr/images/logo.svg" /></div>
                              <img src="images/login.png" />
                        </div>
                        <div class="right">
                              <div class="heading">
                                          <h1>Yönetim paneli</h1>
                                          <p>Yönetim paneline erişmek için lütfen giriş yapınız.</p>
                              </div>
                              <div class="form-group">
                                    <input type="text" name="email"  class="form-control" placeholder="Email"  required />
                              </div>
                              <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Şifre" required />
                              </div>
                                
                              <button type="submit" class="btn-primary" >Giriş Yap</button>
                        </div>
                        <input type="hidden" name="frm"  value="frmLogin" />  
            </form>
            <?php  require('_inc/footer.php'); ?>
      </body>
</html>
