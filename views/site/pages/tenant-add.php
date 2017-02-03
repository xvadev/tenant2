<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::$app->name . ' - addtenant';

$this->title = 'Add Tenant';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(isset($_GET['fname']) && !empty($_GET['fname']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('tenant', array(
    				 'user_id'		=> $id,
					 'tenant_id'	=> '',
    				 'first_name'	=> $_GET['fname'],
					 'last_name'	=> $_GET['lname'],
					 'middle_name'	=> $_GET['mname'],
    				 'company'		=> $_GET['t_cname'],
    				 'dob'			=> $_GET['t_dob'],
    				 'gender' 		=> $_GET['t_gender'],
    				 'email'		=> $_GET['t_email'],
    				 'phone'		=> $_GET['t_phone'],
					 'property_id'		=> $_GET['t_property']
    				 ));

	if(!$sql->execute())
	{
		header("Location: index.php?r=site/page&view=tenant-add&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=tenant-add&msg=success");
	}

}
?>

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
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-66 col-lg-6">
	<?php
		if(isset($_GET['msg']))
		{
			if($_GET['msg'] == "success")
			{
				?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Success!</strong>
            	</div>
				<?php
			}
			if($_GET['msg'] == "failed")
			{
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
<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal form-label-left">
<div class="row">
<div class="col-md-6 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Add New Tenant<small></small></h2>
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
			<input type="hidden" name="r" value="site/page">
			<input type="hidden" name="view" value="tenant-add">
			<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-right: 0px;">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<label>First Name </label> <small>(Required)</small>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control has-feedback-left" id="fname" name="fname" required="required">
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<label>Last Name</label> <small>(Required)</small>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control" id="lname" name="lname" required="required" >
				<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-right: 0px;">
				<br/>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<label>Middle Name</label> <small>(Required)</small>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<input id="mname" class="form-control has-feedback-left" name="mname"  type="text">
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
				</div>
				</div>
				
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-left: 0px;">
				<br/><div class="col-md-12 col-sm-12 col-xs-12">
				<label>Date of Birth</label>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<input class="date-picker form-control" type="text" id="t_dob" name="t_dob"  placeholder="mm/dd/yyyy">
				<span class="glyphicon glyphicon-calendar fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
				</div>
				</div>
				
			</div>
				
			

			<div class="row" style="margin: 0;">

				

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				</br>
				<label>E-mail Address</label>
				<input class="form-control" id="t_email" name="t_email" type="text">
				</div>
 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				</br>
				<label>Phone/Mobile No.</label>
				<input class="form-control" id="t_phone" name="t_phone" type="text">
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<br/>
					<label>Gender</label>
					</br>
					<div id="t_gender" class="btn-group" data-toggle="buttons">
					<label class="btn btn-default" data-toggle-class="btn-primary" style="padding: 6px 11px;" data-toggle-passive-class="btn-default">
						<input type="radio" name="t_gender" data-parsley-multiple="gender"> &nbsp; Male &nbsp;
					</label>
					<label class="btn btn-primary" data-toggle-class="btn-primary" style="padding: 6px 11px;" data-toggle-passive-class="btn-default">
						<input type="radio" name="t_gender" value="female" data-parsley-multiple="gender"> Female
					</label>
					</div>

				</div>
			</div>

			<div class="row" style="margin: 0;">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<br/>
				<label>Select Property to Add to</label>
				<select id="t_property" name="t_property" class="form-control"> 
				<option value="volvo">Select Property</option>
				<?php
				$con = Yii::$app->db;
				$id  = Yii::$app->user->getId();
				$property = Yii::$app->db->createCommand('SELECT id, name FROM property WHERE user_id='.$id.'')->queryAll();
				
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

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<br/>
					<label>Company</label>
					<input class="form-control" id="t_cname" name="t_cname"   type="text">
				</div>

				

			</div>

			<div class="row" style="margin: 0;">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<br/>
					<button type="submit" class="btn btn-primary">Cancel</button>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
</form>