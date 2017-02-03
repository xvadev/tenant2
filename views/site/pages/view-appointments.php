<?php
/* @var $this SiteController */

$this->title = 'Schedules and Appointment';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Schedules and Appointment</h1>
<?php 
	
	

?>
<form method="POST">
<h2>New Maintenance Request</h2>
<label for="srn">Request Title</label>
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


<label for="nxtservice">Desired Date</label>
<input type="date" name="nxtservice">



<label for="details">Details</label>
<textarea name="details" style="width:60%; height:160px;" placeholder="Write service detailes here..."></textarea>
</br>
<input type="submit" name="addreminder" value="Submit">
</form>