
<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Edit Owner';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$con = Yii::$app->db;
$id  = Yii::$app->user->getId();
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
if($id > 0) {
if(isset($_GET['fname']) && !empty($_GET['fname']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->update('owners', array(
					 'user_id'		=> $id,
    				 'first_name'	=> $_GET['fname'],
					 'last_name'	=> $_GET['lname'],
					 'middle_name'	=> $_GET['mname'],
    				 'company'		=> $_GET['t_cname'],
    				 'email'		=> $_GET['t_email'],
    				 'phone'		=> $_GET['t_phone'],
					 'property_id'		=> $_GET['t_property']),
					 'owner_id=:id', array(':id'	=> $_GET['t_pcid'])
					 );

	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=edit-owner&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=edit-owner&msg=success");
	}

}
if(isset($_GET['check_list']) && !empty($_GET['check_list']) ) {
	$ck = $_GET['check_list'];
	 $ann = Yii::$app->db->createCommand('SELECT owner_id, first_name, middle_name, last_name, company, email, phone, property_id FROM owners WHERE owner_id='.$ck.'')->queryAll();
					
	foreach ($ann as $key2 => $value2)
						{
							$tenant_id = $value2['owner_id'];
							$first_name = $value2['first_name'];
							$middle_name = $value2['middle_name'];
							$last_name = $value2['last_name'];
							$t_company = $value2['company'];
							$tenant_email = $value2['email'];
							$tenant_phone =  $value2['phone'];
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
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Update Owner!</p>
						<?php
					}
				}
			?>
		</div>
	</div>
	<div class="row-fluid">
           <div class="span12">
		   <a href="/tenant/index.php?r=site/page&view=manage-owner"><button class="btn-primary" style="border-radius:4px;">Go back to Manage owners</button></a>
		   <h3 class="header">Edit Owner
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
    
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="edit-owner">

	<div class="row">
		
		
		<div class="row-fluid">
			<label for="t_property"><b>Property</b></label>
			 <select id="t_property" name="t_property" style="height: 46px!important;font-size: 18px;"> 
				<option value="volvo">Select Property</option>
				<?php
				$con = Yii::$app->db;
				$id  = Yii::$app->user->getId();
				$property = Yii::$app->db->createCommand('SELECT id, name FROM property WHERE user_id='.$id.'')->queryAll();
				
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
		<div class="row-fluid">
		<div class="span12">
			<label for="fname" style="width: 19%;"><b>Name</b></label>
			<input type="hidden" id="t_pcid" name="t_pcid" value="<?php echo $tenant_id; ?>">	
	    </div>
		</div>
		<div class="row-fluid">
			<div class="span4">
			<input type="text" id="fname" name="fname" placeholder="First name" style="height: 37px!important; font-size: 18px;" value="<?php echo $first_name; ?>">
			</div>
			<div class="span4">
			<input type="text" id="lname" name="lname" placeholder="Last name" style="height: 37px!important; font-size: 18px;" value="<?php echo $last_name; ?>">
			</div>
			<div class="span4">
			<input type="text" id="mname" name="mname" placeholder="Middle name" style="height: 37px!important; font-size: 18px;" value="<?php echo $middle_name; ?>">
			</div>
		</div>
		<div class="row-fluid">
		<div class="span4">
			<label for="t_cname"><b>Company</b></label>
			<input type="text" id="t_cname" name="t_cname" style="height: 37px!important; font-size: 18px;" value="<?php echo $t_company; ?>">	
		</div>

		<div class="span4">	
			<label for="t_email"><b>Email Address</b></label>
			<input type="text" id="t_email" name="t_email" style="height: 37px!important; font-size: 18px;" value="<?php echo $tenant_email; ?>">
		</div>

		<div class="span4">
			<label for="t_phone"><b>Phone</b></label>
			<input type="text" id="t_phone" name="t_phone" style="height: 37px!important; font-size: 18px;" value="<?php echo $tenant_phone; ?>">
		</div>
		</div>
		<div class="row-fluid">
			<button class="btn btn-large btn-primary" style="height: 40px!important; width:120px; font-size: 18px;float:right;border-radius:4px;">Submit</button>
		</div>
	</form>
	</div>
	</div>
</div>
<?php
} 
else {
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
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;">Successfuly Added!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;">Failed to Add Tenant!</p>
						<?php
					}
				}
			?>
			<a href="/tenant/index.php?r=site/page&view=manage-owner"><button class="btn-primary">Go back to Manage owners</button></a>
		</div>
	</div>
	</div>
	</div>
	<?php
}
} 
else{
	header('Location: /tenant/index.php?r=user/login');	
}
?>