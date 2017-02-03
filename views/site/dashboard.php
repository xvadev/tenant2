<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$guest = Yii::$app->user->isGuest;

if($guest == true)
{
	return $this->redirect("index.php");
	exit();
}
else
{

	echo "NOT GUEST";
	$con = Yii::$app->db;
	$id  = Yii::$app->user->id;

	




if($id > 0) {
$mem_type = Yii::app()->db->createCommand()
    ->select('id, position_id, superuser, parent_id, username, email')
    ->from('users')
    ->where('id='.$id)
    ->queryAll();
	
	foreach ($mem_type as $key => $value)
    { 
		$parent =  $value['id'];
		$isadmin = $value['superuser'];
		$uname = $value['username'];
		$pos = $value['position_id'];
		if($isadmin > 0) {
			
			?>
			<h1>Admin Dashboard</h1>
			
           <div class="row-fluid">
           <div class="col-md-7">
           		<h3 class="header">QUICK BUTTONS
                    <span class="header-line"></span> 
                </h3>
				<a ui-sref="tenants.add" class="col-md-2" href="/tenant/index.php?r=site/page&view=tenant-add">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>tenant</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="/tenant/index.php?r=site/page&view=add-property">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>property</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="/tenant/index.php?r=site/page&view=privilege">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 13px;" type="button">Manage</br>Privileges</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="/tenant/index.php?r=site/page&view=manage-staff">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 13px;" type="button">Manage</br>Staff/User</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="/tenant/index.php?r=site/page&view=manage-tickets">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 20px;     margin-top: 5px;" type="button">Manage</br>Tickets&nbsp;&nbsp;</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 10px;     margin-top: 5px;" type="button">add new</br>application</button>
				 </a>
           </div>
           <div class="span6">
           		<h3 class="header">VIEWS
                    <span class="header-line"></span> 
                </h3>
				<a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=tenants">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 22px;" type="button">view</br>tenants</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=my-properties">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 12px;" type="button">view</br>properties</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 18px;" type="button">view</br>contacts</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 7px;" type="button">view</br>applications</button>
				 </a>
           </div>
        </div>
		<div class="row-fluid">
				<div class="span6">
						<h3 class="header">Announcements
							<span class="header-line"></span> 
						</h3>
							
						
							<?php
							$ann = Yii::app()->db->createCommand()
							->select('announcement_id, user_id, title, body, date')
							->from('announcements')
							//->where('user_id='.$id)
							->queryAll();
							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$ann_user = Yii::app()->db->createCommand()
								->select('id, position_id, superuser, parent_id, username, email')
								->from('users')
								->where('id='.$user)
								->queryAll();
								foreach ($ann_user as $key2 => $value2)
												{ 
												 $author = $value2['username'];
												}
												
							?>
							<div class="square-background <?php
							if($nums & 1) {
								echo "square-colored";
							}
							else {
								echo "";
							}
																?> clearfix">
							<div class="square square-back  pull-left">
								<img src="/tenant/themes/hebo/img/icons/smashing/60px/60px-05.png" alt="" class="">
							</div>
							 <h4><?php echo $value['title']; ?></h4>
							 <p><?php echo $value['body']; ?></p>
							 <p>Author: <?php echo $author;?> Date: <?php echo $value['date']; ?></p>
							 </div>
							<?php
							}
							?>
							<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Manage</button>
								</a>
							</div>
				</div>
				<div class="span6">
							<h3 class="header">Tools
								<span class="header-line"></span> 
							</h3>
							<blockquote>
							  <p>Manage Tenants - Interact with tenant database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-tenants">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Owners - Interact with Owners Database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-owner">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Announcements - Interact with Announcements database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Tickets - Interact with Ticketing System<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-tickets">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							
							
				</div>
			</div>
			<?php
		}
		else {
			if($pos == 3) {
				?>
			<h1>Building Manager Dashboard</h1>
			<div class="row-fluid">
				<div class="span6">
					<h3 class="header">QUICK BUTTONS
						<span class="header-line"></span> 
					</h3>
					<a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=tenant-add">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 18px;" type="button">add new</br>tenant</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=add-property">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 18px;" type="button">add new</br>property</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=manage-privilege">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 13px;" type="button">Manage</br>Tickets</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="#">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 10px;" type="button">add new</br>application</button>
					 </a>
				</div>
				<div class="span6">
					<h3 class="header">VIEWS
						<span class="header-line"></span> 
					</h3>
					<a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=tenants">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 22px;" type="button">view</br>tenants</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="/tenant/index.php?r=site/page&view=my-properties">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 12px;" type="button">view</br>properties</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="#">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 18px;" type="button">view</br>contacts</button>
					 </a>
					 <a ui-sref="tenants.add" class="col-xs-8 col-sm-4 col-md-8 border-bottom" href="#">
					 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 7px;" type="button">view</br>applications</button>
					 </a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
						<h3 class="header">Announcements
							<span class="header-line"></span> 
						</h3>
							
						
							<?php
							$ann = Yii::app()->db->createCommand()
							->select('announcement_id, user_id, title, body, date')
							->from('announcements')
							//->where('user_id='.$id)
							->queryAll();
							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$ann_user = Yii::app()->db->createCommand()
								->select('id, position_id, superuser, parent_id, username, email')
								->from('users')
								->where('id='.$user)
								->queryAll();
								foreach ($ann_user as $key2 => $value2)
												{ 
												 $author = $value2['username'];
												}
												
							?>
							<div class="square-background <?php
							if($nums & 1) {
								echo "square-colored";
							}
							else {
								echo "";
							}
																?> clearfix">
							<div class="square square-back  pull-left">
								<img src="/tenant/themes/hebo/img/icons/smashing/60px/60px-05.png" alt="" class="">
							</div>
							 <h4><?php echo $value['title']; ?></h4>
							 <p><?php echo $value['body']; ?></p>
							 <p>Author: <?php echo $author;?> Date: <?php echo $value['date']; ?></p>
							 </div>
							<?php
							}
							?>
							<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Manage</button>
								</a>
							</div>
				</div>
				<div class="span6">
							<h3 class="header">Tools
								<span class="header-line"></span> 
							</h3>
							<blockquote>
							  <p>Manage Tenants - Interact with tenant database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-tenants">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Owners - Interact with Owners Database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-owner">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Announcements - Interact with Announcements database<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Tickets - Interact with Ticketing System<div style="text-align:left;float:right;">
								<a href="/tenant/index.php?r=site/page&view=manage-tickets">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							
							
				</div>
				</div>
			</div>
				<?php
			}
			if($pos == 7) {
				?>
				<h1>Tenant Dashboard</h1>
				<?php
				$t_details = Yii::app()->db->createCommand()
				->select('tenant_id, first_name, middle_name, last_name, company, email, phone, dob, gender')
				->from('tenant')
				->where('parent_id='.$parent)
				->queryAll();
				foreach ($t_details as $key2 => $value2)
				{ 
					?>
					<div class="row-fluid">
					<div class="span6">
					<h3 class="header">MY DETAILS
                    <span class="header-line"></span> 
                    </h3>
					<div class="namehead">
					<h3><a href="index.php?r=site/page&view=dashboard" style="color: #fff;"><?php echo $value2['last_name'] . ', ' . $value2['first_name'] . ' '. $value2['middle_name'];?></a></h3>
					</div>
					<div class="namecont">
					<p class="ind"><b>Username:</b> <?php echo $uname; ?></p>
					<p class="ind"><b>Phone:</b> <?php echo $value2['phone']; ?></p>
					<p class="ind"><b>Email:</b> <?php echo $value2['email'];?></p>
					<p class="ind"><b>Company:</b> <?php echo $value2['company'];?></p>
					<p class="ind"><b>Date of Birth:</b> <?php echo $value2['dob'];?></p>
					<p class="ind"><b>Gender:</b> <?php echo $value2['gender'];?></p>
					</div>
					</div>
					<?php
				}
				
				?>
				<div class="row-fluid">
				   <div class="span6">
						<h3 class="header">Tickets
							<span class="header-line"></span> 
						</h3>
						<?php
						function retrieve_tickets()
						{
							$connection = Yii::app()->db;
							$logged_id  = Yii::app()->user->getId();

							$tickets = Yii::app()->db->createCommand()
							->select('ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_user, status, date_sent, lastname, firstname')
							->from('tickets')
							->join('profiles', 'tickets.sender_id = profiles.user_id')
							->where('sender_id='.$logged_id." AND parent_ticket_id=0")
							->queryAll();

							return $tickets;
						}

						function check_unread($unread)
						{
							if($unread == 0)
							{
								return "Read";
							}
							else
							{
								return "Unread";
							}
						}
						?>
						<table class="table table-striped table-bordered table-hover">
							<tr>
							<th>Title</th>
							<th>Sender</th>
							<th>Started Date</th>
							<th>Status</th>
							</tr>
							<?php
								$tickets = retrieve_tickets();
								foreach ($tickets as $key => $value)
								{
									?>
									<tr>
										<td>
											<?php
												if( $value['unread_user'] == 1)
												{
													?>
													<a style="" href="index.php?r=site/page&view=my-tickets-read&ticket_id=<?php echo $value['ticket_id'];?>">
														<?php echo $value['title'];?>	
													</a>
													<?php
												}
												else
												{
													?>
													<a style="color:rgba(51,51,51,0.81);" href="index.php?r=site/page&view=my-tickets-read&ticket_id=<?php echo $value['ticket_id'];?>">
														<?php echo $value['title'];?>	
													</a>
													<?php
												}
											?>	
										</td>
										<td><?php echo $value['firstname']." ".$value['lastname'];?></td>
										<td><?php echo $value['date_sent'];?></td>
										<td><?php echo check_unread($value['unread_user']);?></td>
									</tr>
									<?php
								}
							?>
						</table>
						<a href="/tenant/index.php?r=site/page&view=my-tickets">Manage</a>
				   </div>
				   <div class="span6">
						<h3 class="header">Announcements
							<span class="header-line"></span> 
						</h3>
							
						
							<?php
							$ann = Yii::app()->db->createCommand()
							->select('announcement_id, user_id, title, body, date')
							->from('announcements')
							//->where('user_id='.$id)
							->queryAll();
							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$ann_user = Yii::app()->db->createCommand()
								->select('id, position_id, superuser, parent_id, username, email')
								->from('users')
								->where('id='.$user)
								->queryAll();
								foreach ($ann_user as $key2 => $value2)
												{ 
												 $author = $value2['username'];
												}
												
							?>
							<div class="square-background <?php
							if($nums & 1) {
								echo "";
							}
							else {
								echo "square-colored";
							}
																?> clearfix">
							<div class="square square-back  pull-left">
								<img src="/tenant/themes/hebo/img/icons/smashing/60px/60px-05.png" alt="" class="">
							</div>
							 <h4><?php echo $value['title']; ?></h4>
							 <p><?php echo $value['body']; ?></p>
							 <p>Author: <?php echo $author;?> Date: <?php echo $value['date']; ?></p>
							 </div>
							<?php
							}
							?>
						
				   </div>
				</div>
				<?php
			}
		}
	}
}
else {
	
}
}
	?>

<style>
.dash-menu
{
	float:left;
	cursor:pointer;
	height:90px;
	text-align: center;
	line-height: 90px;
	border:1px solid #C9E0ED;
}
.dash-menu:hover
{
	background: #f5efef;
}

.vertical-spacer
{
	padding-top: 20px;
	padding-bottom: 20px;
	width:100%;
}
</style>
