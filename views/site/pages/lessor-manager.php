<?php
/* @var $this SiteController */
$this->title = 'Lessor Manager';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">
<h3 class="header">Lessor Manager
                <span class="header-line"></span> 
</h3>
<div class="container">
<div class="wrap">
<?php

	$con = Yii::$app->db;
	$id  = Yii::$app->user->getId();
	$nr = 0;
	$cbox = 0;
	//$command  = Yii::app()->db->createCommand();
	$tenant = Yii::$app->db->createCommand('SELECT tenant_id, first_name, middle_name, last_name, company, email, phone FROM tenant WHERE user_id='.$id.'')->queryAll();
    
    foreach ($tenant as $key => $value)
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
				<?php
				$s1 = $value['first_name'];
				$s2 = $value['last_name'];	?>
				<div class="innerbox">
					<svg width="38px" height="38px" viewBox="0 0 38 38" enable-background="new 0 0 38 38" xml:space="preserve">
						<path class="connect circle-1" d="M24.698,11.322c-1.102-1.102-2.441-1.86-3.889-2.307c0.306,1.036,0.307,2.172,0.003,3.209
								c0.642,0.308,1.246,0.7,1.765,1.219c1.228,1.228,1.903,2.86,1.903,4.596s-0.676,3.368-1.903,4.597
								c-1.229,1.228-2.86,1.903-4.597,1.903s-3.368-0.676-4.596-1.903c-0.812-0.812-1.365-1.806-1.659-2.885
								c-0.296,0.05-0.605,0.082-0.934,0.082c-0.848,0-1.582-0.177-2.207-0.477c0.279,2.037,1.199,3.922,2.678,5.402
								c1.794,1.794,4.18,2.782,6.717,2.782s4.923-0.988,6.718-2.782c1.794-1.795,2.782-4.181,2.782-6.718S26.492,13.117,24.698,11.322z"></path>
						<path class="connect circle-2" d="M12.125,19.04c-4.411,0-8-3.589-8-8s3.589-8,8-8s8,3.589,8,8S16.536,19.04,12.125,19.04z M12.125,6.04c-2.757,0-5,2.243-5,5
							s2.243,5,5,5s5-2.243,5-5S14.882,6.04,12.125,6.04z"></path>
					</svg>
					<div class="tenant-avatar ta<?php echo rand(1, 3);?>"><?php echo $s1[0]. $s2[0]; ?></div>
					<h3><a href="index.php?r=site/page&view=tenant-detail&id=<?php echo $value['tenant_id'];?>"><?php echo $value['last_name'] . ', ' . $value['first_name'] . ' '. $value['middle_name'];?></a></h3>
					<p>Phone: <?php echo $value['phone']; ?></p>
					<p>Email: <?php echo $value['email'];?></p>
					<p>Company: <?php echo $value['company'];?></p>
					<a href="index.php?r=site/page&view=im&id=<?php echo $value['tenant_id'];?>"><div class="tenant-but">Messages</div></a>
					<a href=""><div class="tenant-but">Leases</div></a>
					<a href=""><div class="tenant-but">Payments</div></a>
					<a href="index.php?r=site/page&view=lease"><div class="tenant-but">Leases</div></a>
				</div>
			</div>
    	<?php
		$nr +=1;
    }
?>
</div>
</div>
<p>Results: <?php echo $nr; ?></p>
</div>
<style>	
.wrap{
  margin-left:20px;
}
.box{
  width:30%;
  float:left;
  background-color:white; 
  margin:25px 15px;
  border-radius:5px;
  min-height: 447px;
  padding-bottom: 20px;
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
  background-color: #A19B9B;
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
.container {
    padding-left: 0px!important;
}

h3.header {
    padding: 5px 0 0 39px;
}
</style>