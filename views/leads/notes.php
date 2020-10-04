<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */

$this->title = 'Lead Notes';
$this->params['breadcrumbs'][] = ['label' => 'Lead Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lead-design-create">

    <?= $this->render('_form_notes', [
        'model' => $model,
        'leadModel' => $leadModel
    ]) ?>

</div>