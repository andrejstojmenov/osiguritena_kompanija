<?php

class Auth
{
	public function __construct() { }
	
	public function check()
	{
		if(isset($_SESSION['user']))
			return true;
		
		else
			return false;
	}
	
	public function user()
	{
		
		if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 2)
			return;
		
		else
		{
			$_SESSION['error_message'] = 'Немате пристап до страницата. Треба да се најавите';
			header('Location: login.php');
			die();
		}
		
	}
	
	public function admin()
	{
	
		if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1)
			return;
	
		else
		{
			$_SESSION['error_message'] = 'Најавете се како администратор за да имате пристап до страницата';
			header('Location: login.php');
			die();
		}
	
	}

}