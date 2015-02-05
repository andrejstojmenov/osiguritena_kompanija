<?php
	// Validate input => text => username
	if(isset($_POST['username']))
	{
		$user_data['username']=$_POST['username'];
		if(empty($user_data['username']))
			$validation_errors['username'][]='Внесете корисничко име';
		if( !empty($user_data['username']) && (mb_strlen($user_data['username']) < 5))
			$validation_errors['username'][]='Корисничкото име треба да има минимум 5 карактери';
	}
	else
	{
		$validation_errors['username'][]="Полето 'username' не постои. WEIRD !!! ";
	}
	
	// Validate input => password => password
	if(isset($_POST['password']))
	{
		$password_pattern="/^(?=(?:.*?[0-9]){2})\w{6,}$/";
		$user_data['password']=$_POST['password'];
		if(empty($user_data['password']))
			$validation_errors['password'][]="Внесете лозинка ";
		if(!empty($user_data['password']) && (!preg_match($password_pattern,$user_data['password'])))
			$validation_errors['password'][]='Минимум 6 карактери од кои минимум 2 цифри';
	}
	else
	{
		$validation_errors['password'][]="Полето 'password' не постои. WEIRD !!!";
	}
	
	
	if(!isset($validation_errors))
	{
		
		//$result = mysql_query("SELECT * FROM `users`
		//						JOIN `roles`
		//						ON users.role_id = roles.id
		//					  ")
		//						or die(mysql_error());

		
		$result = mysql_query("SELECT * FROM `users` 
							   WHERE 
									`username` = '".$user_data['username'] ."' AND
									`password` = '".$user_data['password'] . "'") 
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
	
	
	
	
	
	
	
	
?>