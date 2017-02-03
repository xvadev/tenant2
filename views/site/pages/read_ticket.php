<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Read Ticket';
$this->breadcrumbs=array(
	'Read Ticket',
);
?>
<?php
function retrieve_ticket($ticket)
{
	$connection = Yii::app()->db;
	$logged_id  = Yii::app()->user->getId();

	$tickets = Yii::app()->db->createCommand()
	->select('ticket_id, sender_id, owner_id, parent_ticket_id, title, unread, status, date_sent, lastname, firstname')
	->from('tickets')
	->join('profiles', 'tickets.sender_id = profiles.user_id')
	->where('ticket_id='.$ticket." AND parent_ticket_id=".$ticket)
	->queryAll();

	return $tickets;
}

print_r($retrieve_ticket($_GET['ticket_id']));
?>
<h1>Staff Assignment</h1>

