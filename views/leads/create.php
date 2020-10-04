<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leads */

$this->title = 'Create Lead';
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-create">

    <?= $this->render('_form_lead_create', [
    'model' => $model,
    ]) ?>

</div>
