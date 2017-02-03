<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\Query;

if(!Yii::$app->user->isGuest){
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
$id  = '';
$con = Yii::$app->db;
$user = Yii::$app->user->identity->username;
$mem_id = $con->createCommand("SELECT * FROM users WHERE username='".$user."'")->queryAll();
foreach ($mem_id as $key => $values)
    { 
		$id =  $values['id'];
	}

if($id > 0) {
$mem_type = $con->createCommand('SELECT * FROM users WHERE id='.$id.'')->queryAll();
	
	foreach ($mem_type as $key => $value)
    { 
		$parent =  $value['id'];
		$isadmin = $value['superuser'];
		$uname = $value['username'];
		$pos = $value['position_id'];
		if($isadmin > 0) {
			
			?>
			<h1>Admin Dashboard</h1>
			
           <div class="row">
           <div class="col-md-6 col-xs-12">
           		<h3 class="header">QUICK BUTTONS
                    <span class="header-line"></span> 
                </h3>
				 <table class="table table-bordered" style="width:60%!important;">
                             
                              <tbody>
                                <tr>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=tenant-add">
								  <img src="../views/site/pages/img/add-tenant.PNG" alt="add tenant" height="" width="80"><b>Add New Tenant</b>
                 
				 </a>
				 </td>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=add-property">
                 <img src="../views/site/pages/img/add-prop.PNG" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>Add New Property</b>
				 </a>
				 </td>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=privilege">
                 <img src="../views/site/pages/img/privelege.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>Manage Priveleges</b>
				 </a></td>
                                </tr>
                                <tr>
                                  <td><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=manage-staff">
                 <img src="../views/site/pages/img/staff.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>Manage Staff/User</b>
				 </a>
				 </td>
                                  <td><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=manage-tickets">
                 <img src="../views/site/pages/img/18216_ticket_icon.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>Manage Tickets</b>
				 </a>
				 </td>
                                  <td><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="#">
                 <img src="../views/site/pages/img/add-application.PNG" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>Add New Application</b>
				 </a>
				 </td>
                                </tr>
                                
                              </tbody>
                            </table>
           </div>
           <div class="col-md-6 col-xs-12">
           		<h3 class="header">VIEWS
                    <span class="header-line"></span> 
                </h3>
				 
				 <table class="table table-bordered" style="width:60%!important;">
                             
                              <tbody>
                                <tr>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=tenants">
  
								  <img src="../views/site/pages/img/icon-tenant.png" alt="add tenant" height="" width="80"><b>View Tenants</b>
                 
				 </a>
				 </td>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="index.php?r=site/page&view=my-properties">
                 <img src="../views/site/pages/img/property.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>View Properties</b>
				 </a>
				 </td>
                                  <td style="width: 100px;"><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="#">
                 <img src="../views/site/pages/img/contacts.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>View Contacts</b>
				 </a></td>
                                </tr>
                                <tr>
                                  <td><a ui-sref="tenants.add" class="col-md-2" style="width: 100px;text-align: center;" href="#">
                 <img src="../views/site/pages/img/application.png" alt="add tenant" height="" width="60" style=" margin-top: 5px;"><b>View Applications</b>
				 </a>
				 </td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
           </div>
        </div>
		<div class="row-fluid">
				<div class="col-md-5">
						<h3 class="header">Announcements
							<span class="header-line"></span> 
						</h3>
							
						
							<?php
							$ann = $con->createCommand('SELECT * FROM announcements LIMIT 4')->queryAll();

							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$ann_user = $con->createCommand('SELECT * FROM users WHERE id='.$user)->queryAll();
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
								<a href="index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Manage</button>
								</a>
							</div>
				</div>
				<div class="col-md-7">
							<h3 class="header">Tools
								<span class="header-line"></span> 
							</h3>
							<blockquote>
							  <p>Manage Tenants - Interact with tenant database<div style="text-align:left;float:right;">
								<a href="index.php?r=site/page&view=manage-tenants">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Owners - Interact with Owners Database<div style="text-align:left;float:right;">
								<a href="index.php?r=site/page&view=manage-owner">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Announcements - Interact with Announcements database<div style="text-align:left;float:right;">
								<a href="index.php?r=site/page&view=manage-ann">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							<blockquote>
							  <p>Manage Tickets - Interact with Ticketing System<div style="text-align:left;float:right;">
								<a href="index.php?r=site/page&view=manage-tickets">
									<button class="btn btn-default btn-success" type="button">Go</button>
								</a>
							</div></p>
							</blockquote></br>
							
							
				</div>
			</div>
			<?php
		}
		else {
			
if($pos == 3) { ?>
<?php

	$tenantnums = 0 ;
	$propertynums = 0 ;

	$fetchnumtenant = Yii::$app->db->createCommand('SELECT tenant_id FROM tenant')->queryAll();
	foreach ($fetchnumtenant as $key5 => $value5)
		{
			$value5['tenant_id'];
			if($value5 != ''){
			$tenantnums +=1;
			}
		}


	$property = Yii::$app->db->createCommand('SELECT id FROM property')->queryAll();
	foreach ($property as $key6 => $value6)
		{
			$value6['id'];
			if($value5 != ''){
			$propertynums +=1;
			}
		}


	function get_overdues()
	{
		$odcount= 0;
		$ann = (new \yii\db\Query())
						->select('rent_id, tenant_id, start, end, payment_month, payment_status, full_payment, property_id, m_status, m_payment')
						->from('rent')
						->where("payment_status!='paid'")
						->all();
		foreach ($ann as $key2 => $value2)
							{	
							$lastpay2= '';
							$lastpay = $value2['m_payment'];
							$start = $value2['start'];
							if($lastpay != ''){
								$lastpay2 = $lastpay;
							}
							else {
								$lastpay2 = $start;
							}
							$today =date("m/d/Y"); 
							$ts1 = strtotime($today);
							$ts2 = strtotime($start);
							$year1 = date('Y', $ts1);
							$year2 = date('Y', $ts2);

							$month1 = date('m', $ts1);
							$month2 = date('m', $ts2);

							$diff = (($year2 - $year1) * 12) + ($month2 - $month1);	
							if($diff > 2){
								$odcount += 1;
							}
							}

			return $odcount;
	}
	
												

		
?>
<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-home"></i></div>
			<div class="count"><?php echo $propertynums; ?></div>
			<h3>Total Properties</h3>
			<p>&nbspView</p>
		</div>	
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-user"></i></div>
			<div class="count"><?php echo $tenantnums; ?></div>
			<h3>Total Tenants</h3>
			<p>&nbspView</p>
		</div>	
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-dollar"></i></div>
			<div class="count"><?php echo get_overdues(); ?></div>
			<h3>Overdue Tenants</h3>
			<p>&nbspView</p>
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="x_panel">
		<div class="x_title">
			<h2>Property<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
		<a href="index.php?r=site/page&view=add-property" class="btn btn-app"><i class="fa fa-file-text"></i>Add</a>
		<a href="index.php?r=site/page&view=my-properties" class="btn btn-app"><i class="fa fa-home"></i>Properties</a>
		<a href="index.php?r=site/page&view=my-properties" class="btn btn-app"><i class="fa fa-cogs"></i>Manage</a>
		<a href="#" class="btn btn-app"><i class="fa fa-remove"></i>Remove</a>
		</div>
	</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="x_panel">
		<div class="x_title">
			<h2>Tenants<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<a href="index.php?r=site/page&view=tenant-add" class="btn btn-app"><i class="fa fa-user"></i>New</a>
			<a href="index.php?r=site/page&view=tenants" class="btn btn-app"><i class="fa fa-users"></i>Tenants</a>
			<a href="index.php?r=site/page&view=manage-tenants"  class="btn btn-app"><i class="fa fa-cogs"></i>Manage</a>
			<a href="#" class="btn btn-app"><i class="fa fa-remove"></i>Remove</a>
		</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="x_panel">
		<div class="x_title">
			<h2>Website<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
		<a href="index.php?r=site/page&view=manage-staff"  class="btn btn-app"><i class="fa fa-sitemap"></i>Manage Staff</a>
		<a href="#" class="btn btn-app"><i class="fa fa-group"></i>Manage Users</a>
		<a href="index.php?r=site/page&view=privilege"  class="btn btn-app"><i class="fa fa-key"></i>Privileges</a>
		<a href="#" class="btn btn-app"><i class="fa fa-briefcase"></i>Owners</a>
		</div>
	</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="x_panel">
		<div class="x_title">
			<h2>Maintenance<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<a href="index.php?r=site/page&view=file-ticket" class="btn btn-app"><i class="fa fa-plus"></i>New Ticket</a>
			<a href="index.php?r=site/page&view=manage-tickets" class="btn btn-app"><i class="fa fa-ticket"></i>Tickets</a>
			<a href="#" class="btn btn-app"><i class="fa fa-comments-o"></i>Messages</a>
			<a href="#" class="btn btn-app"><i class="fa fa-volume-up"></i>Announcements</a>
		</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="x_panel">
		<div class="x_title">
			<h2>Announcements<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<div>
                        <ul class="messages">
						<?php
							$ann = $con->createCommand('SELECT * FROM announcements LIMIT 4')->queryAll();

							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$mon = date("M", strtotime($value['date']));
								$day = date("d", strtotime($value['date']));
								$ann_user = $con->createCommand('SELECT * FROM users WHERE id='.$user)->queryAll();
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
						?>clearfix">
							
							
                          <li>
                            <div class="avatar" style="width: 4%;display: block;position: absolute;"><i class="fa fa-comments-o" style="font-size:25px;"></i></div>
                            <div class="message_date">
                              <h3 class="date text-info"><?php echo $day; ?></h3>
                              <p class="month"><?php echo $mon; ?></p>
                            </div>
                            <div class="message_wrapper">
                              <h4><?php echo $value['title']; ?></h4>
                              <blockquote style="font-size:12px; font-weight:normal;"><?php echo $value['body']; ?></blockquote>
                              <br>
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-user"></i> <?php echo $author;?> </a>
                              </p>
                            </div>
                          </li>
                          <?php
							}
							?>
                        </ul>
                        <!-- end of user messages -->
						<a href="index.php?r=site/page&view=add-announcement" class="btn btn-app"><i class="fa fa-file-text"></i>Add</a>
						<a href="index.php?r=site/page&view=manage-ann" class="btn btn-app"><i class="fa fa-cogs"></i>Manage</a>
						<a href="index.php?r=site/page&view=manage-ann" class="btn btn-app"><i class="fa fa-remove"></i>Remove</a>

                      </div>
		</div>
		</div>
	</div>
</div>

				<?php
			}
			if($pos == 7) {
				?>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-home"></i></div>
								<div class="count"><?php echo "Jan 30, 2017"; ?></div>
								<h3>Next Payment Date</h3>
								<div class="count"><?php echo "Apr 30, 2017"; ?></div>
								<h3>Contract Expire</h3>
								<p><b>Address: </b></p>
								<small><p><b>Lessor: </b>Lena Bitag (0484564) - lena@imb.com</p></small>
							</div>	
						</div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tenant Dashboard <small>Profile Details</small></h2>
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

                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                      <div class="profile_img">

                        <!-- end of image cropping -->
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" style="width: 90%;" src="http://tr3.cbsistatic.com/fly/bundles/techrepubliccore/images/icons/standard/icon-user-default.png" alt="Avatar" title="Change the avatar">

                          <!-- Cropping modal -->
                          <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
                                  <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type="button">×</button>
                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="avatar-body">

                                      <!-- Upload image and data -->
                                      <div class="avatar-upload">
                                        <input class="avatar-src" name="avatar_src" type="hidden">
                                        <input class="avatar-data" name="avatar_data" type="hidden">
                                        <label for="avatarInput">Local upload</label>
                                        <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                      </div>

                                      <!-- Crop and preview -->
                                      <div class="row">
                                        <div class="col-md-9">
                                          <div class="avatar-wrapper"></div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="avatar-preview preview-lg"></div>
                                          <div class="avatar-preview preview-md"></div>
                                          <div class="avatar-preview preview-sm"></div>
                                        </div>
                                      </div>

                                      <div class="row avatar-btns">
                                        <div class="col-md-9">
                                          <div class="btn-group">
                                            <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                          </div>
                                          <div class="btn-group">
                                            <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                            <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="modal-footer">
                                                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                                  </div> -->
                                </form>
                              </div>
                            </div>
                          </div>
                          <!-- /.modal -->

                          <!-- Loading state -->
                          <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                        </div>
                        <!-- end of image cropping -->

                      </div>
					  <?php
						$t_details = $con->createCommand('SELECT * FROM tenant WHERE parent_id='.$parent)->queryAll();
						foreach ($t_details as $key2 => $value2)
						{ 
							?>
                      <h3><?php echo  $value2['first_name']." ".$value2['last_name'];?></h3>

                      <ul class="list-unstyled user_data">
                        <p class="ind"><b>Phone:</b> <?php echo $value2['phone']; ?></p>
									<p class="ind"><b>Email:</b> <?php echo $value2['email'];?></p>
									<p class="ind"><b>Company:</b> <?php echo $value2['company'];?></p>
									<p class="ind"><b>Date of Birth:</b> <?php echo $value2['dob'];?></p>
									<p class="ind"><b>Gender:</b> <?php echo $value2['gender'];?></p>
                      </ul>

                      <?php
						}
						
						?>
                      <br>

                      <!-- start skills -->
                      <div class="">
						<div class="tile-stats">
						  <div class="icon"><i class="fa fa-check-square-o"></i></div>
						  <div class="count">0</div>
						  <h3>Overdue Payments</h3>
						</div>
					  </div>
                      <!-- end of skills -->

                    </div>
					
					<div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Announcements</h2>
                        </div>
						
                      </div>
					  <div class="col-md-12">
                     <ul class="messages">
						<?php
							$ann = $con->createCommand('SELECT * FROM announcements LIMIT 4')->queryAll();

							foreach ($ann as $key => $value)
							{
								$nums = $value['announcement_id'];
								$user = $value['user_id'];
								$mon = date("M", strtotime($value['date']));
								$day = date("d", strtotime($value['date']));
								$ann_user = $con->createCommand('SELECT * FROM users WHERE id='.$user)->queryAll();
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
						?>clearfix">
							
							
                          <li>
                            <div class="avatar" style="width: 4%;display: block;position: absolute;"><i class="fa fa-comments-o" style="font-size:25px;"></i></div>
                            <div class="message_date">
                              <h3 class="date text-info"><?php echo $day; ?></h3>
                              <p class="month"><?php echo $mon; ?></p>
                            </div>
                            <div class="message_wrapper">
                              <h4><?php echo $value['title']; ?></h4>
                              <blockquote style="font-size:12px; font-weight:normal;"><?php echo $value['body']; ?></blockquote>
                              <br>
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-user"></i> <?php echo $author;?> </a>
                              </p>
                            </div>
                          </li>
                          <?php
							}
							?>
                        </ul>
						</div>
                      <!-- end of user-activity-graph -->

                      
                    </div>
					
                  </div>
					
                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Submitted Tickets</h2>
                        </div>
						</br>
                        <div class="col-md-6" style="text-align: right;">
							<a href="index.php?r=site/page&view=file-ticket"><button class="btn btn-success" style="margin-top: 2px;">Create</button></a>
                            <a href="index.php?r=site/page&view=my-tickets"><button class="btn btn-primary" style="margin-top: 2px;">Manage</button></a>
                        </div>
                      </div>
                     <?php
							function retrieve_tickets()
							{
								
								$connection = Yii::$app->db;
								$user = Yii::$app->user->identity->username;
								$mem_id = $connection->createCommand("SELECT * FROM users WHERE username='".$user."'")->queryAll();
								foreach ($mem_id as $key => $values)
									{ 
										$id =  $values['id'];
									}
								$logged_id  = $id;
								$tickets = $connection->createCommand("SELECT ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_user, status, date_sent, lastname, firstname FROM tickets LEFT OUTER JOIN profiles ON tickets.sender_id = profiles.user_id WHERE sender_id=$logged_id AND parent_ticket_id=0 LIMIT 5")->queryAll();

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
							<table class="table">
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
							
                      <!-- end of user-activity-graph -->

                      
                    </div>
					
					
                </div>
              </div>
			  </div>
			  </div>
			  <style>
			  .right_col {
				  height: 1000px;
			  }
			  </style>
			  
				<?php
			}
		}
	}
}
else {
	
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
td:hover {
    background-color: white;
}
</style>
<?php
}
else{
	?>
	<script type="text/javascript">
     (function(){
        
          window.location.href = 'http://45.32.35.90/tenant2/web/index.php?r=site/login';
        
        })();
     </script>
	<?php
}
?>