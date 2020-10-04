<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Leads */

$this->title = $model->pkLeadID;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkLeadID], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkLeadID], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'pkLeadID',
            'fkContactID',
            'leadAdded',
            'leadModified',
    ],
    ]) ?>

</div>
