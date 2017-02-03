<?php
/* @var $this SiteController */

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'Read Ticket';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

if(isset($_POST['delete']))
{
	$con = Yii::$app->db;
	$command = Yii::$app->db->createCommand();
	$command->delete('tickets', "ticket_id=:ids", array(':ids'=> $_GET['ticket_id']));
	$command->delete('tickets', "parent_ticket_id=:ids", array(':ids'=> $_GET['ticket_id']));
	header("Location: index.php?r=site/page&view=manage-tickets&msg=success");
	return;
}

if(isset($_POST['dismiss']))
{
	$con = Yii::$app->db;
	$command = Yii::$app->db->createCommand();
	$command->update('tickets', 
					array('status' => 1), "ticket_id=:ids", array(':ids'=> $_GET['ticket_id'])
				 );
}
?>


<?php
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
		header("Location: index.php?r=site/page&view=read-ticket&ticket_id=".$_POST['parent']."&msg=failed");
	}
	else
	{
		$sql = $command->update('tickets', 
					array('unread_user' => 1), "ticket_id=:ids", array(':ids'=> $_POST['parent'])
				 );
		header("Location: index.php?r=site/page&view=read-ticket&ticket_id=".$_POST['parent']."&msg=success");
	}
}

/*----------------------------*/
/*----------------------------*/
/*----------------------------*/
function retrieve_ticket($ticket)
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$tickets = Yii::$app->db->createCommand('SELECT ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_owner, status, date_sent, lastname, firstname, message FROM tickets JOIN profiles ON tickets.sender_id = profiles.user_id WHERE ticket_id='.$ticket.'')->queryAll();
	/*->select('ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_owner, status, date_sent, lastname, firstname, message')
	->from('tickets')
	->join('profiles', 'tickets.sender_id = profiles.user_id')
	->where('ticket_id='.$ticket)
	->queryAll();*/

	

	return $tickets[0];
}

/*----------------------------*/
/*----------------------------*/


function retrieve_replies($replies)
{
	$connection = Yii::$app->db;
	$logged_id  = Yii::$app->user->getId();

	$replies = Yii::$app->db->createCommand('SELECT message, date_sent, sender_id, owner_id FROM tickets WHERE parent_ticket_id='.$replies.'')->queryAll();
	/*->select('message, date_sent, sender_id, owner_id')
	->from('tickets')
	->where('parent_ticket_id='.$replies)
	->queryAll();*/

	return $replies;
}
/*----------------------------*/
/*----------------------------*/

?>



<style>
#message-sender
{
	width: 50%;
	margin: 10px 0px 0px 0px;
    text-align: justify;
    background: #f2f2f2;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid rgba(70,70,70,0.06);
}

#message-owner
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
</style>

<?php
	$ticket = retrieve_ticket($_GET['ticket_id']);
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $ticket['title'];?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                      <a class="#">Posted by: <?php echo $ticket['firstname']." ".$ticket['lastname'];?> | </a>
                      </li>
                      <li>
                      <a class="#">on <?php echo $ticket['date_sent'];?></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Dismiss</a>
                          </li>
                          <li><a href="#">Delete Ticket</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                   <p class="" style="font-size:14px;"><?php echo $ticket['message'];?></p>

                   <?php

					$connection = Yii::$app->db;
					$logged_id  = Yii::$app->user->getId();

					$replies = retrieve_replies($_GET['ticket_id']);

					foreach ($replies as $key => $value)
					{
						if($value['sender_id'] == $value['owner_id'])
						{
							?>
								<div class="row">
			                   		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                   			<div class="x_panel">
			                   				 <div class="x_title">
							                    <h2>You</h2>
							                    <ul class="nav navbar-right panel_toolbox">
							                      <li>
							                      <a class="#"></a>
							                      </li>
							                      <li>
							                      <a class="#">Posted on :<?php echo $value['date_sent'];?></a>
							                    </ul>
							                    <div class="clearfix"></div>
							                 </div>
			                   				 <div class="clearfix"></div>
			                   				 
			                   				 <div class="x_content">
			                   				 	<p class="" style="font-size:14px;"><?php echo $value['message'];?></p>
			                   				 </div>
			                   				</div>
			                   		</div>
		                   		</div>
							<?php
						}
						else
						{
							?>
								<div class="row">
			                   		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			                   			<div class="x_panel" style="border:1px solid #1abb9c;">
			                   			<div class="x_title">
							                    <h2 style="color:#1abb9c;"><?php echo $ticket['firstname']." ".$ticket['lastname'];?></h2>
							                    <ul class="nav navbar-right panel_toolbox">
							                      <li>
							                      <a class="#"></a>
							                      </li>
							                      <li>
							                      <a class="#">Posted on :<?php echo $value['date_sent'];?></a>
							                    </ul>
							                    <div class="clearfix"></div>
							                 </div>
			                   				 <div class="clearfix"></div>
			                   				 
			                   				 <div class="x_content">
			                   				 	<p class="" style="font-size:14px;"><?php echo $value['message'];?></p>
			                   				 </div>
			                   				</div>
			                   		</div>
		                   		</div>
							<?php
						}
					}

				?>
                   
                  </div>
                </div>
	</div>
</div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h2>Post Reply: </h2>
	</div>
</div>

<form method="POST" class="form-horizontal form-label-left">
<input type="hidden" name="sender" value="<?php echo $logged_id; ?>">
<input type="hidden" name="owner" value="<?php echo $ticket['owner_id'];?>">
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<input type="hidden" name="parent" value="<?php echo $_GET['ticket_id'];?>">

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<label>Message:</label>
		<textarea style="width:100%; height:120px;" name="message" placeholder="Write a message..." class="form-control"></textarea>
		<br/>
		<input type="submit" name="send" value="Send" class="btn btn-success">
	</div>
</div>
</form>


<?php 
	if(isset($_GET['ticket_id']))
	{
		$command = Yii::$app->db->createCommand();
		$sql 	 = $command->update('tickets', 
					array('unread_owner' => 0), "ticket_id=:ids", array(':ids'=> $_GET['ticket_id'])
				 );
	}
?>

