
<html>
<?php

use yii\helpers\Html;
use yii\db\Query;
$id =  '';
$this->title = 'File Ticket';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
function get_parent()
{
	$con = Yii::$app->db;
	$user = Yii::$app->user->identity->username;
		$mem_id = $con->createCommand("SELECT * FROM users WHERE username='".$user."'")->queryAll();
		foreach ($mem_id as $key => $values)
			{ 
				$id =  $values['id'];
			}
			$logged_id  = $id;
	$parents = '';
	$parent = Yii::$app->db->createCommand('SELECT parent_id FROM users WHERE id='.$logged_id.'')->queryAll();
	foreach ($parent as $key => $value)
			{ 
				$parents = $value['parent_id'];
			}

	return $parents;
}

?>
<?php
	if(isset($_POST['newticket']))
	{
		$con = Yii::$app->db;
		$user = Yii::$app->user->identity->username;
		$mem_id = $con->createCommand("SELECT * FROM users WHERE username='".$user."'")->queryAll();
		foreach ($mem_id as $key => $values)
			{ 
				$id =  $values['id'];
			}
			$logged_id  = $id;
		$parent 	= get_parent();
		$command = $con->createCommand()->insert('tickets', [
					 'owner_id'	=> $parent,
    				 'sender_id'	=> $logged_id,
					 'parent_ticket_id'	=> 0,
					 'title' => $_POST['title'],
					 'message'	=> $_POST['message'],
					 'date_sent' => date('Y-m-d'),
					 'unread_owner' => 1,
					 'status' => 0,
					 'bmanager_id' => 4
    				 ])->execute();
	if ($command > 0) 
	{
		header("Location: index.php?r=site/page&view=file-ticket&msg=success");
	}
	else
		{
			
			header("Location: index.php?r=site/page&view=file-ticket&msg=failed");
		}
	}
?>

<?php 
	if(isset($_GET['msg']) && $_GET['msg'] == 'success'){
		?>
		<p style="color:#00CC00">Ticket Succesfully Sent...</p>
		<?php
	}
	
	if(isset($_GET['msg']) && $_GET['msg'] == 'failed')
	{
		?>
		<p style="color:#CC0000">Failed to send ticket..Unknown Error Occur.</p>
		<?php
	}
?>

<form method="POST">
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-12 col-lg-6">
		<h1>New Ticket</h1>
		<label for="subject">Ticket Subject</label>
		<input type="text" class="form-control" name="title" id="subject">
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />		
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<p><br/></p>
		<label>Message</label>
	      <div id="alerts"></div>
	      <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
	        <div class="btn-group">
	          <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
	          <ul class="dropdown-menu">
	          <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
	        </div>

	        <div class="btn-group">
	          <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a data-edit="fontSize 5">
	                <p style="font-size:17px">Huge</p>
	              </a>
	            </li>
	            <li>
	              <a data-edit="fontSize 3">
	                <p style="font-size:14px">Normal</p>
	              </a>
	            </li>
	            <li>
	              <a data-edit="fontSize 1">
	                <p style="font-size:11px">Small</p>
	              </a>
	            </li>
	          </ul>
	        </div>

	        <div class="btn-group">
	          <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
	          <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
	          <a class="btn" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
	          <a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
	        </div>

	        <div class="btn-group">
	          <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
	          <a class="btn" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
	          <a class="btn" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
	          <a class="btn" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
	        </div>

	        <div class="btn-group">
	          <a class="btn" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
	          <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
	          <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
	          <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
	        </div>

	        <div class="btn-group">
	          <a class="btn dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
	          <div class="dropdown-menu input-append">
	            <input class="span2" placeholder="URL" type="text" data-edit="createLink">
	            <button class="btn" type="button">Add</button>
	          </div>
	          <a class="btn" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
	        </div>

	        <div class="btn-group">
	          <a class="btn" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
	          <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 37px; height: 34px;">
	        </div>

	        <div class="btn-group">
	          <a class="btn" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
	          <a class="btn" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
	        </div>
	      </div>

	      <div id="editor" class="editor-wrapper placeholderText" contenteditable="true"></div>

	      <textarea name="message" id="descr" style="display:none;"></textarea>
	      
	</div>
</div>
<div class="row">
<p></p>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-12 col-lg-6">
		<input class="btn btn-primary" type="Submit" value="Send" name="newticket">
	</div>
</div>
</form>

