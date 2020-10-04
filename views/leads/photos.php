<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */

$this->title = 'Lead Photos';
$this->params['breadcrumbs'][] = ['label' => 'Lead', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-design-create">

    <?= $this->render('_form_photos', [
        'model' => $model,
        'leadModel' => $leadModel,
        'leadImages' => $leadImages
    ]) ?>

</div>