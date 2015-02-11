<?php

// Validate input => text => licna_karta
if(isset($_POST['licna_karta']))
{
	$user_data['licna_karta']=$_POST['licna_karta'];
	if(empty($user_data['licna_karta']))
		$validation_errors['licna_karta'][]='Внесете лична карта';
	if(!empty($user_data['licna_karta']) && (!is_numeric($user_data['licna_karta'])))
		$validation_errors['licna_karta'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['licna_karta'][]="Полето 'licna_karta' не постои. WEIRD !!! ";
}

// Validate input => text => povrsina
if(isset($_POST['povrsina']))
{
	$user_data['povrsina']=$_POST['povrsina'];
	if(empty($user_data['povrsina']))
		$validation_errors['povrsina'][]='Внесете површина';
	if(!empty($user_data['povrsina']) && (!is_numeric($user_data['povrsina'])))
		$validation_errors['povrsina'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['povrsina'][]="Полето 'povrsina' не постои. WEIRD !!! ";
}

// Validate input => text => adresa
if(isset($_POST['adresa']))
{
	$user_data['adresa']=$_POST['adresa'];
	if(empty($user_data['adresa']))
		$validation_errors['adresa'][]='Внесете број на адреса';
}
else
{
	$validation_errors['adresa'][]="Полето 'adresa' не постои. WEIRD !!! ";
}


// Validate input => select => grad
if(isset($_POST['grad']))
{
	//var_dump();
	$user_data['grad']=$_POST['grad'];
	if(empty($user_data['grad']))
		$validation_errors['grad'][]='Изберете град';
}
else
{
	$validation_errors['tip'][]="Полето 'grad' не постои. WEIRD !!! ";
}

// Validate input => select => gradba
if(isset($_POST['gradba']))
{
	//var_dump();
	$user_data['gradba']=$_POST['gradba'];
	if(empty($user_data['gradba']))
		$validation_errors['gradba'][]='Изберете вид на градба';
}
else
{
	$validation_errors['gradba'][]="Полето 'gradba' не постои. WEIRD !!! ";
}


if(!isset($validation_errors))
{

	$result = mysql_query("SELECT * FROM `users`
			WHERE
			`licna_karta` = '".$user_data['licna_karta'] ."'")
			or die(mysql_error());

	if(mysql_num_rows($result) == 0)
	{
		$validation_errors['no_user']= 'true';
	}

	else
	{
		$user = mysql_fetch_assoc($result);
	}
}