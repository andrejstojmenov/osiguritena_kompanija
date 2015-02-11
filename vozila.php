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
		// Validiraj gi vnesenite podatoci
		require('validation/val_vozila.php');
		
		if(!isset($validation_errors))
		{
			$cena0=0;  
			$cena1=0;  
			$cena2=0;  
			$rez=0;
			$power=$_POST["sila"];
			$zaf=$_POST["zafatnina"];
			$avto=$_POST["tip"];	
			
			switch($avto)
			{
			case '0':$cena0=0; break;
			case 'Лимузина':$cena0=1000; break;
			case 'Купе':$cena0=2000; break;
			case 'Караван':$cena0=1500; break;
			case 'Кабриолет':$cena0=3000; break;
			case 'Спортски автомобил':$cena0=4500; break;
			}	
			
			if($power <= 50 && $power!=' ' && $power!=0){
			$cena1=1200;
			
			}
			else if($power > 50 && $power <=150 && $power!=' ')
			{
			$cena1=1500;
	
			}
			else if($power > 150 && $power!=' ')
			{
			$cena1=2250;
	
			}
			else{
			$cena1=0;
			}
			if($zaf <=1000 && $zaf!=' ' && $zaf!=0){
			$cena2=1000;
		
			}
			else if($zaf > 1000 && $zaf <=1500 && $zaf!=' ')
			{
			$cena2=1500;
		
			}
			else if($zaf >1500 && $zaf <=2000 && $zaf!=' ')
			{
			$cena2=2000;
		
			}
			else if($zaf > 2000 && $zaf!=' ')
			{
			$cena2=2500;		
			}
			else
			{
			$cena2=0;			
			}
			$rez=$cena0+$cena1+$cena2;
		
		
		
			$sql="INSERT INTO `avtomobili`(`licna_karta`, `reg_br`,`br_shasija`,`marka`,`tip`,`sila`,`zafatnina`,`godina`,`boja`,`cena`,`user_id`)
				 VALUES
			 	('$_POST[licna_karta]','$_POST[reg_br]','$_POST[br_shasija]','$_POST[marka]','$_POST[tip]','$_POST[sila]','$_POST[zafatnina]','$_POST[godina]','$_POST[boja]',$rez, $user[id])";	

			mysql_query("SET NAMES utf8");
			mysql_query($sql) or die(mysql_error());
		 
			$_SESSION['user_data'] = $user_data;
			$_SESSION['user_data']['cena']= $rez;
			
		 
			$_SESSION['success_message'] = 'Внесено е ново осигурување на автомобил. Можете да го снимите во PDF формат и да го испечатите ';
			header('Location: vozila.php');
		}
		
		else
		{
			if(isset($validation_errors['no_user']))
			{
				$_SESSION['error_message'] = 'Не постои корисник со број на лична карта ' . $user_data['licna_karta'];
			}
				
			else
			{
				$_SESSION['validation_errors'] = $validation_errors;
				$_SESSION['error_message'] = 'Некои од внесените податоци не се правилни, проверете ги полињата за повеќе информации';
			}
				
			$_SESSION['user_data'] = $user_data;
			// Redirect back
			header('Location: vozila.php');
		}
		
	}

?>


<html>

<head>
  <title>Осигурување автомобили</title>
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
		<h1 style="text-align: center; margin-bottom:20px;">Осигурување на автомобили</h1>
		
		 <form action="vozila.php" method="post">
			
			<article>	
				<table cellspacing="10" id="osi_avto" class="tr_text" style = 'height:auto'>
					<tr><td align="left">Број на лична карта: </td><td><input type="text" name="licna_karta" class="tr_txt" value="<?php echo sprintifset($user_data['licna_karta'])?>"></td><td class="red"><?php echo printifset($validation_errors['licna_karta'][0])?></td></tr>
					<tr><td align="left">Регистерски број: </td><td><input type="text" name="reg_br" class="tr_txt" value="<?php echo sprintifset($user_data['reg_br'])?>"></td><td class="red"><?php echo printifset($validation_errors['reg_br'][0])?></td></tr>
					<tr><td align="left">Број на шасија: </td><td><input type="text" name="br_shasija" class="tr_txt" value="<?php echo sprintifset($user_data['br_shasija'])?>"></td><td class="red"><?php echo printifset($validation_errors['br_shasija'][0])?></td></tr> 
					<tr><td align="left">Марка: </td><td><input type="text" name="marka" class="tr_txt" value="<?php echo sprintifset($user_data['marka'])?>"></td><td class="red"><?php echo printifset($validation_errors['marka'][0])?></td></tr>
					<tr><td align="left">Тип: </td>
					<td>
		
						<select style="width:155px" name="tip"  class="tr_txt">
							<option value="0">Избери тип</option>
							<option value="Лимузина" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Лимузина') echo 'selected'?>>Лимузина</option>
							<option value="Купе" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Купе') echo 'selected'?>>Купе</option>
							<option value="Kараван" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Kараван') echo 'selected'?>>Караван</option>
							<option value="Кабриолет" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Кабриолет') echo 'selected'?>>Кабриолет</option>
							<option value="Спортски автомобил" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Спортски автомобил') echo 'selected'?>>Спортски автомобил</option>
						</select>		
								
					</td>
					<td class="red"><?php echo printifset($validation_errors['tip'][0])?></td>
					</tr>
					<tr><td align="left">Сила на моторот: </td><td><input type="text" name="sila" class="tr_txt" placeholder="KW" value="<?php echo sprintifset($user_data['sila'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['sila'][0])?></td></tr>
					<tr><td align="left">Работна зафатнина: </td><td><input type="text" name="zafatnina" class="tr_txt"  placeholder="cm3" value="<?php echo sprintifset($user_data['zafatnina'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['zafatnina'][0])?></td></tr>
					<tr><td align="left">Година на производство: </td><td><input type="text" name="godina" class="tr_txt" placeholder="ГГГГ-ММ-ДД" value="<?php echo sprintifset($user_data['godina'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['godina'][0])?></td></tr>
					<tr><td align="left">Боја: </td><td><input type="text" name="boja" class="tr_txt" value="<?php echo sprintifset($user_data['boja'])?>">
					</td><td class="red"><?php echo printifset($validation_errors['boja'][0])?></td></tr>
					<tr><td align="left"></td><td></td></tr>
					<tr><td align="left"></td><td></td></tr>
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