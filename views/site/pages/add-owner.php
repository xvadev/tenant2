<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Add Owner';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(isset($_GET['fname']) && !empty($_GET['fname']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('owners', array(
    				 'user_id'		=> $id,
					 'owner_id'	=> '',
    				 'first_name'	=> $_GET['fname'],
					 'last_name'	=> $_GET['lname'],
					 'middle_name'	=> $_GET['mname'],
    				 'company'		=> $_GET['t_cname'],
    				 'email'		=> $_GET['t_email'],
    				 'phone'		=> $_GET['t_phone'],
					 'property_id'		=> $_GET['t_property']
    				 ));

	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=add-owner&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=add-owner&msg=success");
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
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Add Owner!</p>
						<?php
					}
				}
			?>
		</div>
	</div>
	<div class="row-fluid">
           <div class="span12">
		   <h3 class="header">Add New Owner
                <span class="header-line"></span> 
           </h3>
		   
		   </div>
    
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal form-label-left">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="add-owner">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

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
		?>
		
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="t_property">Property</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="t_property" name="t_property" class="form-control">
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
		</div>
		<!--<div class="row-fluid">
		<div class="span12">
			<label for="fname" style="width: 19%;"><b>Name</b></label>
	    </div>
		</div>
		<div class="row-fluid">
			<div class="span4">
			<input type="text" id="fname" name="fname" placeholder="First name" style="height: 37px!important; font-size: 18px;">
			</div>
			<div class="span4">
			<input type="text" id="lname" name="lname" placeholder="Last name" style="height: 37px!important; font-size: 18px;">
			</div>
			<div class="span4">
			<input type="text" id="mname" name="mname" placeholder="Middle name" style="height: 37px!important; font-size: 18px;">
			</div>
		</div>
		<div class="row-fluid">
		<div class="span4">
			<label for="t_cname"><b>Company</b></label>
			<input type="text" id="t_cname" name="t_cname" style="height: 37px!important; font-size: 18px;">	
		</div>

		<div class="span4">	
			<label for="t_email"><b>Email Address</b></label>
			<input type="text" id="t_email" name="t_email" style="height: 37px!important; font-size: 18px;">
		</div>

		<div class="span4">
			<label for="t_phone"><b>Phone</b></label>
			<input type="text" id="t_phone" name="t_phone" style="height: 37px!important; font-size: 18px;">
		</div>
		</div>
		<div class="row-fluid">
			<button style="height: 46px!important; width:120px; font-size: 18px;float:right;">Submit</button>
		</div>-->
		
		<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fname" name="fname" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lname" name="lname" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="mname" name="mname" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="t_cname" class="control-label col-md-3 col-sm-3 col-xs-12">Company</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="t_cname" name="t_cname"  class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="t_email" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="t_email" name="t_email"  class="form-control col-md-7 col-xs-12" type="text">
                        </div> 
                      </div>
					  <div class="form-group">
                        <label for="t_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="t_phone" name="t_phone"  class="form-control col-md-7 col-xs-12" type="text">
                        </div> 
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
	</form>
	</div>
	</div>
</div>