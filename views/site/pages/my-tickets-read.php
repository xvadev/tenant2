<?php
use yii\helpers\Html;
use yii\db\Query;

$connection = Yii::$app->db;
$logged_id  = Yii::$app->user->getId();


if(isset($_POST['send']))
{
	$con = Yii::$app->db;
	$command = Yii::$app->db->createCommand();
	$sql 	 = $command->insert('tickets', array(
					 'owner_id'	=> $_POST['owner'],
    				 'sender_id'	=> $_POST['sender'],
					 'parent_ticket_id'	=> $_POST['parent'],
					 'message'	=> $_POST['message'],
					 'date_sent' => date('Y-m-d'),
					 'unread_owner' => 0,
					 'status' => 0
    				 ));


	

	if(!$sql->execute())
	{
		header("Location: index.php?r=site/page&view=my-tickets-read&ticket_id=".$_POST['parent']."&msg=failed");
	}
	else
	{
		$command->update('tickets', 
					array('unread_owner' => 1), "ticket_id=:ids", array(':ids'=> $_GET['ticket_id'])
				 )->execute();
		header("Location: index.php?r=site/page&view=my-tickets-read&ticket_id=".$_POST['parent']."&msg=success");
	}
}

/*----------------------------*/
/*----------------------------*/
function retrieve_ticket($ticket)
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$tickets = (new \yii\db\Query())
	->select('ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_user, status, date_sent, lastname, firstname, message')
	->from('tickets')
	->join('INNER JOIN','profiles', 'tickets.sender_id = profiles.user_id')
	->where('ticket_id='.$ticket)
	->all();

	

	return $tickets[0];
}

/*----------------------------*/
/*----------------------------*/


function retrieve_replies($replies)
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$replies = (new \yii\db\Query())
	->select('message, date_sent, sender_id, owner_id')
	->from('tickets')
	->where('parent_ticket_id='.$replies)
	->all();

	return $replies;
}
/*----------------------------*/
/*----------------------------*/

?>

<?php
	$ticket = retrieve_ticket($_GET['ticket_id']);
?>


<style>
#message-sender
{
    width: 50%;
	margin: 10px 0px 10px 47%;
    text-align: justify;
    background: rgba(41, 204, 0, 0.64);
    color:#fff;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid rgba(41, 204, 0, 0.5);

}

#message-owner
{
	width: 50%;
	margin: 10px 0px 0px 0px;
    text-align: justify;
    background: #f2f2f2;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid rgba(70,70,70,0.06);
}
</style>
<p>
	<span style="color:rgba(51, 51, 51, 0.71); font-weight:bold;">Title: </span><span><?php echo $ticket['title'];?></span></br>
	<span style="color:rgba(51, 51, 51, 0.71); font-weight:bold;">Sender: </span><span><?php echo $ticket['firstname']." ".$ticket['lastname'];?></span></br>
	<span style="color:rgba(51, 51, 51, 0.71); font-weight:bold;">Date Received: </span><span><?php echo $ticket['date_sent'];?></span></br>
	<span style="color:rgba(51, 51, 51, 0.71); font-weight:bold;">Messages:</span>
</p>
<p id="message-sender">
	<span><?php echo $ticket['date_sent'];?></span></br></br>
	<?php echo $ticket['message'];?>
</p>

<?php

	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$replies = retrieve_replies($_GET['ticket_id']);

	foreach ($replies as $key => $value)
	{
		if($value['sender_id'] == $value['owner_id'])
		{
			?>
				<p id="message-owner">
				<span><?php echo $value['date_sent'];?></span></br></br>
				<?php echo $value['message'];?>
				</p>
			<?php
		}
		else
		{
			?>
				<p id="message-sender">
				<span><?php echo $value['date_sent'];?></span></br></br>
				<?php echo $value['message'];?>
				</p>
			<?php
		}
	}

?>
<div style="margin-top:70px;">
	<form method="POST">
	    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
		<input type="hidden" name="sender" value="<?php echo $logged_id; ?>">
		<input type="hidden" name="owner" value="<?php echo $ticket['owner_id'];?>">
		<input type="hidden" name="parent" value="<?php echo $_GET['ticket_id'];?>">

		<p style="font-weight:bold;">Send Reply</br></br>
			<span>Message:</span></br>
			<textarea style="width:60%; height:120px;" name="message" placeholder="Write a message..."></textarea>
			</br>
			</br>
			<input type="submit" name="send" value="Send">
		</p>

	</form>
</div>
<?php 
	
	if(isset($_GET['ticket_id']))
	{
		$command = Yii::$app->db->createCommand();
		$sql 	 = $command->update('tickets', 
					array('unread_user' => 0), "ticket_id=:ids", array(':ids'=> $_GET['ticket_id'])
				 )->execute();
	}
	
?>

