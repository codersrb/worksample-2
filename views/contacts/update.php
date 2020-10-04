<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Update Contacts: ' . $model->pkContactID;
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkContactID, 'url' => ['view', 'id' => $model->pkContactID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contacts-update">

    <?= $this->render('_form_update', [
        'model' => $model,
        'modelProjectCompletion' => $modelProjectCompletion,
        'modelContactContractorInfo' => $modelContactContractorInfo
    ]) ?>

</div>
