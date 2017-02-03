<?php 
use yii\helpers\Html;
use yii\db\Query;
	
  $user  = Yii::$app->user->getId();
  if(!isset($user))
  {
  	$this->redirect("?r=user/login");
  }

?>


<?php
/* @var $this SiteController */
$this->title = 'Announcements';
$this->params['breadcrumbs'][] = $this->title;
$con = Yii::$app->db;
$id  = Yii::$app->user->getId();

if($id > 0) {
	$mem_type = Yii::$app->db->createCommand('SELECT id, position_id, superuser, parent_id, username, email FROM users WHERE id='.$id.'')->queryAll();
    
	foreach ($mem_type as $key3 => $value3)
    { 
		$parent =  $value3['id'];
		$isadmin = $value3['superuser'];
		$uname = $value3['username'];
		$pos = $value3['position_id'];
		if($isadmin > 0) 
		{
	?>

		<h1></h1>
		<div class="row">
		<div class="col-md-12">
		<?php
				if(isset($_GET['msg']))
				{
					if($_GET['msg'] == "success")
					{
						?>
						<p style="color:#4F8A10; background:#DFF2BF; padding:4px 6px 4px 6px;margin-left: 53px;">Successfuly Deleted!</p>
						<?php
					}
					if($_GET['msg'] == "failed")
					{
						?>
						<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Delete!</p>
						<?php
					}
				}
			?>
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Announcements <small></small></h2>
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

                  <div class="x_content" style="display: block;">
				  
					<?php
					$ann = Yii::$app->db->createCommand('SELECT announcement_id, user_id, title, body, date FROM announcements WHERE user_id='.$id.'')->queryAll();
					
					?>
					<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<a class="btn btn-success" href="index.php?r=site/page&view=add-announcement"  style="border-radius: 4px;height: 37px!important;width: 130px;font-size: 18px;margin-right: 5px;margin-bottom: 13px;line-height: 1.5;">Create New</a>
					<button class="btn btn-warning" name="edit" style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px; float:right;">Edit</button>
				    <button class="btn btn-danger" name="del" onclick="return confirm('Are you sure?')"  style="border-radius: 4px;height: 37px!important;width: 120px;font-size: 18px;margin-right: 5px;float:right;">Delete</button>
					<input type="hidden" name="r" value="site/page">
					<input type="hidden" name="view" value="manage-ann">
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					</br>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <div class="icheckbox_flat-green" style="position: relative;"><input id="check-all" class="flat" style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </th>
							<th>ID</th>
							<th>Author</th> 
							<th>Title</th>
							<th>Body</th>
							<th>Date</th>
						</tr>
						</thead>
						<tbody>
					<?php
					foreach ($ann as $key => $value)
					{
						$user = $value['user_id'];
						$ann_user = Yii::$app->db->createCommand('SELECT id, position_id, superuser, parent_id, username, email FROM users WHERE id='.$user.'')->queryAll();
						
						foreach ($ann_user as $key2 => $value2)
										{ 
										 $author = $value2['username'];
										}
										
					?>
						
						  <tr class="even pointer">
							<td><input type="checkbox" name="check_list[]" value="<?php echo $value['announcement_id']; ?>"></td>
							<td class=" "><?php echo $value['announcement_id']; ?></td>
							<td class=" "><?php echo $author;?></td>
							<td class=" "><?php echo $value['title']; ?></td>
							<td class=" "><?php echo $value['body']; ?></td>
							<td class=" "><?php echo $value['date']; ?></td>
						  </tr>

						<?php
					}
					?>
					</tbody>
							  </table>
							</div>
						  </div>
						</div>
					  </div>
					  </form>
				
		</br>
		<?php
		}
		else {
			if($pos == 3) {
				?>

				<h1>Manage Announcements</h1>
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
										<p style="color:#D8000C; background:#FFBABA; padding:4px 6px 4px 6px;margin-left: 53px;">Failed to Add Tenant!</p>
										<?php
									}
								}
							?>
						</div>
						</div>
						<?php
						$ann = Yii::$app->db->createCommand('SELECT announcement_id, user_id, title, body, date FROM announcements WHERE user_id='.$id.'')->queryAll();
						
						?>
						<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<input type="hidden" name="r" value="site/page">
						<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
						<input type="hidden" name="view" value="manage-ann">
						<table style="width:100%" class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
								<th></th>
								<th>ID</th>
								<th>Author</th> 
								<th>Title</th>
								<th>Body</th>
								<th>Date</th>
							</tr>
							</thead>
						<?php
						foreach ($ann as $key => $value)
						{
							$user = $value['user_id'];
							$ann_user = Yii::$app->db->createCommand('SELECT id, position_id, superuser, parent_id, username, email FROM users WHERE id='.$id.'')->queryAll();
							
							foreach ($ann_user as $key2 => $value2)
											{ 
											 $author = $value2['username'];
											}
											
						?>
							
							  <tr>
								<td><input type="checkbox" name="check_list[]" value="<?php echo $value['announcement_id']; ?>"></td>
								<td><?php echo $value['announcement_id']; ?></td>
								<td><?php echo $author;?></td>
								<td><?php echo $value['title']; ?></td>
								<td><?php echo $value['body']; ?></td>
								<td><?php echo $value['date']; ?></td>
							  </tr>

							<?php
						}
						?>
						</table>			
					</br>
					<button name="edit" value="edit" class="btn-primary">Edit</button>
					
					<button name="del" onclick="return confirm('Are you sure?')" class="btn-warning">Delete</button>
					</form>
					<a href="tenant2/web/index.php?r=site/page&view=add-announcement"><button class="btn-primary">Create New</button></a>
				</br>
				<?php
			} 
		}
	}
	if(isset($_GET['check_list']) && isset($_GET['del']))
	{	
		foreach($_GET['check_list'] as $selected) {
			$command = Yii::$app->db->createCommand();
			$sql 	 = $command->delete('announcements', 'announcement_id=:id', array(
						':id'		=> $selected
						));
		}
		if(!$sql->execute())
		{
			Yii::$app->response->redirect("index.php?r=site/page&view=manage-ann&msg=failed")->send();
			//header("Location: index.php?r=site/page&view=manage-ann&msg=failed");
		}
		else
		{
			Yii::$app->response->redirect("index.php?r=site/page&view=manage-ann&msg=success")->send();
		} 
	}
	if(isset($_GET['check_list']) && isset($_GET['edit'])) 
	{	
		foreach($_GET['check_list'] as $selected) {
			Yii::$app->response->redirect("index.php?r=site/page&view=edit-announcement&check_list=".$selected."")->send();
			//header("Location: index.php?r=site/page&view=edit-announcement&check_list=".$selected."");
		}
	}
}
else {
	header('Location: index.php?r=user/login');	
}
?>
<style>
th {
	text-align:left;
}
</style>