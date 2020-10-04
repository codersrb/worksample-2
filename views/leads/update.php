<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leads */

$this->title = 'Opportunity Lead Details';
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkLeadID, 'url' => ['view', 'id' => $model->pkLeadID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelContact' => $modelContact,
        'modelProjectCompletion' => $modelProjectCompletion,
        'modelContactContractorInfo' => $modelContactContractorInfo
    ]) ?>

</div>
