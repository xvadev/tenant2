<?php
/* @var $this SiteController */
$this->title = 'Manage Building Manager';
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
		   <h3 class="header">Manage Building Manager
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
		</div>
		
		<div class="span12">
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
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Delete!</p>
						<?php
					}
				}
			?>
		</div>
		</div>
		<div class="row-fluid">
		
					<?php
					$ann = Yii::$app->db->createCommand('SELECT bmanager_id, first_name, middle_name, last_name, company, email, phone, property_id FROM bmanager')->queryAll();
					
					?>
					<div class="span12">
					
					<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<a href="/tenant/index.php?r=site/page&view=add-bmanager" class="btn btn-success" style="border-radius: 4px;height: 26px!important;width: 130px;font-size: 18px;margin-right: 5px;margin-bottom: 13px;line-height: 1.5;">Create New</a>		
<button name="edit" class="btn btn-warning" style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px; float:right;">Edit</button>
				<button name="del" onclick="return confirm('Are you sure?')" class="btn btn-danger" style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px;float:right;">Delete</button>
					<input type="hidden" name="r" value="site/page">
					<input type="hidden" name="view" value="manage-bmanager">
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
							<td><input type="checkbox" name="check_list[]" value="<?php echo $value['bmanager_id']; ?>"></td>
							<td><?php echo $value['bmanager_id']; ?></td>
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
		</br>
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
					$ann = Yii::$app->db->createCommand('SELECT bmanager_id, first_name, middle_name, last_name, company, email, phone, property_id FROM bmanager WHERE user_id='.$id.'')->queryAll();
					
					?>
					<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="r" value="site/page">
					<input type="hidden" name="view" value="manage-bmanager">
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
						$ann_user = Yii::$app->db->createCommand()
						->select('id, name')
						->from('property')
						->where('id='.$user.' AND user_id='.$id)
						->queryAll();
						foreach ($ann_user as $key2 => $value2)
										{ 
										 $property = $value2['name'];
										}
										
										
					?>
						
						  <tr>
							<td><input type="checkbox" name="check_list[]" value="<?php echo $value['bmanager_id']; ?>"></td>
							<td><?php echo $value['bmanager_id']; ?></td>
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
				<button name="edit" class="btn-primary">Edit</button>
				<button name="del" onclick="return confirm('Are you sure?')" class="btn-warning">Delete</button>
				</form>
				<a href="/tenant/index.php?r=site/page&view=add-owner"><button class="btn-primary">Create New</button></a>
		</br>
				<?php
			} 
		}
	}
	if(isset($_GET['check_list']) && !empty($_GET['check_list'] && isset($_GET['del'])))
	{	
		foreach($_GET['check_list'] as $selected) {
			$command = Yii::$app->db->createCommand();
			$sql 	 = $command->delete('bmanager', 'bmanager_id=:id', array(
						':id'		=> $selected
						));
		}
		if(!$sql)
		{
			header("Location: index.php?r=site/page&view=manage-bmanager&msg=failed");
		}
		else
		{
			header("Location: index.php?r=site/page&view=manage-bmanager&msg=success");
		} 
	}
	if(isset($_GET['check_list']) && !empty($_GET['check_list'] && isset($_GET['edit'])) )
	{	
		foreach($_GET['check_list'] as $selected) {
			header("Location: index.php?r=site/page&view=edit-bmanager&check_list=".$selected."");
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