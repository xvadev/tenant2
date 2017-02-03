<?php 
//use yii\helpers\Html;
//use yii\db\Query;


$user = Yii::$app->user->id;

?>

<?php

function retrieve_tickets()
{
	$connection = Yii::$app->db;
	$logged_id = Yii::$app->user->id;

	$tickets = (new \yii\db\Query())
    ->select('ticket_id, sender_id, owner_id, parent_ticket_id, title, unread_owner, status, date_sent, lastname, firstname')
    ->from('tickets')
    ->join('INNER JOIN','profiles', 'tickets.sender_id = profiles.user_id')
    ->where('owner_id='.$logged_id.' OR bmanager_id='.$logged_id.' AND parent_ticket_id=0')
    ->all();

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

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="x_panel">
		<div class="x_title">
			<h2>Tickets<small></small></h2>
			<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings</a>
			</li>
			<li><a href="#">Minimize</a>
			</li>
			</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a>
			</li>
			</ul>
			<div class="clearfix"></div>
		</div>

		<div class="x_content">
			<ul class="list-unstyled msg_list">
            <?php
			$tickets = retrieve_tickets();
			foreach ($tickets as $key => $value)
			{
				?>
				<li>
              	<a href="index.php?r=site/page&view=read-ticket&ticket_id=<?php echo $value['ticket_id'];?>">
                <span class="image">
                  <img src="http://www.hit4hit.org/img/login/user-icon-6.png" alt="img">
                </span>
                <span>
                  <span><?php echo $value['firstname']." ".$value['lastname'];?></span>
                  <span class="time"><?php echo $value['date_sent'];?></span>
                </span>
                <span class="message">
                  <?php
						if( $value['unread_owner'] == 1)
						{
							
								echo $value['title'];
							
						}
						else
						{
								 echo $value['title'];	
						}
					?>	
                </span>
              </a>
            </li>
				<?php
			}
			?>
         </ul>
		</div>
		</div>
	</div>
</div>


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
						if( $value['unread_owner'] == 1)
						{
							?>
							<a style="" href="index.php?r=site/page&view=read-ticket&ticket_id=<?php echo $value['ticket_id'];?>">
								<?php echo $value['title'];?>	
							</a>
							<?php
						}
						else
						{
							?>
							<a style="color:rgba(51,51,51,0.81);" href="index.php?r=site/page&view=read-ticket&ticket_id=<?php echo $value['ticket_id'];?>">
								<?php echo $value['title'];?>	
							</a>
							<?php
						}
					?>	
				</td>
				<td><?php echo $value['firstname']." ".$value['lastname'];?></td>
				<td><?php echo $value['date_sent'];?></td>
				<td><?php echo check_unread($value['unread_owner']);?></td>
			</tr>
			<?php
		}
	?>
</table>
<?php //print_r(retrieve_tickets());





?>