<!DOCTYPE html> 
<?php require('initialize.php'); ?>
<?php $auth->user(); ?>

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
	
	$cena = 0;
	$broj = 0;
	$user_id = $_SESSION['user']['id'];
	$results_avto = mysql_query("SELECT avtomobili.cena , avtomobili.id FROM `avtomobili`
								JOIN `users`
								ON avtomobili.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_avto))
	{
	
		$osi[$broj]['tip'] = 'Осигурување на автомобил';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=avtomobili&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_delovni = mysql_query("SELECT delovni.cena , delovni.id FROM `delovni`
								JOIN `users`
								ON delovni.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_delovni))
	{
		$osi[$broj]['tip'] = 'Осигурување на деловен простор';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=delovni&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_kuki = mysql_query("SELECT kuki.cena , kuki.id FROM `kuki`
								JOIN `users`
								ON kuki.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_kuki))
	{
		$osi[$broj]['tip'] = 'Осигурување на куќа';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=kuki&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_motor = mysql_query("SELECT motorcikli.cena , motorcikli.id FROM `motorcikli`
								JOIN `users`
								ON motorcikli.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_motor))
	{
		$osi[$broj]['tip'] = 'Осигурување на мотор';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=motorcikli&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_patnicko = mysql_query("SELECT patnicki.cena , patnicki.id FROM `patnicki`
								JOIN `users`
								ON patnicki.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_patnicko))
	{
		$osi[$broj]['tip'] = 'Патничко осигурување';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=patnicki&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_stanovi = mysql_query("SELECT stanovi.cena , stanovi.id FROM `stanovi`
								JOIN `users`
								ON stanovi.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_stanovi))
	{
		$osi[$broj]['tip'] = 'Осигурување на стан';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=stanovi&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	$results_tovarni = mysql_query("SELECT tovarni.cena , tovarni.id FROM `tovarni`
								JOIN `users`
								ON tovarni.user_id = users.id
								WHERE users.id = $user_id
							  ")
								or die(mysql_error());
								
	while( $result = mysql_fetch_assoc($results_tovarni))
	{
		$osi[$broj]['tip'] = 'Осигурување на товарни возила';
		$osi[$broj]['cena'] = $result['cena'];
		$osi[$broj]['delete'] = 'izbrisi_osi.php?tip=tovarni&id='.$result['id'];
		$cena += $osi[$broj]['cena'];
		$broj++;
	}
	
	//$user = mysql_fetch_assoc($results_avto);

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
			   <li><a href='logout.php'><span>Одјави се</span></a></li>
			</ul>
		</div>	
      </nav>
    </header>
    
    <div id="image_container" class="center"> 
           <img width="940" height="250" src="images/user.jpg"  />
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
		<h1 style="text-align: center; margin-bottom: 20px;">Добродојдовте <?php echo $_SESSION['user']['ime']?></h1>
		
		
		<?php if(isset($osi)){ ?>
		<table cellspacing="10" id="table_user" class="tr_text" style = 'height:auto'>
		<tr><th>Тип на осигурување</th><th>Цена</th><th>Избриши</th></tr>
			<?php foreach($osi as $osig){ ?>
				<tr>
					<td align="left" style="padding-left:10px;"><?php echo $osig['tip']?> </td>
					<td align="left" style="text-align:center; padding:0 10px;"><?php echo $osig['cena']?> </td>
					<td align="left" style="border:none"><a href="<?php echo $osig['delete']?>">Избриши</a></td>
				</tr>
				
			<?php }?>
			<tr><td colspan="3" style="text-align:right; border:none; padding-right: 100px;">Вкупна цена: <?php echo $cena?></td></tr>
		</table>	
		<?php }?>
		  
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