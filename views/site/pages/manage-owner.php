<?php
/* @var $this SiteController */

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Manage Owner';
$this->params['breadcrumbs'][] = $this->title;
$con = Yii::$app->db;
$id  = Yii::$app->user->getId();

if($id > 0) {
	$mem_type = Yii::$app->db->createCommand('SELECT id, position_id, superuser, parent_id, username, email FROM users WHERE id='.$id.'')->queryAll();
    
	foreach ($mem_type as $key3 => $value3)
    { 
		$parent =  $value3['id'];
		$isadmin = $value3['superuser'];
		$uname = $value3['username'];
		$pos = $value3['position_id'];
		if($isadmin > 0) 
		{
	?>
       <div class="row-fluid">
		<div class="span12">
		   <h3 class="header">Manage Owners
                <span class="header-line"></span> 
           </h3>
		    </div>
		   </div>
		
		<div class="row-fluid">
		
		<div class="span12">
		
		</br>
		<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg'] == "success")
					{
						?>
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;margin-left: 53px;">Successfuly Deleted!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Delete Owners!</p>
						<?php
					}
				}
			?>
		</div>
		</div>
		<div class="row-fluid">
		
					<?php
					$ann = Yii::$app->db->createCommand('SELECT owner_id, first_name, middle_name, last_name, company, email, phone, property_id FROM owners')->queryAll();
					
					?>
			<div class="span12">	
	
				<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<a href="/tenant/index.php?r=site/page&view=add-owner" class="btn btn-success" style="border-radius: 4px;height: 37px!important;width: 130px;font-size: 18px;margin-right: 5px;margin-bottom: 13px;line-height: 1.5;">Create New</a>		
					
					<input type="hidden" name="r" value="site/page">
					
					<input type="hidden" name="view" value="manage-owner">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<button name="edit" class="btn btn-warning" style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px; float:right;">Edit</button>
					<button name="del" onclick="return confirm('Are you sure?')" class="btn btn-danger" style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px;float:right;">Delete</button>
					
					<table style="width:100%" class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Name</th> 
							<th>Email</th>
							<th>Phone</th>
							<th>Property</th>
						</tr>
						</thead>
					<?php
					foreach ($ann as $key => $value)
					{
						$user = $value['property_id'];
						$ann_user = Yii::$app->db->createCommand('SELECT id, name FROM property WHERE id='.$user.' AND user_id='.$id.'')->queryAll();
						
						foreach ($ann_user as $key2 => $value2)
										{ 
										 $property = $value2['name'];
										}
										
										
					?>
						
						  <tr>
							<td><input type="checkbox" name="check_list[]" value="<?php echo $value['owner_id']; ?>"></td>
							<td><?php echo $value['owner_id']; ?></td>
							<td><?php echo $value['last_name'].', '.$value['first_name'].' '.$value['middle_name'];?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<td><?php echo $property; ?></td>
						  </tr>

						<?php
					}
					?>
					</table>			
				</br>
				
				</form>
		</div>
     </div>		
		<?php
		}
		else {
			if($pos == 3) {
				?>

				<h1>Manage Owners</h1>
		<div class="row">
		<div class="col-md-12">
		<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg'] == "success")
					{
						?>
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;margin-left: 53px;">Successfuly Deleted!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Delete Owner!</p>
						<?php
					}
				}
			?>
		</div>
		</div>
					<?php
					$ann = Yii::$app->db->createCommand('SELECT owner_id, first_name, middle_name, last_name, company, email, phone, property_id FROM owners WHERE user_id='.$id.'')->queryAll();
					
					?>
					<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="r" value="site/page">
					
					<input type="hidden" name="view" value="manage-owner">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<table style="width:100%" class="table table-bordered table-hover">
						<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Name</th> 
							<th>Email</th>
							<th>Phone</th>
							<th>Property</th>
						</tr>
						</thead>
					<?php
					foreach ($ann as $key => $value)
					{
						$user = $value['property_id'];
						$ann_user = Yii::$app->db->createCommand('SELECT id, name FROM property WHERE id='.$user.' AND user_id='.$id.'')->queryAll();
						
						foreach ($ann_user as $key2 => $value2)
										{ 
										 $property = $value2['name'];
										}
										
										
					?>
						
						  <tr>
							<td><input type="checkbox" name="check_list[]" value="<?php echo $value['owner_id']; ?>"></td>
							<td><?php echo $value['owner_id']; ?></td>
							<td><?php echo $value['last_name'].', '.$value['first_name'].' '.$value['middle_name'];?></td>
							<td><?php echo $value['email']; ?></td>
							<td><?php echo $value['phone']; ?></td>
							<td><?php echo $property; ?></td>
						  </tr>

						<?php
					}
					?>
					</table>			
				</br>
				<button name="edit">Edit</button>
				<button name="del" onclick="return confirm('Are you sure?')" >Delete</button>
				</form>
				<a href="/tenant/index.php?r=site/page&view=add-owner"><button >Create New</button></a>
		</br>
				<?php
			} 
		}
	}
	if(isset($_GET['check_list']) && isset($_GET['del']))
	{	
		foreach($_GET['check_list'] as $selected) {
			$command = Yii::$app->db->createCommand();
			$sql 	 = $command->delete('owners', 'owner_id=:id', array(
						':id'		=> $selected
						));
		}
		if(!$sql)
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=manage-owner&msg=failed")->send();
		}
		else
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=manage-owner&msg=success")->send();
		} 
	}
	if(isset($_GET['check_list']) && isset($_GET['edit'])) 
	{	
		foreach($_GET['check_list'] as $selected) {
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=edit-owner&check_list=".$selected."")->send();
		}
	}
}
else {
	header('Location: /tenant/index.php?r=user/login');	
}
?>
<style>
th {
	text-align:left;
}

.header{
	font-weight:bold;
}
</style>