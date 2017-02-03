<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';
use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Add Announcement';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$con = Yii::$app->db;
$id  = Yii::$app->user->getId();
/*
if($id > 0) {
 $usr = Yii::app()->db->createCommand()
    ->select('privilage_id')
    ->from('users')
    ->where('id='.$id)
    ->queryAll();
foreach ($usr as $key2 => $value2)
    {
		if($value2['privilage_id'] > 1) {
			
		}
	}
} 
else{
	header('Location: /tenant/index.php?r=user/login');	
}*/
if(isset($_GET['a_title']) || !empty($_GET['a_title']) )
{
	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();

	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('announcements', array(
    				 'user_id'		=> $id,
					 'announcement_id'	=> '',
    				 'title'	=> $_GET['a_title'],
					 'body'	=> $_GET['a_body'],
					 'date'	=> $_GET['a_date']
    				 ));
	if(!$sql->execute())
	{
		Yii::$app->response->redirect("index.php?r=site/page&view=add-announcement&msg=failed")->send();
		//header("Location: index.php?r=site/page&view=add-announcement&msg=failed");
	}
	else
	{
		Yii::$app->response->redirect("index.php?r=site/page&view=add-announcement&msg=success")->send();
		//header("Location: index.php?r=site/page&view=add-announcement&msg=success");
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
	<div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Announcement<small></small></h2>
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
	<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal form-label-left">

	<input type="hidden" name="r" value="site/page">
	<input type="hidden" name="view" value="add-announcement">
	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	
	<!--<div class="row-fluid">
		<div class="span6">
			<label for="a_title"><b>Title</b></label>
			<input type="text" id="a_title" name="a_title" style="height: 37px!important; font-size: 18px; width: 100%;">
		</div>
		
		<div class="span6">
			<label for="a_date"><b>Date</b></label>
			<input type="text" id="a_date" name="a_date" style="height: 37px!important; font-size: 18px; width: 100%;" placeholder="mm/dd/yyyy">
		</div>
     </div>
     <div class="row-fluid">
		<div class="span12">
			<label for="a_body"><b>Body</b></label>
			<textarea id="a_body" name="a_body" style="height: 200px!important; font-size: 18px; width: 100%;"></textarea>
		</div>
		<div class="col-md-3">
			<button style="height: 46px!important; width:120px; font-size: 18px;float:right;">Submit</button>
		</div>
	</div>-->
	                  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="a_title" name="a_title"  class="form-control col-md-7 col-xs-12" type="text">
                        </div> 
                      </div>
					  
	                  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2">Date 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input class="form-control"  id="a_date" name="a_date" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="mm/dd/yyyy">
							<span class="glyphicon glyphicon-calendar fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
					   </div>
                      </div>
					  <div class="form-group">
                        <label for="a_body" class="control-label col-md-2 col-sm-2 col-xs-2">Body</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea id="a_body" name="a_body" required="required" class="form-control"  data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
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
	</div>