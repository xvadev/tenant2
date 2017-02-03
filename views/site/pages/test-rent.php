
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  
</head>
<style>
.row-fluid {
    width: 85%;
    margin-left: auto;
    margin-right: auto;
}
.container {
    padding-left: 0px!important;
}
</style>
<body>

<script>
	  $( function() {
		$( "#t_dob" ).datepicker();
	  } );
  </script>
<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';
use yii\helpers\Html;
use yii\db\Query;
?>

<?php
$con = Yii::$app->db;
$id  = Yii::$app->user->getId();
$rent_id = '';
$tenant_id = '';
$start = '';
$end = '';
$payment_month = '';
$payment_status = '';
$full_payment = '';
$m_status =  '';
$t_pid = '';
$submission = 0;
//if($id > 0) {
if(isset($_GET['start']) && !empty($_GET['start']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();
	$command = Yii::app()->db->createCommand();
	if ($submission = 1) {
	$sql 	 = $command->update('rent', array(
    				 'tenant_id'		=> $_GET['t_pcid'],
					 'start'			=> $_GET['start'],
					 'end'				=> $_GET['end'],
    				 'payment_month'	=> $_GET['p_month'],
    				 'payment_status'	=> $_GET['p_status'],
    				 'full_payment' 	=> $_GET['p_full'],
    				 'm_status'			=> $_GET['m_pay'],
					 'property_id'		=> $_GET['t_property']),
					 'rent_id=:id', array(':id'	=> $_GET['t_rcid'])
					 );
	}
	if ($submission == 0) {
	$sql 	 = $command->insert('rent', array(
    				 'rent_id'		=> $id,
					 'tenant_id'		=> $_GET['t_pcid'],
					 'start'			=> $_GET['start'],
					 'end'				=> $_GET['end'],
    				 'payment_month'	=> $_GET['p_month'],
    				 'payment_status'	=> $_GET['p_status'],
    				 'full_payment' 	=> $_GET['p_full'],
    				 'm_status'			=> $_GET['m_pay'],
					 'property_id'		=> $_GET['t_property']
    				 ));
	}
	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=tenant-rent&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=tenant-rent&msg=success");
	}

}
if(isset($_GET['check_list']) && !empty($_GET['check_list']) ) {
	$ck = $_GET['check_list'];
	$ann = (new \yii\db\Query())
					->select('rent_id, tenant_id, start, end, payment_month, payment_status, full_payment, property_id, m_status, m_payment')
					->from('rent')
					->where('tenant_id='.$ck)
					->all();
	foreach ($ann as $key2 => $value2)
						{	
							$rent_id = $value2['rent_id'];
							$tenant_id = $value2['tenant_id'];
							$start = $value2['start'];
							$end = $value2['end'];
							$payment_month = $value2['payment_month'];
							$payment_status = $value2['payment_status'];
							$full_payment = $value2['full_payment'];
							$m_status = $value2['m_status'];
							$t_pid = $value2['property_id'];
						} 
						if(isset($rent_id)) 
						{
							$submission = 1;
						}
						else{
							$submission = 0;
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
		   <h3 class="header">Tenant Renting Details
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
    
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="tenant-rent">

	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<label for="t_property">Property</label>
			 <select id="t_property" name="t_property" disabled"> 
				<option value="">Select Property</option>
				<?php
				$con = Yii::$app->db;
				$id  = Yii::$app->user->getId();
				$property = (new \yii\db\Query())
				->select('id, name, rent')
				->from('property')
				//->where('id='.$t_pid)
				->all();
				if(isset($property)){
					foreach ($property as $key4 => $value4)
					{
						$rent_p = $value4['rent'];
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
			<input type="hidden" id="t_pcid" name="t_pcid" value="<?php echo $ck; ?>">
			<input type="hidden" id="t_rcid" name="t_rcid" value="<?php echo $rent_id; ?>">
	    </div>
		</div>
		<div class="row-fluid">
			<div class="span4">
			<label for="start"><b>Start Date</b></label>
			<input type="text" id="start" name="start" placeholder="Start of Rent" style="height: 37px!important; font-size: 18px;" value="<?php echo $start; ?>">
			</div>
			<div class="span4">
			<label for="end"><b>End Date</b></label>
			<input type="text" id="end" name="end" placeholder="End of Date" style="height: 37px!important; font-size: 18px;" value="<?php echo $end; ?>">
			</div>
		</div>
		<div class="row-fluid">
		<div class="span4">
			<label for="p_month"><b>Payment Month</b></label>
			<input type="text" id="p_month" name="p_month" placeholder="Currently Payment Month" style="height: 37px!important; font-size: 18px;" value="<?php echo $rent_p; ?>">
			</div>
		<div class="span4">
			<label for="p_status"><b>Payment_status</b></label>
			<!--<input type="text" id="p_status" name="p_status" style="height: 37px!important; font-size: 18px;" value="<?php //echo $payment_status; ?>"> -->
			<?php
			if($payment_status == 'paid'){
			?>
			<input type="checkbox" id="p_status" name="p_status" value="paid" checked>Paid?</br>
			<?php
			}
			else
			{
			?>
			<input type="checkbox" id="p_status" name="p_status" value="paid">Paid?</br>
			<?php
			}
			?>
			<?php
			if($full_payment == 'full'){
				$fu = 1;
			?>
			<input type="checkbox" id="p_full" name="p_full" value="full" checked>Full Payment?
			<?php
			}
			else
			{
				$fu = 0;
			?>
			<input type="checkbox" id="p_full" name="p_full" value="full">Full Payment?
			<?php
			}
			?>
		</div>

		<div class="span4">	
			<label for="p_full"><b>Full Payment</b></label>
			<input type="text" id="p_fullpay" name="p_fullpay" disabled style="height: 37px!important; font-size: 18px;" value="<?php
			$r = substr($rent_p, 1);
			if($fu > 0) {
				$rent_pay = $r * 6;
				echo "$".$rent_pay;
			} 
			else{
				echo "$".$r;
			} 
			?>">
		</div>
		</div>
		<div class="row-fluid">
		<div class="span4">
			<label for="m_pay"><b>Maintenance Payment</b></label>
			<select id="m_pay" name="m_pay" style="height: 46px!important;font-size: 18px;"> 
			<?php 
			if($m_status == ''){
			?>
				<option value="">Select Who Will pay</option>
				<option value="Tenant">Tenant</option>
				<option value="Owner">Owner</option>
			<?php 
			}
			if($m_status == 'Tenant'){
			?>
				<option value="">Select Who Will pay</option>
				<option value="Tenant" selected>Tenant</option>
				<option value="Owner">Owner</option>
			<?php 
			}
			if($m_status == 'Owner'){
			?>
				<option value="">Select Who Will pay</option>
				<option value="Tenant">Tenant</option>
				<option value="Owner" selected>Owner</option>
			<?php
			}			
			?>
			</select>
		</div>
		</div>
		<div class="row-fluid">
			<button style="height: 46px!important; width:120px; font-size: 18px;float:right;">Submit</button>
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
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;">Successful!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;">Failed!</p>
						<?php
					}
				}
			?>
			<a href="index.php?r=site/page&view=manage-tenants"><button class="btn-primary">Go back to Manage Tenants</button></a>
		</div>
	</div>
	</div>
	</div>
<?php
}


?>