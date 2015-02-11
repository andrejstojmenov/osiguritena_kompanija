<?php 
	require 'initialize.php';
	$tabela = $_GET['tip'];
	$id = $_GET['id'];
	
	$result = mysql_query("DELETE FROM $tabela
								WHERE id = $id 
							  ")
							or die(mysql_error());
	
	$_SESSION['success_message'] = 'Успешно е избришано осигурувањето';
							
	header('Location: profile_user.php');

?>