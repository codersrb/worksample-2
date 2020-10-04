<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Create New Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelProjectCompletion' => $modelProjectCompletion,
        'modelContactContractorInfo' => $modelContactContractorInfo
    ]) ?>

</div>
