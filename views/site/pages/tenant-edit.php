<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::$app->name . ' - addtenant';

$this->title = 'Edit Tenant';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$con = Yii::$app->db;
$id  = Yii::$app->user->id;

$tenant_id = '';
$first_name = '';
$middle_name ='';
$last_name = '';
$t_company = '';
$tenant_email = '';
$tenant_phone =  '';
$tenant_gender = '';
$tenant_dob = '';
$t_pid = '';

//if($id > 0) {//check if the user is admin

if(isset($_GET['fname']) && !empty($_GET['fname']) ){//execution if editing is submit
	$con = Yii::$app->db;
	$id  = Yii::$app->user->id;

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->update('tenant', array(
					 'user_id'		=> $id,
    				 'first_name'	=> $_GET['fname'],
					 'last_name'	=> $_GET['lname'],
					 'middle_name'	=> $_GET['mname'],
    				 'company'		=> $_GET['t_cname'],
    				 'dob'			=> $_GET['t_dob'],
    				 'gender' 		=> $_GET['t_gender'],
    				 'email'		=> $_GET['t_email'],
    				 'phone'		=> $_GET['t_phone'],
					 'property_id'		=> $_GET['t_property']),
					 'tenant_id=:id', array(':id'	=> $_GET['t_pcid'])
					 );

	if(!$sql->execute()){
		
		header("Location: index.php?r=site/page&view=tenant-edit&msg=failed");
	}
	else{

		header("Location: index.php?r=site/page&view=tenant-edit&msg=success");
	}

}

$del_msg = "";

if(isset($_GET['del']) && $_GET['del']==true && isset($_GET['check_list'])){

	$list = $_GET['check_list'];
	$i = 0;
	foreach ($list as $key) {
		$i++;
		$command = Yii::$app->db->createCommand();
		$command->delete('tenant', 'tenant_id = '.$key)->execute();
	}

	$del_msg = $i." items Successfuly Deleted!";
}

if(isset($_GET['check_list'])){//check if edit button is clicked 


	
	$ck  = $_GET['check_list'][0];

	$ann = $tickets = (new \yii\db\Query())
					  ->select('tenant_id, first_name, middle_name, last_name, gender, dob, company, email, phone, property_id')
					  ->from('tenant')
					  ->where('tenant_id='.$ck)
					  ->all();

					
	foreach ($ann as $key2 => $value2)
						{
							$tenant_id = $value2['tenant_id'];
							$first_name = $value2['first_name'];
							$middle_name = $value2['middle_name'];
							$last_name = $value2['last_name'];
							$t_company = $value2['company'];
							$tenant_email = $value2['email'];
							$tenant_phone =  $value2['phone'];
							$tenant_gender = $value2['gender'];
							$tenant_dob = $value2['dob'];
							$t_pid = $value2['property_id'];
						} 
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg'] == "success")
					{
						?>
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;margin-left: 53px;">Successfuly Updated!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Update Tenant!</p>
						<?php
					}
				}
			?>
		</div>
	</div>
	<div class="row-fluid">
           <div class="span12">
		   <h3 class="header">Edit Tenant
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
    
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal form-label-left">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="tenant-edit">

	
		
		
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="t_property"><b>Property</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			 <select class="form-control" id="t_property" name="t_property" > 
				<option value="volvo">Select Property</option>
				<?php

				$con = Yii::$app->db;
				$id  = Yii::$app->user->id;
				$property = (new \yii\db\Query())
							->select('id, name')
							->from('property')
							->where('user_id='.$id)
							->all();


				//Yii::$app->db->createCommand('SELECT id, name FROM property WHERE user_id='.$id.'')->all();
				
				if(isset($property)){
					foreach ($property as $key4 => $value4)
					{
						?>
						<option value="<?php echo $value4['id']; ?>" selected="<?phpif($t_pid == $value4['id']){echo 'selected';}?>"><?php echo $value4['name']; ?>

						</option>
						<?php
					}
				}
				?>
			</select> 
			</div>
		</div>
		
		    <div class="form-group">
			
			<input type="hidden" id="t_pcid" name="t_pcid" value="<?php echo $tenant_id; ?>">	
			
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="fname" name="fname" placeholder="First name" value="<?php echo $first_name; ?>">
			</div>
			</div>
			
			<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="lname" name="lname" placeholder="Last name"  value="<?php echo $last_name; ?>">
			</div>
			</div>
			
			<div class="form-group">
			<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="mname" name="mname" placeholder="Middle name"  value="<?php echo $middle_name; ?>">
			</div>
			</div>
		
		<div class="form-group">
			<label for="t_cname" class="control-label col-md-3 col-sm-3 col-xs-12"><b>Company</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="t_cname" name="t_cname" value="<?php echo $t_company; ?>">	
		</div>
		</div>

		<div class="form-group">
			<label for="t_email" class="control-label col-md-3 col-sm-3 col-xs-12"><b>Email Address</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="t_email" name="t_email"  value="<?php echo $tenant_email; ?>">
		</div>
        </div>
		<div class="form-group">
			<label for="t_phone" class="control-label col-md-3 col-sm-3 col-xs-12"><b>Phone</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="t_phone" name="t_phone"  value="<?php echo $tenant_phone; ?>">
		</div>
		</div>
	<div class="form-group">
			<label for="t_dob" class="control-label col-md-3 col-sm-3 col-xs-12"><b>Date of Birth</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<input class="form-control col-md-7 col-xs-12" type="text" id="t_dob" name="t_dob" placeholder="mm/dd/yyyy" value="<?php echo $tenant_dob; ?>">
		</div>
        </div>
		<div class="form-group">
			<label for="t_gender" class="control-label col-md-3 col-sm-3 col-xs-12"><b>Gender</b></label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<select class="form-control" id="t_gender" name="t_gender"  value="<?php echo $tenant_gender; ?>">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
		</div>
    </div>
		<div class="form-group">
		 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
			<button class="btn btn-success">Submit</button>
		</div>
		</div>
	</form>
	</div>
	</div>
</div>
<?php
 } 
 else{
	?>
	<div class="container">
	<div class="row-fluid">
	<div class="row">
		<div class="col-md-12">
			<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg'] == "success")
					{
						?>
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;">Successfuly Updated!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;">Failed to Update Tenant!</p>
						<?php
					}
				}
			?>
			<?php 
			/* if(!empty($del_msg))
			{
				?>
				<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;"><?php echo $del_msg;?></p>
				<?php
			}
			else
			{
				?>
				<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;">You must select atleast 1..</p>
				<?php
			} */
			?>
			
			<a href="/tenant2/web/index.php?r=site/page&view=manage-tenants"><button class="btn-primary">Go back to Manage Tenants</button></a>
		</div>
	</div>
	</div>
	</div>
	<?php
}
/* } 
else{
	header('Location: /tenant2/web/index.php?r=user/login');	
} */
?>