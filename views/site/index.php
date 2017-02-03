<?php

/* @var $this yii\web\View */

$this->title = 	'Tenant 24/7';
if(!Yii::$app->user->isGuest){
     ?>
     <script type="text/javascript">
     (function(){
        
          window.location.href = 'http://45.32.35.90/tenant2/web/index.php?r=site/page&view=dashboard';
        
        })();
     </script>
     <?php
}
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hello! <?=
					Yii::$app->user->isGuest ? ( ' ' ) : (
					Yii::$app->user->identity->username 
					)
					?>
		</h1>
        <?=
            Yii::$app->user->isGuest ? ( '<p class="lead">Welcome to Tenant 24/7!</p>' ) : (
            '<p class="lead">Welcome to back Tenant 24/7!</p>'
        )
        ?>
        

        <p><a class="btn btn-lg btn-success" href="index.php?r=site/page&view=dashboard">Navigate to Dashboard</a></p>
    </div>

    <div class="body-content">

    <div class="row">
    <br/>
    <br/>
    </div>

    </div>
</div>
<?php

