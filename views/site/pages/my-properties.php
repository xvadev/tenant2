<?php 
  
  $user  = Yii::$app->user->getId();
  if(!isset($user))
  {
    $this->redirect("?r=user/login");
  }

?>


<?php
/* @var $this SiteController */

use yii\helpers\Html;
use yii\db\Query;

//$this->title = 'My Property';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row-fluid">
<h3 class="header">Properties
                <span class="header-line"></span> 
</h3>
<div class="container">
  <div class="row-fluid">
<?php

	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();
	$cbox = 0;
	//$command  = Yii::$app->db->createCommand();
	$property = Yii::$app->db->createCommand('SELECT id, user_id, name, street, city, county, state, country, mls, built FROM property WHERE user_id='.$id.'')->queryAll();
    

     foreach ($property as $key => $value)
    {
    	?>
		
		<div class="<?php if ($cbox <= 6) {
					$cbox +=1;
					echo 'box box'.$cbox.' shadow1';
				}
				else {
					$cbox = 1;
					echo 'box box'.$cbox.' shadow1';	
				}
				?>">
				<div class="innerbox">
					<div class='pr-img'>
					<img src="https://home.tenantcloud.com/images/stubs/buildingava/220x220.jpg" imageonload="" class="img-responsive s-image--loading_success" ng-src="https://home.tenantcloud.com/images/stubs/buildingava/220x220.jpg" alt="avatar">
					</div>
					<div class='pr-detail'>
					<h3><a href="index.php?r=site/page&view=tenant-detail&id=<?php echo $value['id'];?>"><?php echo $value['name'];?></a></h3>
					<p><?php echo $value['street'].", ".$value['city'].", ".$value['county'].", ".$value['state'].", ".$value['country'];?></p>
					<p>MLS No. :<?php echo $value['mls']; ?></p>
					<p>Year Built: <?php echo $value['built'];?></p>
					</div>
					<a href="?r=site/page&view=tenant-add&property=<?php echo $value['id'];?>"><div class="tenant-but">+ Add new tenant</div></a>
					<a href="?r=site/page&view=view-property&property=<?php echo $value['id'];?>"><div class="tenant-but">Property Details</div></a>
          <a href="?r=site/page&view=view-reminders&property=<?php echo $value['id'];?>"><div class="tenant-but">Reminders</div></a>
				</div>
			</div>
		
    	<!--<div class="row" style="margin:0px; border:1px solid #5bc0de; border-radius:5px; padding:4px 4px 6px 24px; margin-bottom:10px; width:40%;">
    		<h3><?php //echo $value['name'];?></h3>
    		<p><?php //echo $value['street'].", ".$value['city'].", ".$value['county'].", ".$value['state'].", ".$value['country'];?></p>
    		<p>MLS No. :<?php //echo $value['mls']; ?></p>
    		<p>Year Built: <?php //echo $value['built'];?></p>
    		<p>
    			<a href="?r=site/page&view=tenant-add&property=<?php //echo $value['id'];?>" class="btn btn-primary">+ Add new tenant</a>
    			<a href="?r=site/page&view=view-property&property=<?php //echo $value['id'];?>" class="btn btn-warning">Property Details</a>
    		</p>
    	</div>-->
    	<?php
    }
?>
</div>
</div>

<style>	
.wrap{
  margin-left:20px;
}
.box{
  width:85%;
  float:left;
  background-color:white; 
  margin:25px 15px;
  border-radius:5px;
  min-height: 253px;
  padding-bottom: 20px;
}
div.box{
  overflow-y: hidden;
  overflow-x: hidden;
}
.box h3{
  font-family: 'Didact Gothic', sans-serif;
  font-weight:normal;
  color:#fff;
}
.box1{
  background-color: #E1D3D2;
}
.box2{
  background-color: #CBC2C2;
}
.box3{
  background-color: #B3AFAF;
}
.box4{
  background-color: #E1D3D2;
}
.box5{
  background-color: #CBC2C2;
}
.box6{
  background-color: #A19B9B;
}
.box7{
  background-color: #DB9EEB;
}
.box8{
  background-color: #C49EEB;
}
.shadow1, .shadow2, .shadow3,.shadow4,.shadow5,.shadow6,.shadow7,.shadow8{
  position:relative;
}
.shadow1,.shadow2,.shadow3,.shadow4,.shadow5,.shadow6,.shadow7,.shadow8{
    box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;
}
/*****************************************************************dashed border
****************************************************************/
.shadow1 h3, .shadow2 h3, .shadow3 h3, .shadow4 h3, .shadow5 h3, .shadow6 h3, .shadow7 h3, .shadow8 h3{
  width:87%;
  margin-left: 5px;
}
.shadow1 p, .shadow2 p, .shadow3 p, .shadow4 p, .shadow5 p, .shadow6 p, .shadow7 p, .shadow8 p{
  margin-left: 5px;
}
.shadow1 a, .shadow2 a, .shadow3 a, .shadow4 a, .shadow5 a, .shadow6 a, .shadow7 a, .shadow8 a{
  color:#05415f;
}
.innerbox {
	border-radius:5px;
	margin: 20px;
	min-width: 100%;
}
/****************************************************************
*styling shadows
****************************************************************/
.shadow1:before, .shadow1:after{
  position:absolute;
  content:"";
  bottom:12px;left:15px;top:80%;
  width:45%;
  background:#9B7468;
  z-index:-1;
  -webkit-box-shadow: 0 20px 15px #9B7468;
  -moz-box-shadow: 0 20px 15px #9B7468;
  box-shadow: 0 20px 15px #9B7468;
  -webkit-transform: rotate(-6deg);
  -moz-transform: rotate(-6deg);
  transform: rotate(-6deg);
}
.shadow1:after{
  -webkit-transform: rotate(6deg);
  -moz-transform: rotate(6deg);
  transform: rotate(6deg);
  right: 15px;left: auto;
}
.
.shadow2:before, .shadow2:after{
  position:absolute;
  content:"";
  top:14px;bottom:14px;left:0;right:0;
  box-shadow:0 0 25px 3px #548E7F;
  border-radius:100px/10px;
  z-index:-1;
}

.shadow3:before, .shadow3:after{
  position:absolute;
  content:"";
  top:100px;bottom:5px;left:30px;right:30px;
  z-index:-1;
  box-shadow:0 0 40px 13px #486685;
  border-radius:100px/20px; 
}
.shadow7:before, .shadow7:after{
  position:absolute;
  content:"1";
  top:25px;left:20px;bottom:150px;
  width:80%;
  z-index:-1;
  -webkit-transform: rotate(-6deg);
  -moz-transform: rotate(-6deg);
  transform: rotate(-6deg);
}
.shadow7:before{
  box-shadow:10px -10px 30px 15px #984D8E;
}
.shadow7:after{
  -webkit-transform: rotate(7deg);
  -moz-transform: rotate(7deg);
  transform: rotate(7deg);
  bottom: 25px;top: auto;
  box-shadow:10px 10px 30px 15px #984D8E;
}
.shadow8{
  box-shadow:
 -6px -6px 8px -4px rgba(250,254,118,0.75),
  6px -6px 8px -4px rgba(254,159,50,0.75),
  6px 6px 8px -4px rgba(255,255,0,0.75),
  6px 6px 8px -4px rgba(0,0,255,2.75);
}
.tenant-but {
	width: 44%;
	float: left;
	text-align: center;
	padding-top: 25px;
	padding-bottom: 25px;
	border: 1px solid rgba(128, 128, 128, 0.13);
}
.tenant-but:hover {
	background:gray;
	color:white;
}
.tenant-avatar {
	text-align: center;
	color: #ffffff;
	margin-left;
	border-radius:250px;
	border-radius:50px;
    font-size:18px;
    line-height:50px;
    text-align:center;
    width: 50px;
	margin-left: 124px;
}
.ta1 {
	background-image: linear-gradient(to right bottom, #c398e0 0%, #be93db 33%, #ae7dcd 100%);
	background-image: -webkit-linear-gradient(left top, #c398e0 0%, #be93db 33%, #ae7dcd 100%);
}
.ta2 {
	background-image: -webkit-linear-gradient(left top, #36ce3d 0%, #39d229 33%, #59b35a 100%);
	background-image: linear-gradient(to right bottom, #36ce3d 0%, #39d229 33%, #59b35a 100%);
}
.ta3 {
	background-image: linear-gradient(to right bottom, #3ec795 0%, #41c997 33%, #26b37f 100%);
	background-image: -webkit-linear-gradient(left top, #3ec795 0%, #41c997 33%, #26b37f 100%);
}
.ta4 {
	background-image: linear-gradient(to right bottom, #c22e5d 0%, #842783 33%, #af47cf 100%);
	background-image: -webkit-linear-gradient(left top, #c22e5d 0%, #842783 33%, #af47cf 100%);
}
.ta5 {
	background-image: linear-gradient(to right bottom, #ecd428 0%, #BD511F 33%, #cfba47 100%);
	background-image: linear-gradient(to right bottom, #ecd428 0%, #BD511F 33%, #cfba47 100%);
}
.ta6 {
	background-image: linear-gradient(to right bottom, #2838ec 0%, #1F42BD 33%, #b0b2dd 100%);
	background-image: -webkit-linear-gradient(left top, #2838ec 0%, #1F42BD 33%, #b0b2dd 100%);
}
.pr-detail p {
    margin-right: 45px;
}
.pr-detail {
    float: right;
    text-align: right;
}
.pr-img {
    width: 126px;
    margin-left: -27px;
    float: left;
}
.container {
    padding-left: 0px!important;
}

h3.header {
    padding: 5px 0 0 90px;
}
</style>