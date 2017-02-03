<h1>Messages</h1>
<?php

	$list = retrieve_messages_list();


?>
<table>
<th>From</th><th>Action</th><th>Date Sent</th><th>Status</th>
<?php
	foreach ($list as $key => $value) 
	{
		?>
		<tr>
			<td><?php echo $value['firstname']." ".$value['lastname'];?></td>
			<td><a href="index.php?r=site/page&view=user-messages-view&msg-id=<?php echo $value['message_id'];?>&user=<?php echo $value['user_profile_id'];?>">View</a></td>
			<td><?php echo $value['date_sent'];?></td>
			<td><?php echo $value['read_status'];?></td>
		</tr>
		<?php	
	}
?>
</table>




<?php
//Functions

function retrieve_messages_list()
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();

	$messages = Yii::app()->db->createCommand()
	->select('message_id, user_profile_id, tenant_profile_id, read_status, date_sent, firstname, lastname')
	->from('messages')
	->join('profiles', 'messages.user_profile_id = profiles.user_id')
	->where('parent_message = 0 AND tenant_profile_id = '.$logged_id)
	->queryAll();

	return $messages;
}

//print_r(retrieve_messages_list());

?>


<style>
th
{
	padding:6px 16px 6px 16px;
}
td
{
	text-align: center;
}
</style>