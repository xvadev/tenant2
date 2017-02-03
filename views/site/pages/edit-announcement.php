<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Edit Announcement';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$con = Yii::$app->db;
$id  = Yii::$app->user->id;; 
$user = '';
$a_id = '';
$a_title = '';
$a_body = '';
$a_date = '';
if($id > 0) {

if(isset($_GET['a_title']) && !empty($_GET['a_title']))
{
	$con = Yii::$app->db;
	$id  = 1;
	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->update('announcements', array(
    				 'user_id'		=> $id,
    				 'title'	=> $_GET['a_title'],
					 'body'	=> $_GET['a_body'],
					 'date'	=> $_GET['a_date'], ),
					 'announcement_id=:ids', array(':ids'	=> $_GET['annid'],)
    				 );

	if(!$sql->execute())
	{
		header("Location: index.php?r=site/page&view=edit-announcement&msg=failed");
	}
	else
	{
		header("Location: index.php?r=site/page&view=edit-announcement&msg=success");
	}

}

if(isset($_GET['check_list']) && !empty($_GET['check_list']) ) {
	$ck = $_GET['check_list'];

	 $ann = (new \yii\db\Query())
	 		->select('*')
	 		->from('announcements')
	 		->where('announcement_id='.$ck)
	 		->all();
					
	foreach ($ann as $key2 => $value2)
						{
							$user = $value2['user_id'];
							$a_id = $value2['announcement_id'];
							$a_title = $value2['title'];
							$a_body = $value2['body'];
							$a_date = $value2['date'];
						} 

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
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Announcement<small></small></h2>
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
	<input type="hidden" name="view" value="edit-announcement">
	<input type="hidden" id="annid" name="annid" value="<?php echo $a_id;?>">

	    <div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-2">Title</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			<input type="text" id="a_title" name="a_title" class="form-control col-md-7 col-xs-12" value="<?php echo $a_title;?>">
		</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-2">Date 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" id="a_date" name="a_date" class="form-control col-md-7 col-xs-12" placeholder="mm/dd/yyyy" value="<?php echo $a_date;?>">
		</div>
     </div>
     <div class="form-group">
			<label for="a_body" class="control-label col-md-2 col-sm-2 col-xs-2">Body</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
			<textarea id="a_body" name="a_body" class="form-control col-md-7 col-xs-12"><?php echo $a_body;?></textarea>
		</div>
		</div>
		</br>
		<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		 <button type="submit" class="btn btn-primary">Cancel</button>
			<button type="submit" class="btn btn-success">Submit</button>
		</div>
		</div>
	</div>
	</form>
	</div>
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
			<a href="/tenant2/web/index.php?r=site/page&view=manage-ann"><button class="btn-primary">Go back to Manage Announcements</button></a>
		</div>
	</div>
	</div>
	</div>
	
	<?php
}
} 
else{
	header('Location: /tenant2/web/index.php?r=user/login');	
}
?>