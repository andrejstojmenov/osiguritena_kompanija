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
		
		require('validation/val_stan.php');
		if(!isset($validation_errors))
		{
			$cena0=0;  
			$cena1=0;  		
			$rez=0;
			$pov=$_POST['povrasina'];		
			$vid_gradba=$_POST["gradba"];			
			switch($vid_gradba)
			{
				case '0':$cena0=0; break;
				case 'Тврда':$cena0=2500; break;
				case 'Мешовита':$cena0=2750; break;
				case 'Слаба':$cena0=3000; break;				
			}	
			if($pov <= 10&& $pov!=' ' && $pov!=0){
			$cena1=1350;
			
			}
			else if($pov > 10 && $pov <=100 && $pov!=' ')
			{
			$cena1=1850;

			}
			else if($pov > 100&& $pov!=' ')
			{
			$cena1=2150;

			}
			else{
			$cena1=0;
			}			
			$rez=$cena0+$cena1;
		
		
			$sql="INSERT INTO `stanovi`(`licna_karta`, `adresa`,`grad`,`gradba`,`povrsina`, `cena`, `user_id`)
			 VALUES
			 ('$_POST[licna_karta]','$_POST[adresa]','$_POST[grad]','$_POST[gradba]','$_POST[povrsina]',$rez, $user[id])";	

			mysql_query("SET NAMES utf8");
			mysql_query($sql) or die(mysql_error());
		 
			$_SESSION['user_data'] = $user_data;
			$_SESSION['user_data']['cena']= $rez;
		 
			$_SESSION['success_message'] = 'Внесено е ново осигурување на стан. Можете да го снимите во PDF формат и да го испечатите ';
			header('Location: stan.php');
		
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
			header('Location: stan.php');
		
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
		<h1 style="text-align: center">Осигурување на стан</h1>
		
		  <form action="stan.php" method="post">
			
			<article>	
				<table cellspacing="10" id="osi_avto" class="tr_text" style = 'height:auto'>
					<tr><td align="left">Број на лична карта: </td><td><input type="text" name="licna_karta" class="tr_txt" value="<?php echo sprintifset($user_data['licna_karta'])?>"></td><td class="red"><?php echo printifset($validation_errors['licna_karta'][0])?></td></tr>
					<tr><td align="left">Адреса на градежниот објект: </td><td><input type="text" name="adresa" class="tr_txt" value="<?php echo sprintifset($user_data['adresa'])?>"></td><td class="red"><?php echo printifset($validation_errors['adresa'][0])?></td></tr>
					<tr><td align="left">Град: </td>
					<td>
						<select style="width:155px" name="grad" class="tr_txt">
							<option value="0">Изберете град</option>
							<option value="Берово" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Берово') echo 'selected'?>>Берово</option>
							<option value="Битола" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Битола') echo 'selected'?>>Битола</option>
							<option value="Виница" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Виница') echo 'selected'?>>Виница</option>				
							<option value="Дебар" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Дебар') echo 'selected'?>>Дебар</option>
							<option value="Делчево" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Делчево') echo 'selected'?>>Делчево</option>
							<option value="Кавадарци" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Кавадарци') echo 'selected'?>>Кавадарци</option>
							<option value="Кичево" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Кичево') echo 'selected'?>>Кичево</option>
							<option value="Кочани" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Кочани') echo 'selected'?>>Кочани</option>
							<option value="Кратово" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Кратово') echo 'selected'?>>Кратово</option>
							<option value="Крива Паланка" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Крива Паланка') echo 'selected'?>>Крива Паланка</option>
							<option value="Крушево" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Крушево') echo 'selected'?>>Крушево</option>
							<option value="Куманово" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Куманово') echo 'selected'?>>Куманово</option>
							<option value="Македонски Брод" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Македонски Брод') echo 'selected'?>>Македонски Брод</option>
							<option value="Неготино" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Неготино') echo 'selected'?>>Неготино</option>
							<option value="Охрид"<?php if(isset($user_data['grad']) && $user_data['grad'] == 'Охрид') echo 'selected'?>>Охрид</option>
							<option value="Радовиш" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Радовиш') echo 'selected'?>>Радовиш</option>
							<option value="Ресен" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Ресен') echo 'selected'?>>Ресен</option>					
							<option value="Прилеп" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Прилеп') echo 'selected'?>>Прилеп</option>
							<option value="Пробиштип" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Пробиштип') echo 'selected'?>>Пробиштип</option>
							<option value="Свети Николе" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Свети Николе') echo 'selected'?>>Свети Николе</option>
							<option value="Скопје" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Скопје') echo 'selected'?>>Скопје</option>
							<option value="Струга" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Струга') echo 'selected'?>>Струга</option>
							<option value="Струмица" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Струмица') echo 'selected'?>>Струмица</option>					
							<option value="Тетово" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Тетово') echo 'selected'?>>Тетово</option>
							<option value="Штип" <?php if(isset($user_data['grad']) && $user_data['grad'] == 'Штип') echo 'selected'?>>Штип</option>		
						</select>		
					</td>
					<td class="red"><?php echo printifset($validation_errors['grad'][0])?></td>
					</tr>
					<tr><td align="left">Вид на градба: </td>
					<td>
						<select style="width:155px" name="gradba" class="tr_txt">
							<option value="0">Изберете градба</option>
							<option value="Тврда" <?php if(isset($user_data['gradba']) && $user_data['gradba'] == 'Тврда') echo 'selected'?>>Тврда</option>
							<option value="Мешовита" <?php if(isset($user_data['gradba']) && $user_data['gradba'] == 'Мешовита') echo 'selected'?>>Мешовита</option>
							<option value="Слаба" <?php if(isset($user_data['gradba']) && $user_data['gradba'] == 'Слаба') echo 'selected'?>>Слаба</option>		
						</select>		
					</td>
					<td class="red"><?php echo printifset($validation_errors['gradba'][0])?></td></tr>
					<tr><td align="left">Површина: </td><td><input type="text" name="povrsina" class="tr_txt"  placeholder="m2" value="<?php echo sprintifset($user_data['povrsina'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['povrsina'][0])?></td></tr>
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