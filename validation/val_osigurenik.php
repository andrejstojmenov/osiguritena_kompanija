<?php

// Validate input => text => ime
if(isset($_POST['ime']))
{
	$user_data['ime']=$_POST['ime'];
	if(empty($user_data['ime']))
		$validation_errors['ime'][]='Внесете име';
}
else
{
	$validation_errors['ime'][]="Полето 'ime' не постои. WEIRD !!! ";
}

// Validate input => text => ime
if(isset($_POST['ime']))
{
	$user_data['ime']=$_POST['ime'];
	if(empty($user_data['ime']))
		$validation_errors['ime'][]='Внесете презиме';
}
else
{
	$validation_errors['ime'][]="Полето 'ime' не постои. WEIRD !!! ";
}

// Validate input => text => prezime
if(isset($_POST['prezime']))
{
	$user_data['prezime']=$_POST['prezime'];
	if(empty($user_data['prezime']))
		$validation_errors['prezime'][]='Внесете презиме';
}
else
{
	$validation_errors['prezime'][]="Полето 'prezime' не постои. WEIRD !!! ";
}

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

// Validate input => text => adresa
if(isset($_POST['adresa']))
{
	$user_data['adresa']=$_POST['adresa'];
	if(empty($user_data['adresa']))
		$validation_errors['adresa'][]='Внесете адреса';
}
else
{
	$validation_errors['adresa'][]="Полето 'adresa' не постои. WEIRD !!! ";
}

// Validate input => text => licna_karta
if(isset($_POST['telefon']))
{
	$user_data['telefon']=$_POST['telefon'];
	if(empty($user_data['telefon']))
		$validation_errors['telefon'][]='Внесете телефон';
	if(!empty($user_data['telefon']) && (!is_numeric($user_data['telefon'])))
		$validation_errors['telefon'][]='Полето може да содржи само цифри';
}
else
{
	$validation_errors['telefon'][]="Полето 'telefon' не постои. WEIRD !!! ";
}
