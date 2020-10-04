<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */

$this->title = 'Lead Delivery';
$this->params['breadcrumbs'][] = ['label' => 'Lead Designs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-design-create">

    <?= $this->render('_form_delivery', [
        'model' => $model,
        'leadModel' => $leadModel
    ]) ?>

</div>