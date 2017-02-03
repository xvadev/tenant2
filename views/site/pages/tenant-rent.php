
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
		$( "#datepicker" ).datepicker();
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
if(isset($_GET['paymentdate']) && !empty($_GET['paymentdate']))
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();
	$command2 = Yii::$app->db->createCommand();
	$sql 	 = $command2->update('rent', array(
    				 'm_payment' => $_GET['paymentdate']),
					 'rent_id=:id', array(':id'	=> $_GET['t_rcid'])
					 );
	if(!$sql->execute())
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=tenant-rent&msg=failed&check_list=".$_GET['t_pcid']."")->send();
		}
		else
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=tenant-rent&msg=success&check_list=".$_GET['t_pcid']."")->send();
		}
}
if(isset($_GET['start']) && !empty($_GET['start']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();
	$command = Yii::$app->db->createCommand();
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
	if(!$sql->execute())
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=tenant-rent&msg=failed&check_list=".$_GET['t_pcid']."")->send();
		}
		else
		{
			Yii::$app->response->redirect("Location: index.php?r=site/page&view=tenant-rent&msg=success&check_list=".$_GET['t_pcid']."")->send();
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
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
	if(isset($_GET['msg'])){
		
		if($_GET['msg'] == "success"){
			?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Success!</strong>
            </div>
			<?php
		}

	if($_GET['msg'] == "failed"){
		?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Failed!</strong> Make sure to double check entries.
        </div>
		<?php
	}
	}
?>
	</div>
</div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Rental Information<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <input type="hidden" name="r" value="site/page">
					<input type="hidden" name="view" value="tenant-rent">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<div class="row">
					<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <label>Select Property </label>
                          <select class="form-control" name="t_property" readonly> 
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
									<option value="<?php echo $value4['id']; ?>" <?php if($t_pid ==$value4['id']){ ?>selected="selected"<?php } ?>><?php echo $value4['name']; ?>

									</option>
									<?php
								}
							}
							?>
							</select>
					</div>
					</div>
					
					<div class="row">
						<input type="hidden" id="t_pcid" name="t_pcid" value="<?php echo $ck; ?>">
						<input type="hidden" id="t_rcid" name="t_rcid" value="<?php echo $rent_id; ?>">

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							</br>
							<label>Start</label>
							<input type="date" class="form-control" data-inputmask="'mask': '99/99/9999'" id="datepicker" name="start" value="<?php echo $start; ?>">
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							</br>
							<label>End</label>
							<input type="date" class="form-control" data-inputmask="'mask': '99/99/9999'" id="datepicker" name="end" value="<?php echo $end; ?>">
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<br>
						<label>Monthly Payment</label>
						<input type="text" class="form-control"  name="p_month" value="<?php echo $rent_p; ?>" readonly>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<br>
						<label>Payment Status</label>
						<?php
							if($payment_status == 'paid'){
							?>
							<br>
							<a class="btn btn-success">Paid</a>
							<?php
							}
							else
							{
							?>
							<br>
							<a class="btn btn-warning">Unpaid</a>
							<?php
							}
						?>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br>
						<label>Full Payment?</label>
						<?php
						$fu;
						if($full_payment == 1){
							$fu = 1;
							?>
							<div id="p_full" data-toggle="buttons">
	                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	                              <input type="radio" name="p_full" value="1" data-parsley-multiple="gender" checked="checked"> &nbsp; Yes &nbsp;
	                            </label>
	                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	                              <input type="radio" name="p_full" value="0" data-parsley-multiple="gender"> &nbsp; No &nbsp;
	                            </label>
	                        </div>
							<?php
						}else
						{
							$fu = 0;
							?>
							<div id="p_full" data-toggle="buttons">
	                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	                              <input type="radio" name="p_full" value="1" data-parsley-multiple="full"> &nbsp; Yes &nbsp;
	                            </label>
	                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	                              <input type="radio" name="p_full" value="0" data-parsley-multiple="full" checked="checked"> &nbsp; No &nbsp;
	                            </label>
	                        </div>
							<?php
						}
						?>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
						<br>
						<label>Total Bill</label>
						<input type="text" class="form-control" name="p_fullpay" disabled value="<?php
							$r = substr($rent_p, 1);
							if($fu > 0 ) {
								$ts1 = strtotime($start);
								$ts2 = strtotime($end);
								$year1 = date('Y', $ts1);
								$year2 = date('Y', $ts2);

								$month1 = date('m', $ts1);
								$month2 = date('m', $ts2);

								$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
								$rent_pay = $rent_p * $diff;
								echo "$".$rent_pay;
							} 
							else{
								echo "$".$rent_p;
							} 
							?>">
						</div>

						<div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
						<br>
						<label>Payment Incharged</label>
						<select class="form-control" name="m_pay"> 
						<?php 
						if($m_status == ''){
						?>
							<option value="">Select</option>
							<option value="Tenant">Tenant</option>
							<option value="Owner">Owner</option>
						<?php 
						}
						if($m_status == 'Tenant'){
						?>
							<option value="">Select</option>
							<option value="Tenant" selected>Tenant</option>
							<option value="Owner">Owner</option>
						<?php 
						}
						if($m_status == 'Owner'){
						?>
							<option value="">Select</option>
							<option value="Tenant">Tenant</option>
							<option value="Owner" selected>Owner</option>
						<?php
						}			
						?>
						</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br>
						<br>
						<button class="btn btn-primary">Submit</button> 
						<a class="btn btn-default" href="/tenant2/web/index.php?r=site/page&view=manage-tenants">Cancel</a>
						</div>
					</div>
				</form>
				</div> <!-- XCONTENT -->
			</div> <!-- Panel -->
	</div><!-- Col 6 -->
	

	<?php
	if($submission == 1 && $full_payment == 0){
	?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		<div class="x_panel">
			<div class="x_title">
				<h2>Rent Montly Payment<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
				<li>
					<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="#">Settings 1</a>
						</li>
						<li>
							<a href="#">Settings 2</a>
						</li>
					</ul>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			</ul>

			<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="r" value="site/page">
					<input type="hidden" name="view" value="tenant-rent">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="t_pcid" name="t_pcid" value="<?php echo $ck; ?>">
							<input type="hidden" id="t_rcid" name="t_rcid" value="<?php echo $rent_id; ?>">
							<label class="control-label">Date of Payment</label>
							<input type="date" class="form-control" data-inputmask="'mask': '99/99/9999'" id="datepicker" name="paymentdate" value="">
							<br>
							<label class="control-label">Payment</label>
							<input type="text" class="form-control"  name="p_month" value="<?php echo $rent_p; ?>" readonly>

							<br>
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>

				</form>
			</div>
                </div>
	</div>
	<?php
	}
	?> 
</div> <!-- Row -->      
<?php
}
?>