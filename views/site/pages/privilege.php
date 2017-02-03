<?php
?>
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

<?php
function update_privilege($set, $conx)
{
	
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->update('users_priv', 
					array('position_active'	=> $conx), "id=:ids", array(':ids'=> $set)
				 );

	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=privilege&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=privilege&msg=success");
	}
}

function retrieve_config_str($config)
{

	$x = "";

	foreach ($config as $key => $value)
	{
		$x = $x.",".$value;
	}

	return $x;
}

if(isset($_POST['submit']))
{
	//print_r($_GET['condition']);
	$i = 0;
	foreach ($_POST['settings_id'] as $key => $value){

		$settings_id = $value;

		$settings = $_POST['settings_name'];
		$settings = $settings[$i];

		if(isset($_POST[$settings]))
		{
		$config = $_POST[$settings];
		$config = retrieve_config_str($config);

		update_privilege($settings_id, $config);

		}
		else
		{
			update_privilege($settings_id, "");
		}

		$i++;		
	}
}

?>

<?php

	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

function check_user($id)
{
	if(Yii::$app->user->isGuest)
	{
		header('Location: ?r=user/login');
	}
	else
	{
	$user = Yii::$app->db->createCommand('SELECT superuser, privilege_id FROM users WHERE id='.$id.'')->queryAll();
    
    $user = $user[0];

    //print_r($user);
    return $user;
	}
	
}

function retrieve_config($id)
{
	$config = Yii::$app->db->createCommand('SELECT id, user_id, settings_name, position_active FROM users_priv WHERE user_id='.$id.'')->queryAll();
    

    return $config;
}



function check_value($active, $position)
{
	$active = explode(",", $active);
	$result = false;

	foreach ($active as $key => $value)
	{
		if($value == $position)
		{
			$result = true;
		}
	}

	if($result == true)
	{
		return "checked";
	}
	else
	{
		return "";
	}

}

?>
 
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Privilege Settings For User Types</h2>
				<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
				<li><a href="#">Settings 1</a>
				</li>
				<li><a href="#">Settings 2</a>
				</li>
				</ul>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<?php

			$user = check_user($id); 

			if($user['superuser'] == 1)
			{
			if($user['privilege_id'] != 0)
			{
			$configuration = retrieve_config($id);
			?>
			<form method="POST">
				<input type="hidden" name="r" value="site/page">
				<input type="hidden" name="view" value="privilege">
			<table class="table table-striped">
			<tr>
				<th>Condition</th>
				<th>Bldg. Mgr</th>
				<th>Asst. Mgr</th>
				<th>Owner</th>
				<th>Asst. Owner</th>
				<th>Tenant</th>
				<th>Co Tenant</th>
				<th>Broker</th>
				<th>Asst. Broker</th>
			</tr>
			<?php 
			foreach ($configuration as $key => $value)
			{
			?>
			<tr>
				<td>
					<?php echo $value['settings_name'];?>
					<input type="hidden" name="settings_id[]" value="<?php echo $value['id'];?>">
					<input type="hidden" name="settings_name[]" value="<?php echo $value['settings_name'];?>">
				</td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="3"  <?php echo check_value($value['position_active'], 3);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="4"  <?php echo check_value($value['position_active'], 4);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="5" <?php echo check_value($value['position_active'], 5);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="6" <?php echo check_value($value['position_active'], 6);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="7" <?php echo check_value($value['position_active'], 7);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="8" <?php echo check_value($value['position_active'], 8);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="9" <?php echo check_value($value['position_active'], 9);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
				<td><input type="checkbox" name="<?php echo $value['settings_name'];?>[]" value="10" <?php echo check_value($value['position_active'], 10);?> data-toggle="toggle" data-on="YES" data-off="NO" data-onstyle="success" data-offstyle="danger"></td>
			</tr>
			<?php	
			}

			?>

			</table>
			</br>
			<input type="submit" class="btn btn-primary" value="Save" name="submit">
			</form>
			<?php

			}

			}

			?>
			</div>
		</div>
	</div>
</div>

</div>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!--
<input type="checkbox" data-toggle="toggle" data-on="Allow" data-off="Don't Allow">
-->