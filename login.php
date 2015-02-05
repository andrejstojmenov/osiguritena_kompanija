<!DOCTYPE html> 
<?php require('initialize.php');?>

<?php	

	if(isset($_SESSION['user_data']))
	{
		$user_data = $_SESSION['user_data'];
		unset($_SESSION['user_data']);
	}
	
	if(isset($_SESSION['validation_errors']))
	{
		$validation_errors = $_SESSION['validation_errors'];
		unset($_SESSION['validation_errors']);
	}
	
	if(isset($_SESSION['error_message']))
	{
		$error_message = $_SESSION['error_message'];
		unset($_SESSION['error_message']);
	}
	
	if(isset($_SESSION['success_message']))
	{
		$success_message = $_SESSION['success_message'];
		unset($_SESSION['success_message']);
	}

?>


<?php


if(isset($_POST['submit']))
{
	require('validation/val_login.php');
	if(!isset($validation_errors))
	{
		// Success. Stavi gi korisnickite podatoci vo sesija i odnesi go korisnikot na profilnata stranica
		$_SESSION['user'] = $user;
		
		if($user['role_id'] == 1)
		{
			header('Location: profile_admin.php');
		}
		elseif($user['role_id'] == 2)
		{
			header('Location: profile_user.php');
		}
		
	}
	else
	{
		if(isset($validation_errors['no_user']))
		{
			$_SESSION['error_message'] = 'Внесовте погрешно корисничко име или лозинка';
		}
		
		else 
		{
			$_SESSION['validation_errors'] = $validation_errors;
			$_SESSION['error_message'] = 'Некои од внесените податоци не се правилни, проверете ги полињата за повеќе информации';
		}
		
		$_SESSION['user_data'] = $user_data;
		// Redirect back
		header('Location: login.php');
		
	}
}


?>
<html>

<head>
  <title>Најава</title>
  <meta charset = 'utf-8' />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">		

    <header>
	  <div id="strapline">
	    <div id="welcome_slogan">
	      <h3> <span> ОСИГУРИТЕЛНА КОМПАНИЈА </span></h3>
	    </div><!--close welcome_slogan-->
      </div><!--close strapline-->	  
	  <nav>
	    <div id="menubar">
          <ul id="nav">
            <li ><a href="index.html">Почетна</a></li>
            <li><a href="vozila.html">Возила</a></li>
            <li><a href="patnicko.html">Патничко</a></li>
            <li><a href="imotno.html">Имотно</a></li>
            <li><a href="kontakt.html">Контакт</a></li>
			<li class="current"><a href="login.php">Најава</a></li>
          </ul>
        </div><!--close menubar-->	
      </nav>
    </header>
    
    <div id="image_container" class="center"> 
           <img width="940" height="250" src="images/login.jpg"  />
	</div><!--close slideshow_container-->   
	
	<div id="site_content">		
	  <div id="content">
	  <?php if(isset($error_message)){?>
				<div class="error_message"><?php echo $error_message?></div>
		<?php }?>
		<?php if(isset($success_message)){?>
				<div class="success_message"><?php echo $success_message?></div>
		<?php }?>
        <div class="content_item mt30">
		 <form action="login.php" method="post">
		 	<div class="ib">
				 <div class="ib">
					 <span class="tr_text" >Корисничко име:</span>
					 <span class="tr_text">Лозинка:</span>
				  </div>
				 
				 <div class="ib ml15">
					 <input type="text" name="username" class="tr_txt" value="<?php echo sprintifset($user_data['username'])?>">
					 <input type="password" name="password" class="tr_txt">
				  </div>
				  <div class="center mt30">
				  	<input type="submit" name="submit" class="submit" value = "Најави се">
				  </div>
			 </div>
			 
			  <div class="ib ml15" style="vertical-align:top">
				 <span class="error_txt"><?php echo printifset($validation_errors['username'][0])?></span>
				 <span class="error_txt"><?php echo printifset($validation_errors['password'][0])?></span>
			  </div>
		  </form>
		</div><!--close content_item-->
		
      </div><!--close content-->   
	</div><!--close site_content-->  	
	
  </div><!--close main-->
  
  <footer class="center">
  	сите права се задржани © 2015
  </footer>
  
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  
</body>
</html>

<?php require('terminate.php') ?>