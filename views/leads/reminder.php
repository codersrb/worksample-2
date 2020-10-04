<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */

$this->title = 'Lead Reminder';
$this->params['breadcrumbs'][] = ['label' => 'Lead Reminder', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-design-create">

    <?= $this->render('_form_reminder', [
        'model' => $model,
        'leadModel' => $leadModel
    ]) ?>

</div>