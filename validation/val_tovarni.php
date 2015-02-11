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

// Validate input => text => reg_br
if(isset($_POST['reg_br']))
{
	$user_data['reg_br']=$_POST['reg_br'];
	if(empty($user_data['reg_br']))
		$validation_errors['reg_br'][]='Внесете регистерски број';
	if(!empty($user_data['reg_br']) && (!is_numeric($user_data['reg_br'])))
		$validation_errors['reg_br'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['reg_br'][]="Полето 'reg_br' не постои. WEIRD !!! ";
}

// Validate input => text => br_shasija
if(isset($_POST['br_shasija']))
{
	$user_data['br_shasija']=$_POST['br_shasija'];
	if(empty($user_data['br_shasija']))
		$validation_errors['br_shasija'][]='Внесете број на шасија';
}
else
{
	$validation_errors['br_shasija'][]="Полето 'br_shasija' не постои. WEIRD !!! ";
}

// Validate input => text => marka
if(isset($_POST['marka']))
{
	$user_data['marka']=$_POST['marka'];
	if(empty($user_data['marka']))
		$validation_errors['marka'][]='Внесете марка';
}
else
{
	$validation_errors['marka'][]="Полето 'marka' не постои. WEIRD !!! ";
}

// Validate input => text => sila
if(isset($_POST['sila']))
{
	$user_data['sila']=$_POST['sila'];
	if(empty($user_data['sila']))
		$validation_errors['sila'][]='Внесете сила на моторот';
	if(!empty($user_data['sila']) && (!is_numeric($user_data['sila'])))
		$validation_errors['sila'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['sila'][]="Полето 'sila' не постои. WEIRD !!! ";
}

// Validate input => text => zafatnina
if(isset($_POST['zafatnina']))
{
	$user_data['zafatnina']=$_POST['zafatnina'];
	if(empty($user_data['zafatnina']))
		$validation_errors['zafatnina'][]='Внесете работна зафатнина';
	if(!empty($user_data['zafatnina']) && (!is_numeric($user_data['zafatnina'])))
		$validation_errors['zafatnina'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['zafatnina'][]="Полето 'zafatnina' не постои. WEIRD !!! ";
}

// Validate input => text => godina
if(isset($_POST['godina']))
{
	$user_data['godina']=$_POST['godina'];
	if(empty($user_data['godina']))
		$validation_errors['godina'][]='Внесете година на производство';
}
else
{
	$validation_errors['godina'][]="Полето 'godina' не постои. WEIRD !!! ";
}

// Validate input => text => boja
if(isset($_POST['boja']))
{
	$user_data['boja']=$_POST['boja'];
	if(empty($user_data['boja']))
		$validation_errors['boja'][]='Внесете боја';
}
else
{
	$validation_errors['boja'][]="Полето 'boja' не постои. WEIRD !!! ";
}

// Validate input => select => tip
if(isset($_POST['tip']))
{
	//var_dump();
	$user_data['tip']=$_POST['tip'];
	if(empty($user_data['tip']))
		$validation_errors['tip'][]='Изберете тип на возило';
}
else
{
	$validation_errors['tip'][]="Полето 'tip' не постои. WEIRD !!! ";
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
