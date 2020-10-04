<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadMeasurements */

$this->title = 'Lead Measurements';
$this->params['breadcrumbs'][] = ['label' => 'Lead Measurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-measurements-create">

    <?= $this->render('_form_measurements', [
        'model' => $model,
        'leadModel' => $leadModel
    ]) ?>

</div>
