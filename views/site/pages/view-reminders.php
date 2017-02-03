<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Reminders';
$this->breadcrumbs=array(
	'Property Reminders',
);
?>

<?php

	if(isset($_POST['addreminder']))
	{
		add_reminder();
	}
?> 

<h1>Property Reminders</h1>
<hr>
<?php 
$reminders = fetch_reminders();

foreach ($reminders as $key => $value)
{
	?>
	<p style="font-size:14px; font-weight:bold;"><?php echo $value['reminder_name'];?></p>
	<p><span>Reminder Category: </span><span><?php echo $value['reminder_category'];?></span></p>
	<p><span>Next Service: </span><span><?php echo $value['next_service'];?></span></p>
	<p><span>Details: </span><span><?php echo $value['details'];?></span></p>
	</br></br></br>
	<?php
}

?>
<hr>
<form method="POST">
<h2>Add new Reminder</h2>
<label for="srn">Service Reminder Name</label>
<input type="text" name="srn" id="srn" class="form-control" style="width:60%;">

<label for="category">Service Category</label>
<select name="category" id="category">
  <optgroup label="Home Improvement">
    <option value="1">Appliance Repair</option>
    <option value="2">Air Conditioning Installation</option>
    <option value="3">Carpet Installation</option>
    <option value="4">Concrete Installation</option>
    <option value="5">Electrical</option>
    <option value="6">Exterior Painting</option>
  </optgroup>
  <optgroup label="Cleaning">
    <option value="7">Commercial Cleaning</option>
    <option value="8">Cleaning Out</option>
    <option value="9">House Cleaning</option>
    <option value="10">Junk Removal</option>
    <option value="11">Furniture Cleaning</option>
    <option value="12">Window Cleaning</option>
  </optgroup>
  <optgroup label="Landscaping and Lawn Care">
    <option value="13">Fence Installation</option>
    <option value="14">Fence Repair</option>
    <option value="15">Fertilizing</option>
    <option value="16">Gardening</option>
    <option value="17">Landscaping</option>
    <option value="18">Sprinkler Installation</option>
    <option value="19">Tree Stump Grinding and Removal</option>
  </optgroup>
  <optgroup label="Other">
    <option value="other">Other</option>
  </optgroup>
</select>

<label for="priority">Service Priority Level</label>
<select name="priority" id="priority">
	<option value="1">Low</option>
    <option value="2">Normal</option>
    <option value="3">High</option>
    <option value="4">Critical</option>
</select>

<label for="nxtservice">Next Service Date</label>
<input type="date" name="nxtservice">

<label for="schedule">Schedule</label>
<select name="schedule" id="schedule">
	<option value="1">Monthly</option>
    <option value="2">Quarterly</option>
    <option value="3">Semi-Anually</option>
    <option value="4">Anually</option>
</select>

<label for="details">Details</label>
<textarea name="details" style="width:60%; height:160px;" placeholder="Write service detailes here..."></textarea>
</br>
<input type="submit" name="addreminder" value="Submit">
</form>

<?php

function add_reminder()
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();
	
	$command = Yii::app()->db->createCommand();
	$command->insert('reminders', array(
					 'property_id'		=> $_GET['property'],
    				 'reminder_name'	=> $_POST['srn'],
					 'reminder_category'=> $_POST['category'],
					 'priority'			=> $_POST['priority'],
					 'next_service' 	=> $_POST['nxtservice'],
					 'schedule' 		=> $_POST['schedule'],
					 'details'			=> $_POST['details']
    				 ));
   

}

function fetch_reminders()
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();

	$reminders = Yii::app()->db->createCommand()
    ->select('*')
    ->from('reminders')
    ->where('property_id='.$_GET['property'])
    ->queryAll();

    return $reminders;
}

?>