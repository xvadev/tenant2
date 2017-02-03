<!--
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  
</head>
<body>
-->	
<script>
	  $( function() {
		$( "#t_dob" ).datepicker();
	  } );
  </script>
<?php
use yii\helpers\Html;
use yii\db\Query;
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';
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

	if(!$sql)
	{
		header("Location: index.php?r=site/page&view=tenant-add&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=tenant-add&msg=success");
	}

}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>New Lease</h1>
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
		</div>
	</div>
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="tenant-lease">

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
		<div class="col-md-3">
			<label for="t_property">Property</label>
			 <select id="t_property" name="t_property">
				<option value="volvo">Select Property</option>
				<?php
				$con = Yii::$app->db;
				$id  = Yii::$app->user->getId();
				$property = (new \yii\db\Query())
				->select('id, name')
				->from('property')
				->where('user_id='.$id)
				->all();
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
		<div class="col-md-6">
			<label for="fname" style="width: 19%;">Name </br><small style="background: rgba(164, 210, 239, 0.25) none repeat scroll 0% 0%;"><i>Lastname/Firstname/Middlename</i></small></label>
			<input type="text" id="fname" name="fname">
			<input type="text" id="lname" name="lname">
			<input type="text" id="mname" name="mname">
			
		</div>
		
		<div class="col-md-3">
			<label for="t_cname">Company</label>
			<input type="text" id="t_cname" name="t_cname">
		</div>

		<div class="col-md-3">
			<label for="t_email">Email Address</label>
			<input type="text" id="t_email" name="t_email">
		</div>

		<div class="col-md-3">
			<label for="t_phone">Phone</label>
			<input type="text" id="t_phone" name="t_phone">
		</div>
		
		<div class="col-md-3">
			<label for="t_dob">Date of Birth</label>
			<input type="text" id="t_dob" name="t_dob">
		</div>

		<div class="col-md-3">
			<label for="t_gender">Gender</label>
			<select id="t_gender" name="t_gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
		</div>

		<div class="col-md-3">
			<button>Submit</button>
		</div>
	</form>
	</div>
</div>