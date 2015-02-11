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

// Validate input => text => period
if(isset($_POST['period']))
{
	$user_data['period']=$_POST['period'];
	if(empty($user_data['period']))
		$validation_errors['period'][]='Внесете период';
	if(!empty($user_data['period']) && (!is_numeric($user_data['period'])))
		$validation_errors['period'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['period'][]="Полето 'period' не постои. WEIRD !!! ";
}

// Validate input => text => drzava
if(isset($_POST['drzava']))
{
	$user_data['drzava']=$_POST['drzava'];
	if(empty($user_data['drzava']))
		$validation_errors['drzava'][]='Внесете држава';
}
else
{
	$validation_errors['drzava'][]="Полето 'drzava' не постои. WEIRD !!! ";
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