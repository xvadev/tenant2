<?php
/* @var $this SiteController */

$this->title = 'My Tickets';
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Html;
use yii\db\Query;
$id =  '';
?>
<?php
function retrieve_tickets()
{
	$con = Yii::$app->db;
	
	$user = Yii::$app->user->identity->username;
		$mem_id = $con->createCommand("SELECT * FROM users WHERE username='".$user."'")->queryAll();
		foreach ($mem_id as $key => $values)
			{ 
				$id =  $values['id'];
			}
			$logged_id  = $id;

	$tickets = $con->createCommand("SELECT ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_user, status, date_sent, lastname, firstname FROM tickets LEFT OUTER JOIN profiles ON tickets.sender_id = profiles.user_id WHERE sender_id=$logged_id AND parent_ticket_id=0")->queryAll();

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
<h1>Manage Tickets</h1>
<a href="index.php?r=site/page&view=file-ticket"><h4>Open new ticket..</h4></a>
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
<?php //print_r(retrieve_tickets());?>