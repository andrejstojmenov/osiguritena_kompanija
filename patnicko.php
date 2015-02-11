<!DOCTYPE html> 
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

	if(isset($_POST['presmetaj']))
	{
		
		require('validation/val_patnicko.php');
		if(!isset($validation_errors))
		{
			$cena0=0;  
			$cena1=0;		  		
			$rez=0;		
			$pokri=$_POST["pokritie"];
			$pokri1;
			$pokri2;
			$pokri3;		
			

			if (isset($_POST['zdravstvena']) && isset($_POST['nezgoda']) && isset($_POST['bagaz']))
			{	
				$cena0=300;
				$pokri1=true;
				$pokri2=true;
				$pokri3=true;
			}
			else if (isset($_POST['zdravstvena']) && isset($_POST['nezgoda']))
			{	
				$cena0=180;
				$pokri1=true;
				$pokri2=true;
				$pokri3=false;
			}
			else if (isset($_POST['zdravstvena']) && isset($_POST['bagaz']))
			{	
				$cena0=200;
				$pokri1=true;
				$pokri2=false;
				$pokri3=true;
			}
			else if (isset($_POST['nezgoda']) && isset($_POST['bagaz']))
			{	
				$cena0=220;
				$pokri1=false;
				$pokri2=true;
				$pokri3=true;
			}
			else if (isset($_POST['zdravstvena']))
			{
			
				$cena0=80;
				$pokri1=true;
				$pokri2=false;
				$pokri3=false;
			}
			else if (isset($_POST['nezgoda']))
			{
			
				$cena0=100;
				$pokri1=false;
				$pokri2=true;
				$pokri3=false;
			}
			else if (isset($_POST['bagaz']))
			{
			
				$cena0=120;
				$pokri1=false;
				$pokri2=false;
				$pokri3=true;
			}
		
			else 
			{
				$cena0=0;
				$pokri1=false;
				$pokri2=false;
				$pokri3=false;
			}
			if($pokri1==true)
			{
				$pokriT1="ДА";
			}
			else
			{
				$pokriT1="НЕ";
			}
			if($pokri2==true)
			{
				$pokriT2="ДА";
			}
			else
			{
				$pokriT2="НЕ";
			}
			if($pokri3==true)
			{
				$pokriT3="ДА";
			}
			else
			{
				$pokriT3="НЕ";
			}
			
			if($pokri<= 10&& $pokri!=' ' && $pokri!=0)
				{
					$cena1=50;			
				}
			else if($pokri > 10 && $pokri <=30 && $pokri!=' ')
				{
					$cena1=250;
		
				}
			else if($pokri > 20&& $pokri!=' ')
				{
					$cena1=300;	
				}
			else{
					$cena1=0;
				}				
				$rez=$cena0+$cena1;
		
			$sql="INSERT INTO `patnicki`(`licna_karta`, `period`,`drzava`,`zdravstvena`,`nezgoda`, `bagaz`, `cena`, `user_id`)
			 VALUES
			 ('$_POST[licna_karta]','$_POST[period]','$_POST[drzava]','$_POST[zdravstvena]','$_POST[nezgoda]','$_POST[bagaz]',$rez, $user[id])";	

			mysql_query("SET NAMES utf8");
			mysql_query($sql) or die(mysql_error());
		 
			$_SESSION['user_data'] = $user_data;
			$_SESSION['user_data']['cena']= $rez;
		 
			$_SESSION['success_message'] = 'Внесено е ново здравствено осигурување. Можете да го снимите во PDF формат и да го испечатите ';
			header('Location: patnicko.php');
		
		}
		else
		{
			if(isset($validation_errors['no_user']))
			{
				$_SESSION['error_message'] = $_SESSION['error_message'] = 'Не постои корисник со број на лична карта ' . $user_data['licna_karta'];
			}
		
			else
			{
				$_SESSION['validation_errors'] = $validation_errors;
				$_SESSION['error_message'] = 'Некои од внесените податоци не се правилни, проверете ги полињата за повеќе информации';
			}
		
			$_SESSION['user_data'] = $user_data;
			// Redirect back
			header('Location: patnicko.php');
		
		}
		
		
		
	}

?>


<html>

<head>
  <title></title>
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
			   <li><a href='osigurenik.php'><span>Внеси нов осигуреник</span></a></li>
			   <li class='active has-sub'><a href='#'><span>Осигурување</span></a>
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
		<h1 style="text-align: center">Патничко осигурување</h1>
		
		  <form action="patnicko.php" method="post">
			
			<article>	
				<table cellspacing="10" id="osi_avto" class="tr_text" style = 'height:auto'>
					<tr><td align="left">Број на лична карта: </td><td><input type="text" name="licna_karta" class="tr_txt" value="<?php echo sprintifset($user_data['licna_karta'])?>"></td><td class="red"><?php echo printifset($validation_errors['licna_karta'][0])?></td></tr>
					<tr><td align="left">Период на покритие: </td><td><input type="text" name="period" class="tr_txt" placeholder="дена" value="<?php echo sprintifset($user_data['period'])?>"></td><td class="red"><?php echo printifset($validation_errors['period'][0])?></td></tr>
					<tr><td align="left">Држава на патување: </td><td><input type="text" name="drzava" class="tr_txt" value="<?php echo sprintifset($user_data['drzava'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['drzava'][0])?></td></tr>
					
					<tr><td align="left">Здравствена помош при патување: </td><td><input type="checkbox" name="zdravstvena" class="tr_txt">
					</td></tr>
					
					<tr><td align="left">Осигурување од незгода: </td><td><input type="checkbox" name="nezgoda" class="tr_txt">
					</td></tr>
					
					<tr><td align="left">Осигурување на багаж: </td><td><input type="checkbox" name="bagaz" class="tr_txt">
					</td></tr>
					
					<tr><td align="right"><td>Цена:</td> <td><input type="text" name="cena" style="width:50px; display:inline" disabled="true" class="tr_txt" value="<?php echo sprintifset($user_data['cena'])?>"> Ден.</td></tr>
					<tr><td align="right"><input type="submit" name="presmetaj" value="Пресметај" class="submit" style="width:100px" target="_blank"></td></tr>
				</table>		
			</article>
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