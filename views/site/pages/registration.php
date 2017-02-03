<?php

use yii\helpers\Html;
use yii\db\Query;
use yii\swiftmailer\Mailer;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$msg = "";


if(isset($_GET['uname']) && !empty($_GET['uname']) )
{

	if(check_email())//Exist
	{
		$msg = "Email already Exist";
	}
	else //Not Exist
	{

	$con = Yii::$app->db;

	$pass = $_GET['pname'];
	$pass = sha1($pass);

	$key = mt_rand(100000, 999999);
	$key = sha1($key);

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('users', array(
					 'id'	=> '',
					 'position_id'	=> $_GET['t_position'],
    				 'username'	=> $_GET['uname'],
					 'password'	=> $pass,
					 'email'	=> $_GET['ename'],
    				 'activkey'		=> $key,
    				 'createtime'	=> mktime() ,
    				 'status' 		=> '0'
    				 ));
	
	if(!$sql->execute()) {
		
		$msg = "Unable to Register this time.";
	}
	else{
		
		$m = Yii::$app->mailer->compose()
	    ->setFrom('rgbitangcor92@gmail.com')
	    ->setTo($_GET['ename'])
	    ->setSubject('Tenant 24/7 Email Validation')
	    ->setTextBody('Email Verification')
	    ->setHtmlBody("<b>Hi ".$_GET['uname'].", Please verify your email address by clicking the link below.</b>\n</br>http://tenant247.com/tenant2/web/index.php?r=site/page&view=activation&key=".$key)
	    ->send();

	    if($m == true)
		{
			$msg = "Please check your email for verification process. Thank you!";
			if(isset($_GET['owneremail']))
			{
				sendmailtoowner($key);
			}

		}   

	}

	}


}
?>

<?php 

    function initialRegistration()
    {
    	if(isset($_GET['emailadd']))
    	{
    		echo $_GET['emailadd'];
    	}
    }
    function sendmailtoowner($key){

    	$owner = $_GET['owneremail'];
    	$m = Yii::$app->mailer->compose()
	    ->setFrom('rgbitangcor92@gmail.com')
	    ->setTo($owner)
	    ->setSubject('Tenant 24/7 Email Validation')
	    ->setTextBody('Email Verification')
	    ->setHtmlBody("<b>Hi, This person with username:"+$_GET['uname']+" is requesting for account as Staff at your Property to Approve click the .</b>\n</br>http://tenant247.com/tenant2/web/index.php?r=site/page&view=activation&key=".$key)
	    ->send();

    }

	function position_selected($i)
	{
		if(isset($_GET['position']))
		{
			if($i == $_GET['position'])
			{
				echo "selected";
			}
		}
	}


	function check_email()
	{
		$iEmail = $_GET['ename'];

		$sql = Yii::$app->db->createCommand("SELECT * FROM users WHERE email='$iEmail'")->queryAll();

		if(!empty($sql))
		{
			return true; //Exist
		}
		else
		{
			return false; //Not Exist
		}


	}
?>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-66 col-lg-6">
	<h3><?php echo $msg;?></h3>
	</div>
</div>
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
<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Registration<small></small></h2>
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
			<input type="hidden" name="view" value="registration">
			<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
			<div class="row">
			    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
			    	<label>Username </label> <small>(Required)</small>
			    </div>

			    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
			    	<label>Password</label> <small>(Required)</small>
			    </div>

			    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
			    	<label>Email Address</label> <small>(Required)</small>
			    </div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
					<input type="text" class="form-control" id="uname" name="uname" required="required">
				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
					<input type="password" class="form-control" id="pname" name="pname" required="required">
				</div>

				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
					<input id="ename" class="form-control" name="ename"  value="<?php echo initialRegistration(); ?>" type="text" placeholder="ex. example@testdomain.com">
				</div>
			</div>

			<div class="row">
			    <p></p>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;">
				<label>Select your role</label>
				<select id="t_position" name="t_position" class="form-control" onchange="showInput(this.value)"> 
				<option >Select Role</option>
				<?php
				$con = Yii::$app->db;
				$position = Yii::$app->db->createCommand('SELECT * FROM positions WHERE position_id !=1 AND position_id != 2;')->queryAll();
				
				if(isset($position)){
					foreach ($position as $key => $value)
					{
						?>
						<option value="<?php echo $value['position_id']; ?>"  <?php position_selected($value['position_id']);?> >

							<?php echo $value['position_name']; ?>

						</option>
						<?php
					}
				}
				?>
				</select>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="padding-right: 0px;" id="ownerInput">
				<label>Owner Email Address</label>
					<input type="text" name="owneremail" class="form-control" placeholder="ex. exampleowner@testdomain.com" required="required"> 
				</div>

				</div>
			</div>
				
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
