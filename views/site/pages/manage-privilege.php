<style>
.toggle.btn {
    min-width: 32px!important;
    min-height: 21px!important;
	width: 32px!important;
    height: 21px!important;
}
.toggle-on, .toggle-off {
    line-height: 23px!important;
}
.toggle-on {
    display: inline-block;
    padding: 4px 45px 4px 12px!important;
}
.btn{
	border-radius: 8%;
}

.row-fluid {
    width: 85%;
    margin-left: auto;
    margin-right: auto;
}

</style>
<?php
/* @var $this SiteController */

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Privilege Setting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
	<div class="span12">
		   <h3 class="header">Manage Privileges
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
<?php

$con = Yii::$app->db;
$id  = Yii::$app->user->getId();

function check_user($id)
{
	if(Yii::$app->user->isGuest)
	{
		header('Location: index.php');
	}
	else
	{

	$command = Yii::$app->db->createCommand();
	$sql = $command->update('users_priv', array(
    				 'position_active'=> ':settings',
    				  ),
					 array('user_id' => ':id', 'condition' => ':name'), array(':id'	=> $id, ':name' => $name, ':settings' => $settings)
    				 );


    $user = $user[0];

    //print_r($user);
    return $user;
    }
}

function retrieve_config($privilege_id)
{
	$config = Yii::$app->db->createCommand('SELECT id, config FROM users_privilege WHERE user_id='.$privilege_id.'')->queryAll();
   

    $config = $config[0];
    $config = $config['config'];

    return $config;
}

function check_value($value)
{
	if($value == "true")
	{
		$value = "checked";
		return $value;
	}
	else
	{
		$value = "";
		return "";
	}
}

?>
  
<?php

	$user = check_user($id); 

	if($user['superuser'] == 1)
	{
		if($user['privilege_id'] != 0)
		{
			$conf 	   = retrieve_config($user['privilege_id']);
			$conf 	   = json_decode($conf);
			//$conf 	   = json_encode($conf);
			//var_dump($conf);
			

			//var_dump($conf);
			//$pose = $conf->settings;
			//print_r($config);
			$pose = $conf->position;
			//print_r($conf->position);
			//return;
			?>
			<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>"><table class="table table-striped">
			<input type="hidden" value="<?php $user['privilege_id']?>">
			<?php
        
			foreach ($pose as $key => $value)
			{

				$setting = $value->settings;
				$pose_id = $value->id;
				
				?>
                
		        
				<tr style="height: 46px;">
					<th style="font-size: 18px;"><?php echo $value->title; ?></th>
					<th style="font-size: 18px;">Action</th>
				</tr>

				<?php

				foreach ($setting as $key => $value)
				{
					$cbox_name = $pose_id."-".$value->name;
					?>
				<tr>
					<td style="b">
						<?php echo $value->name;?>
					</td>
					<td style="">
						<input type="checkbox" name="<?php echo $cbox_name;?>" <?php echo check_value($value->value);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger">
					</td>
				</tr>
				
					<?php
				}
			}

			?>
			
			
			</table>
			<input type="submit" value="Save" style="width:120px; float:right;font-weight: bold; padding: 7px;"></form><?php
		}
	}

?>
</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<?php

?>
<!--
<input type="checkbox" data-toggle="toggle" data-on="Allow" data-off="Don't Allow">
-->