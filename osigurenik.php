﻿<!DOCTYPE html> 
<?php require('initialize.php'); ?>
<?php $auth->admin(); ?>

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

	if(isset($_POST['vnesi']))
	{
		
		// Validiraj gi vnesenite podatoci
		require('validation/val_osigurenik.php');
		if(!isset($validation_errors))
		{
		
			$username = $_POST["ime"] . '.' .$_POST["prezime"];
			$password = 'qwerty123';
		
			$sql="INSERT INTO users (`username`,`password`, `role_id` ,`ime`, `prezime`,`licna_karta`,`adresa`,`telefon`)
			 VALUES
			 ( '$username' , '$password' , 2 ,'$_POST[ime]','$_POST[prezime]','$_POST[licna_karta]','$_POST[adresa]','$_POST[telefon]')";	
		
			 mysql_query("SET NAMES utf8");
			 mysql_query($sql) or die(mysql_error());
		 
			 $_SESSION['success_message'] = 'Новиот корисник со корисничко име '. $username .' е внесен';
			 header('Location: osigurenik.php');
		}
		else
		{
			$_SESSION['validation_errors'] = $validation_errors;
			$_SESSION['error_message'] = 'Некои од внесените податоци не се правилни, проверете ги полињата за повеќе информации';
			$_SESSION['user_data'] = $user_data;
			header('Location: osigurenik.php');
		}

		
	}

?>


<html>

<head>
  <title>Внеси осигуреник</title>
  <meta charset = 'utf-8' />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
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
	    <div id='cssmenu'>
			<ul>
			   <li class='active'><a href='osigurenik.php'><span>Внеси нов осигуреник</span></a></li>
			   <li class='has-sub'><a href='#'><span>Осигурување</span></a>
				  <ul>
					 <li class='has-sub'><a href='#'><span>Осигурување на возила</span></a>
						<ul>
						   <li><a href='vozila.php'><span>Осигурување на автомобили</span></a></li>
						   <li class='last'><a href='motorcikli.php'><span>Осигурување на моторцикли</span></a></li>
						   <li class='last'><a href='tovarni.php'><span>Осигурување на товарни возила</span></a></li>
						</ul>
					 </li>
					 <li class='has-sub'><a href='#'><span>Осигурување на имот</span></a>
						<ul>
						   <li><a href='stan.php'><span>Осигурување на стан</span></a></li>
						   <li class='last'><a href='kuka.php'><span>Осигурување на куќа</span></a></li>
						   <li class='last'><a href='deloven.php'><span>Осигурување на деловен простор</span></a></li>
						</ul>
					 </li>
					 <li class='has-sub'><a href='patnicko.php'><span>Патничко осигурување</span></a>
					
					 </li>
				  </ul>
			   </li>
			   <li><a href='logout.php'><span>Одјави се</span></a></li>
			</ul>
		</div>	
      </nav>
    </header>
    
    <div id="image_container" class="center"> 
           <img width="940" height="250" src="images/admin.jpg"  />
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
		<h1 style="text-align: center; margin-bottom:20px;">Внеси нов осигуреник</h1>
		 <form action="osigurenik.php" method="post">
		 <section id="main_section2">
			<article>
				<table cellspacing="10" id="osi_avto" class="tr_text" style = 'height:auto'>
					<tr><td align="left">Име на осигуреникот: </td><td><input type="text" name="ime" class="tr_txt" value="<?php echo sprintifset($user_data['ime'])?>"></td><td class="red"><?php echo printifset($validation_errors['ime'][0])?></td></tr>
					<tr><td align="left">Презиме на осигуреникот: </td><td><input type="text" name="prezime" class="tr_txt" value="<?php echo sprintifset($user_data['prezime'])?>"></td><td class="red"><?php echo printifset($validation_errors['prezime'][0])?></td></tr>
					<tr><td align="left">Број на лична карта: </td><td><input type="text" name="licna_karta" class="tr_txt" value="<?php echo sprintifset($user_data['licna_karta'])?>"></td><td class="red"><?php echo printifset($validation_errors['licna_karta'][0])?></td></tr> 
					<tr><td align="left">Адреса: </td><td><input type="text" name="adresa" class="tr_txt" value="<?php echo sprintifset($user_data['adresa'])?>"></td><td class="red"><?php echo printifset($validation_errors['adresa'][0])?></td></tr>
					<tr><td align="left">Телефонски број: </td><td><input type="text" name="telefon" class="tr_txt" value="<?php echo sprintifset($user_data['telefon'])?>"></td><td class="red"><?php echo printifset($validation_errors['telefon'][0])?></td></tr>
					<tr><td align="right"><input type="submit" name="vnesi" value="Внеси" class="submit" style="width:100px" target="_blank"></td></tr>
				</table>		
			</article>
		</section>
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