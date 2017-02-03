<?php
/* @var $this SiteController */
//$this->pageTitle=Yii::app()->name . ' - addtenant';
use yii\helpers\Html;
use yii\db\Query;
use yii\swiftmailer\Mailer;
$this->title = 'Mailer';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 



$m = Yii::$app->mailer->compose()
    ->setFrom('rgbitangcor92@gmail.com')
    ->setTo('todo@xva.me')
    ->setSubject('Test Subject')
    ->setTextBody('Sample Mail Body')
    ->setHtmlBody('<b>Please verify your email address.</b>')
    ->send();

if($m == true)
{
	echo "Sent";
}
?>