<?php
//require ("/var/www/html/tenant/themes/hebo/views/site/pages/logged-privilege.php");
?>

<?php 
	
  $user  = Yii::$app->user->getId();
  if(!isset($user))
  {
  	$this->redirect("?r=user/login");
  }

?>

<?php
/* @var $this SiteController */

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Manage Staff';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.row-fluid {
    width: 85%;
    margin-left: auto;
    margin-right: auto;
}
.container {
    padding-left: 0px!important;
}
.header{
	font-weight:bold;
}
</style>

<?php
function retrieve_related_users()
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$users = Yii::$app->db->createCommand('SELECT id, username, firstname, lastname FROM users JOIN profiles ON users.id = profiles.user_id WHERE parent_id='.$logged_id.'')->queryAll();
    

    return $users;
}

function retrieve_positions()
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$p = Yii::$app->db->createCommand('SELECT position_id, position_name FROM positions')->queryAll();
   
    //print_r($positions);
    return $p;
}

function retrieve_staffs()
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$staffs = Yii::$app->db->createCommand('SELECT id, username, firstname, lastname, position_id FROM users JOIN profiles ON users.id = profiles.user_id WHERE parent_id='.$logged_id.'')->queryAll();
    

    return $staffs;
}

function retrieve_user_position($p)
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$p = Yii::$app->db->createCommand('SELECT position_id, position_name FROM positions WHERE position_id='.$p.'')->queryAll();
    

    //print_r($positions);
    //$p = $p[0];
    //$p = $p['position_name'];
    if(!empty($p))
    {
	    foreach ($p as $key => $value)
		    {

		    	$position_name = $value['position_name'];

		    	return $position_name;
		    }
    }
    else
    {
    	return "Not yet Assigned";
    }


}

function update_user_position($user_id, $post)
{
	$con = Yii::$app->db;

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->update('users', 
					array('position_id'	=> $post), "id=:ids", array(':ids'=> $user_id)
				 );
	if(!$sql)
	{
		//header("Location: index.php?r=site/page&view=manage-staff&msg=failed");
	}
	else
	{
		//header("Location: index.php?r=site/page&view=manage-staff&msg=success");
	}
}
/*-------------------*/
/*-------------------*/
/*-------------------*/
if(isset($_POST['save']))
{
	update_user_position($_POST['user'], $_POST['position']);
	print_r($_POST['user'], $_POST['position']);
}

?>

<div class="row">
	
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
		<form method="POST">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<div class="x_panel">
			<div class="x_title">
				<h2>Manage Staff</h2>
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
			<div class="row">
			<br/>
			<label>Select a Staff...</label>
			<select id="user-list" name="user" class="form-control">
				<option value="">Select...</option>
				<?php
					$users = retrieve_related_users(); 
					foreach ($users as $key => $value)
					{
						?>
							<option value="<?php echo $value['id']?>"><?php echo $value['firstname']." ".$value['lastname'];?></option>
						<?php
					}
				?>
			</select>
			<br/>

			<label>Select Designation:</label>
			<select id="position-list" name="position" class="form-control">
			<option value="">Select...</option>
			<?php
				$p = retrieve_positions();
		 
				foreach ($p as $k => $v)
				{
					?>
						<option value="<?php echo $v['position_id'];?>"><?php echo $v['position_name'];?></option>
					<?php
				}
			?>
			</select>

			<br/>

			<input type="submit" value="Save" name="save" class="btn btn-primary">
			</div>
			</div>
		</div>
		</form>
	</div>
	
	

	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
		<div class="x_panel">
			<div class="x_title">
				<h2>Staff and Designation</h2>
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
				
				<div class="x_content">
				<br/>
				<table class="table table-striped">
				<tr>
					<th>Name</th><th>Designation</th>
				</tr>
				<?php
					$staffs = retrieve_staffs();

					foreach ($staffs as $key => $value)
					{
						?>
							<tr>
								<td><?php echo $value['firstname']." ".$value['lastname'];?></td>
								<td><?php echo retrieve_user_position($value['position_id']);?></td>
							</tr>
						<?php
					}
				?>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>