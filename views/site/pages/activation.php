<?php

use yii\helpers\Html;
use yii\db\Query;
use yii\swiftmailer\Mailer;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
$msg = "";

if(isset($_GET['key']) && !empty($_GET['key']))
{
	$activ = $_GET['key'];
	$query = Yii::$app->db->createCommand("SELECT id, username FROM users WHERE activkey='$activ'")->queryAll();

	if(!empty($query))
	{
		$x  = $query[0];
		$n  = $x['username'];
		$id = $x['id']; 

		$msg = "<h2>Congratulations <b>".$n."</b> your account is now Activated!</br></br> 
		  You may now login using your email and password <a href='http://45.32.35.90/tenant2/web/index.php?r=site/login'><b>here</b></a>. ";

		$command = Yii::$app->db->createCommand();
		$sql 	 = $command->update('users', array('status' => 1), 'id=:id', array(':id'=> $id));
		if(!$sql->execute()){

			$msg = "Error Activation!";
		}
	}
}

?>

<?php 
echo $msg;
?>