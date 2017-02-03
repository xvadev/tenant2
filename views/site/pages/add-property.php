<?php
use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Add Property';
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->user->isGuest)
{
	header('Location: ?r=user/login');
}
else		
{
if(isset($_GET['name']) && !empty($_GET['name']) )
{

	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('property', array(
    				 'user_id'	=> $id,
    				 'name'		=> $_GET['name'],
    				 'built'	=> $_GET['built'],
    				 'mls'		=> $_GET['mls'],
    				 'street'	=> $_GET['street'],
    				 'city' 	=> $_GET['city'],
    				 'county'	=> $_GET['county'],
    				 'state'	=> $_GET['state'],
    				 'country'	=> $_GET['country'],
					 'rent'		=> $_GET['rent']
    				 ));

	if(!$sql->execute())
	{
		header("Location: index.php?r=site/page=&view=add-property&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=add-property&msg=success");
	}

}
}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
<input type="hidden" name="r" value="site/page">
<input type="hidden" name="view" value="add-property">
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h2>Add New Property<small></small></h2>
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
				<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>Property Name</label>
				<input type="text" class="form-control" id="name" name="name" required="required" placeholder="ex. Hamilton Condominiums">
				</div>

				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>MLS No.</label>
				<input type="text" class="form-control" id="mls" name="mls" >
				</div>

				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>Year Built</label>
				<input class="form-control" type="text" id="built" name="built" required="required" placeholder="ex. 2014">
				</div>

				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>Rent Price</label>
				<input class="form-control" type="text" id="rent" name="rent" required="required" placeholder="ex. 2000">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>Street Address</label>
				<input class="form-control" type="text" id="street" name="street" placeholder="ex. San Felipe Street">
				</div>

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>City</label>
				<input class="form-control" type="text" id="city" name="city" placeholder="ex. Houston">
				</div>

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>County</label>
				<input class="form-control" type="text" id="county" name="county">
				</div>

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>State</label>
				<input class="form-control" type="text" id="state" name="state" placeholder="ex. Texas">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<br/>
				<label>Country</label>
				 <input class="form-control" type="text" id="country" name="country" placeholder="ex. United States">
				</div>
			</div>

			<div class="row">
			<br/>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
			</div>
		</div>
	</div>
</div>
</form>

