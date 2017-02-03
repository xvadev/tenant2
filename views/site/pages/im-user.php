<h1>Messaging</h1>

<?php

$logged_id  = Yii::app()->user->getId();

	if(isset($_POST['send']) && !empty($_POST['message']))
	{
	$con     = Yii::app()->db;
	$command = Yii::app()->db->createCommand();
	$sql 	 = $command->insert('messages', array(
					 'parent_message'	=> $_POST['parent'],
    				 'user_profile_id'	=> $logged_id,
					 'tenant_profile_id'=> $_GET['id'],
					 'sender'           => $logged_id,
					 'message'		=> $_POST['message'],
					 'date_started' => date("Y-m-d H:i:s"),
					 'date_sent'    => date("Y-m-d H:i:s"),
					 'read_status'  => 1
    				 ));
	}
?>	

<?php
$messages   = retrieve_messages();
$header     = retrieve_header($messages);
$logged_id  = Yii::app()->user->getId();
?>
<?php if(!empty($messages)){ 
	?>
<p>
<span style="font-weight:bold;">Recipient:</span> <?php echo $header['recipient'];?></br>
<span style="font-weight:bold;">Date Started:</span> <?php echo $header['date_started'];?>
</p>

<div class="conversation-container">
<?php 

	foreach ($messages as $key => $value)
	{
		?>
		<div class="msg-container">
			<p class="msg-date-sent">Date Sent: <?php echo $value['date_sent'];?></p>
			<p class="msg"><?php echo $value['message'];?></p>
			<p class="msg-sender">
			<?php if($value['sender'] == $logged_id){echo "You";}else{ echo $header['recipient']; }?>	
			</p>
		</div>
		<?php
	}
//print_r($messages);
?>
</div>

<?php 
}else
{
	?>
	<p>
		<span style="font-weight:bold;">Recipient:</span> <?php echo $header['recipient'];?></br>
		<span style="font-weight:bold;">Date Started:</span> <?php echo $header['date_started'];?>
	</p>
	<?php
} 

?>
<div class="msg-form">
<form method="POST">

<span>Reply: </span>
</br>
<input type="hidden" name="parent" value="<?php echo $header['message_id'];?>">
<textarea style="width:50%; height:160px;" name="message" placeholder="Write your message here..."></textarea>
<p></p>
<input type="Submit" name="send" value="Send">
</form>
</div>


<?php

function retrieve_messages()
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();

	$tickets = Yii::app()->db->createCommand()
	->select('first_name, last_name, date_started, message, date_sent, user_profile_id, tenant_profile_id, message_id, sender')
	->from('messages')
	->join('tenant', 'messages.tenant_profile_id = tenant.tenant_id')
	->where('tenant_profile_id='.$_GET['id'].' AND user_profile_id='.$logged_id)
	->queryAll();

	return $tickets;
}

function retrieve_header($messages)
{
	if(!empty($messages))
	{
		$a = $messages[0];

		return array('date_started' => $a['date_started'], 
					 'recipient' => $a['first_name']." ".$a['last_name'], 
					 'message_id' => $a['message_id']);
	}
	else
	{
		return array('date_started' => 'No conversations yet..', 
					 'recipient' => retrieve_profile(), 
					 'message_id' => '');
	}
}

function retrieve_profile()
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();

	$user = Yii::app()->db->createCommand()
	->select('first_name, last_name')
	->from('tenant')
	->where("tenant_id = ".$_GET['id'])
	->queryAll();

	$user = $user[0];
	$user = $user['first_name']." ".$user['last_name'];

	return $user;
}

//print_r($header);
?>


<style>
.msg-container
{
	border:1px solid #ccc;
	border-radius: 6px;
	padding:10px 10px 2px 10px;
	width:60%;
	margin-top: 8px;
}

.msg-date-sent
{
	font-size:11px;
	color: #999;
}

.msg-sender
{
	text-align: right;
	padding:0px;
	margin:0px;
	font-size:10px;
	color:#999;
}

.msg-form
{
	margin-top: 30px;
}
</style>