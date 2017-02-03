<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Create Lease';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(isset($_GET['t_property']) && !empty($_GET['t_property']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('create_lease', array(
    				 'Tenant'	=> $_GET['t_tenant'],
					 'Duration'	=> $_GET['t_duration'],
    				 'Status'		=> $_GET['t_status'],
    				 'Comment'		=> $_GET['t_comment'],
					 'Property'		=> $_GET['t_property']
    				 ));

	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=create-lease&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=create-lease&msg=success");
	}

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
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;margin-left: 53px;">Successfuly Added!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Add Building Manager!</p>
						<?php
					}
				}
			?>
		</div>
	</div>
	<div class="row-fluid">
           <div class="span12">
		   <h3 class="header">Create Lease
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
    
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="create-lease">

	<div class="row">
		<?php 
			function property_selected($i)
			{
				if(isset($_GET['property']))
				{
					if($i == $_GET['property'])
					{
						echo "selected";
					}
				}
			}
			function tenant_selected($i)
			{
				if(isset($_GET['tenant']))
				{
					if($i == $_GET['tenant'])
					{
						echo "selected";
					}
				}
			}
		?>
		
		<div class="row-fluid">
			<div class="span4">
			<label for="t_property"><b>Property</b></label>
			 <select id="t_property" name="t_property" style="height: 46px!important;font-size: 18px;"> 
				<option value="volvo">Select Property</option>
				<?php
				$con = Yii::$app->db;
				$id  = Yii::$app->user->getId();
				$property = $con->createCommand('SELECT id,name FROM property WHERE user_id='.$id.'')->queryAll();
				
				if(isset($property)){
					foreach ($property as $key => $value)
					{
						?>
						<option value="<?php echo $value['id']; ?>"  <?php property_selected($value['id']);?> >

							<?php echo $value['name']; ?>

						</option>
						<?php
					}
				}
				?>
			</select> 
			</div>
			<div class="span4">
				<label for="t_tenant"><b>Tenant</b></label>
				 <select id="t_tenant" name="t_tenant" style="height: 46px!important;font-size: 18px;"> 
					<option value="volvo">Select Tenant</option>
					<?php
					$con = Yii::$app->db;
					$id  = Yii::$app->user->getId();
					$tenant = Yii::$app->db->createCommand('SELECT tenant_id, first_name, middle_name, last_name FROM tenant WHERE user_id='.$id.'')->queryAll();
					
					if(isset($tenant)){
						foreach ($tenant as $key => $value)
						{
							?>
							<option value="<?php echo $value['tenant_id']; ?>"  <?php tenant_selected($value['tenant_id']);?> >

								<?php echo $value['first_name'],' ',$value['last_name'];?>

							</option>
							<?php
						}
					}
					?>
				</select> 
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
			<label for="t_duration"><b>Contract Duration</b></label>
			<select id="t_duration" name="t_duration" style="height: 46px!important;font-size: 18px;"> 
				<option value="">Select Duration</option>
				<option value="6">6 Months</option>
				<option value="12">1 Year</option>
			</select> 
			</div>
		</div>
		<div class="row-fluid">
		<div class="span4">
			<label for="t_status"><b>Status</b></label>
			<select id="t_status" name="t_status" style="height: 46px!important;font-size: 18px;"> 
				<option value="">Select Status</option>
				<option value="default">Default</option>
				<option value="cancelled">Cancelled</option>
			</select> 	
		</div>
		<div class="span4">
			<label for="t_comment"><b>Comment</b></label>
			<input type="text" id="t_comment" name="t_comment" style="height: 37px!important; font-size: 18px;">
		</div>
		</div>
		<div class="row-fluid">
			<button style="height: 46px!important; width:120px; font-size: 18px;float:right;">Submit</button>
		</div>
	</form>
	</div>
	</div>
</div>