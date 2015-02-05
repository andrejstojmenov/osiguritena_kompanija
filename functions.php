<?php 

function printifset(&$var)
{
	if(isset($var))
		return $var;
	return false;
}

function sprintifset(&$var)
{
	if(isset($var))
		return htmlentities($var);
	return false;
}		

