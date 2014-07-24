<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

//var_dump(Yii::getPathOfAlias('eauth.EAuthWidget')); die();
?>

<?php
if (Yii::app()->user->hasFlash('error')) {
    echo '<div class="error">'.Yii::app()->user->getFlash('error').'</div>';
}
?>
...
<h2>Do you already have an account on one of these sites? Click the logo to log in with it here:</h2>
<?php
$this->widget('eauth.EAuthWidget', array('action' => 'site/login'));
?>
