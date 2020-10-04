<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;
use yii\web\View;

AppAsset::register($this);

$session = Yii::$app->session;
$session->open();
$bodyClass = '';
if($session->get('sidebar'))
{
    if($session->get('sidebar') == 'collapse')
    {
        $bodyClass = ' sidebar-collapse';
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-black login-page">
<?php $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><img src="https://www.anonymous.com/skin/frontend/rok/default/images/logo.png" alt="anonymous" /></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php
$js="
jQuery('#admin-sidebar-toggle').click(function(){
  if(jQuery('body').hasClass('sidebar-collapse'))
  {
    // Collapsed
    jQuery.ajax({
      url : '".Url::toRoute('ajax/sidebar', true)."',
      method: 'GET',
      data: {action: 'collapse'},
      error: function(){
        alert('Error while setting session');
      }
    });
  }
  else
  {
    // Expanded

    jQuery.ajax({
      url : '".Url::toRoute('ajax/sidebar', true)."',
      method: 'GET',
      data: {action: 'dont'},
      error: function(){
        alert('Error while setting session');
      }
    });

  }
});
";
$this->registerJs($js, View::POS_READY);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>