<?php 

function verify_logged()
{
	$user  = Yii::app()->user->getId();

	if(!isset($user))
	{
		return false;
	}
	else
	{
		return true;
	}
	
}

?>