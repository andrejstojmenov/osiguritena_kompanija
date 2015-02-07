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
		
		$cena0=0;  
		$cena1=0;  
		$cena2=0;  
		$rez=0;
		$power=$_POST["sila"];
		$zaf=$_POST["zafatnina"];
		$tov_voz=$_POST["tip"];	
		
				switch($tov_voz)
				{
				case '0':$cena0=0; break;
				case 'Автобус':$cena0=8500; break;
				case 'Камион':$cena0=7500; break;
				case 'Комбе':$cena0=3800; break;
				case 'Камион со приколица':$cena0=9000; break;
				
				}	
			if($power <= 100 && $power!=' ' && $power!=0){
			$cena1=1200;
			
			}
			else if($power > 100 && $power <=250 && $power!=' ')
			{
			$cena1=1850;
	
			}
			else if($power > 250 && $power!=' ')
			{
			$cena1=2250;
	
			}
			else{
			$cena1=0;
			}
			if($zaf <=1500 && $zaf!=' ' && $zaf!=0){
			$cena2=1350;
		
			}
			else if($zaf > 1500 && $zaf <=3000 && $zaf!=' ')
			{
			$cena2=1750;
		
			}
			else if($zaf >3000 && $zaf <=4500 && $zaf!=' ')
			{
			$cena2=2250;
		
			}
			else if($zaf > 4500 && $zaf!=' ')
			{
			$cena2=2850;		
			}
			else
			{
			$cena2=0;			
			}
			$rez=$cena0+$cena1+$cena2;
			echo $rez;
		
		
		
		$sql="INSERT INTO `tovarni`(`licna_karta`, `reg_br`,`br_shasija`,`marka`,`tip`,`sila`,`zafatnina`,`godina`,`boja`,`cena`)
			 VALUES
			 ('$_POST[licna_karta]','$_POST[reg_br]','$_POST[br_shasija]','$_POST[marka]','$_POST[tip]','$_POST[sila]','$_POST[zafatnina]','$_POST[godina]','$_POST[boja]',$rez)";	

			mysql_query("SET NAMES utf8");
			mysql_query($sql) or die(mysql_error());
		 
			$_SESSION['user_data']['licna_karta'] = $_POST['licna_karta'];
			$_SESSION['user_data']['reg_br'] = $_POST['reg_br'];
			$_SESSION['user_data']['br_shasija'] = $_POST['br_shasija'];
			$_SESSION['user_data']['marka'] = $_POST['marka'];
			$_SESSION['user_data']['tip'] = $_POST['tip'];
			$_SESSION['user_data']['sila'] = $_POST['sila'];
			$_SESSION['user_data']['zafatnina'] = $_POST['zafatnina'];
			$_SESSION['user_data']['godina'] = $_POST['godina'];
			$_SESSION['user_data']['boja'] = $_POST['boja'];
			$_SESSION['user_data']['cena'] = $rez;
			
		 
			$_SESSION['success_message'] = 'Внесено е ново осигурување на товарно возило';
			header('Location: tovarni.php');
		
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
					 <li class='has-sub'><a href='#'><span>Патничко осигурување</span></a>
					
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
		<h2 style="text-align: center">Осигурување на товарни возила</h2>
		
		 <form action="tovarni.php" method="post">
			
			<article>	
				<table cellspacing="10" id="osi_avto">
					<tr><td align="left">Број на лична карта: </td><td><input type="text" name="licna_karta" value="<?php echo sprintifset($user_data['licna_karta'])?>"></td></tr>
					<tr><td align="left">Регистерски број: </td><td><input type="text" name="reg_br" value="<?php echo sprintifset($user_data['reg_br'])?>"></td></tr>
					<tr><td align="left">Број на шасија: </td><td><input type="text" name="br_shasija" value="<?php echo sprintifset($user_data['br_shasija'])?>"></td></tr> 
					<tr><td align="left">Марка: </td><td><input type="text" name="marka" value="<?php echo sprintifset($user_data['marka'])?>"></td></tr>
					<tr><td align="left">Тип: </td>
					<td>
						<select style="width:155px" name="tip" >
							<option value="0">Избери тип</option>
							<option value="Автобус" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Автобус') echo 'selected'?>>Автобус</option>
							<option value="Камион" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Камион') echo 'selected'?>>Камион</option>
							<option value="Комбе" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Комбе') echo 'selected'?>>Комбе</option>
							<option value="Камион со приколица" <?php if(isset($user_data['tip']) && $user_data['tip'] == 'Камион со приколица') echo 'selected'?>>Камион со приколица</option>
						</select>		
					</td>
					</tr>
					<tr><td align="left">Сила на моторот: </td><td><input type="text" name="sila" value="<?php echo sprintifset($user_data['sila'])?>">
					</td><td align="left"><font color="grey" >KW</font></td></tr>
					<tr><td align="left">Работна зафатнина: </td><td><input type="text" name="zafatnina" value="<?php echo sprintifset($user_data['zafatnina'])?>">
					</td><td align="left"><font color="grey">cm<sup>3</sup></font></td></tr>
					<tr><td align="left">Година на производство: </td><td><input type="text" name="godina" value="<?php echo sprintifset($user_data['godina'])?>">
					</td><td align="left"><font color="grey">ГГГГ-ММ-ДД</td></tr>
					<tr><td align="left">Боја: </td><td><input type="text" name="boja" value="<?php echo sprintifset($user_data['boja'])?>">
					</td></tr>
					<tr><td align="left"></td><td></td></tr>
					<tr><td align="left"></td><td></td></tr>
					<tr><td align="right">Цена: <input type="text" name="cena" style="width:50px" disabled="true" value="<?php echo sprintifset($user_data['cena'])?>">
					</td><td align="left"><font color="grey">ден.</td></tr>
					<tr><td align="right"><input type="submit" name="presmetaj" value="Пресметај" style="width:100px" target="_blank"></td></tr>
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