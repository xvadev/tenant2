<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\Query;

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
				<!--<a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=tenant-add">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>tenant</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=add-property">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>property</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=privilege">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 17px;" type="button">Manage</br>Privileges</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=manage-staff">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 17px;" type="button">Manage</br>Staff/User</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=manage-tickets">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 20px;     margin-top: 5px;" type="button">Manage</br>Tickets&nbsp;&nbsp;</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 13px;     margin-top: 5px;" type="button">add new</br>application</button>
				 </a>-->
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
				<!--<a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=tenants">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 24px;" type="button">view</br>tenants</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=my-properties">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 15px;" type="button">view</br>properties</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">view</br>contacts</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 10px;" type="button">view</br>applications</button>
				 </a>-->
				 
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
			if($pos == 3) {
				?>
			<h1>Building Manager Dashboard</h1>
			<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Tenants</span>
              <div class="count">
			  
			  <?php
				$tenantnums = 0 ;
				$fetchnumtenant = Yii::$app->db->createCommand('SELECT tenant_id, first_name, middle_name, last_name, company, email, phone, property_id FROM tenant')->queryAll();
				foreach ($fetchnumtenant as $key5 => $value5)
					{
						$value5['tenant_id'];
						if($value5 != ''){
						$tenantnums +=1;
						}
					}
					echo $tenantnums;
			  ?>
			  </div>
			  <span class="count_bottom green"><a class="green" href="index.php?r=site/page&view=manage-tenants">Click here to view</a></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Properties</span>
              <div class="count">
			  <?php
				$propertynums = 0 ;
				$property = Yii::$app->db->createCommand('SELECT id, user_id, name, street, city, county, state, country, mls, built FROM property')->queryAll();
				foreach ($property as $key6 => $value6)
					{
						$value6['id'];
						if($value5 != ''){
						$propertynums +=1;
						}
					}
					echo $propertynums;
			  ?></div>
			  <span class="count_bottom green"><a class="green" href="index.php?r=site/page&view=my-properties">Click here to view</a></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Overdue Tenants</span>
              <div class="count red">
						<?php
							
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
												echo $odcount;
						?>
			  </div>
              <span class="count_bottom red"><a class="red" href="index.php?r=site/page&view=manage-tenants">Click here to view</a></span>
            </div>
            
          </div>
			           <div class="row">
           <div class="col-md-6 col-xs-12">
           		<h3 class="header">QUICK BUTTONS
                    <span class="header-line"></span> 
                </h3>
				<!--<a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=tenant-add">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>tenant</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=add-property">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">add new</br>property</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=privilege">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 17px;" type="button">Manage</br>Privileges</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=manage-staff">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 17px;" type="button">Manage</br>Staff/User</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=manage-tickets">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 20px;     margin-top: 5px;" type="button">Manage</br>Tickets&nbsp;&nbsp;</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 13px;     margin-top: 5px;" type="button">add new</br>application</button>
				 </a>-->
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
				<!--<a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=tenants">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 24px;" type="button">view</br>tenants</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="index.php?r=site/page&view=my-properties">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 15px;" type="button">view</br>properties</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 21px;" type="button">view</br>contacts</button>
				 </a>
				 <a ui-sref="tenants.add" class="col-md-2" href="#">
                 <button class="btn btn-large btn-primary" style="border-radius: 50%; padding: 30px 10px;" type="button">view</br>applications</button>
				 </a>-->
				 
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
			</div>
				<?php
			}
			if($pos == 7) {
				?>
				<h1>Tenant Dashboard</h1>
				<?php
				$t_details = $con->createCommand('SELECT * FROM tenant WHERE parent_id='.$parent)->queryAll();
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
						<a href="index.php?r=site/page&view=my-tickets">Manage</a>
				   </div>
				   <div class="span6">
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
